(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

$(function () {
    var $input, $label, $form;
    var $image = $('.avatar-crop img');
    var $resizeButton = $('button#resize-button');

    $('.input-file').each(function () {
        $input = $(this), $label = $input.next('label');

        $label.on('click', function () {
            $($input).click();
        });

        $input.on('change', uploadFile);

        // Firefox bug fix
        $input.on('focus', function () {
            $input.addClass('has-focus');
        }).on('blur', function () {
            $input.removeClass('has-focus');
        });
    });

    $($resizeButton).on('click', function () {
        var $data = $($image).cropper('getData'),
            $resizeForm = $("form#resize-avatar");

        $.post({
            url: $($resizeForm).attr('action'),
            data: $data,
            success: function success(jsonData) {
                if (jsonData.status != 'error') {
                    Admin.User.avatarUrl = jsonData.avatarUrl;
                    toastr.success('<h4>' + jsonData.message + '</h4>');
                    $($resizeButton).fadeOut();
                    $image.cropper('destroy');
                } else {
                    toastr.error('<h4>' + jsonData.message + '</h4>');
                }
            },
            error: function error(er) {
                toastr.error('<h4>' + er.responseText + '</h4>');
            },
            complete: function complete() {
                setTimeout(function () {
                    var sel = '#' + $($form).attr('id');
                    $.pjax.reload(sel);
                }, 100);
            }
        });
    });

    function uploadFile(e) {
        var fileName = e.target.value.split('\\').pop();

        if (fileName) $label.find('span').html(fileName);

        $form = $form ? $form : $($input).parents("form")[0];
        $($form).addClass('loading');
        $($($label).find("figure")[0]).toggleClass('icon-cloud-upload fa fa-spin fa-spinner');

        $.ajaxFileUpload({
            url: $form.action,
            dataType: 'json',
            fileElementId: 'avatar-file',
            success: function success(d) {
                $($image).attr('src', d.url);
                $($image).cropper({
                    aspectRatio: 1,
                    rotatable: false,
                    scalable: false,
                    zoomable: false
                });
                $($resizeButton).fadeIn();
            },
            error: function error(er) {},
            complete: function complete() {
                $($form).removeClass('loading');
                $($($label).find("figure")[0]).toggleClass('icon-cloud-upload fa fa-spin fa-spinner');
            }
        });
    }
});

},{}]},{},[1]);

//# sourceMappingURL=profile-users.js.map
