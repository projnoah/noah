(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

$(function () {
    var $input, $label, $form;

    $('.input-file').each(function () {
        $input = $(this), $label = $input.next('label');
        var labelVal = $label.html();

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

    function uploadFile(e) {
        var fileName = '';

        // if (this.files && this.files.length > 1)
        //     fileName = ( this.getAttribute('data-multiple-caption') || '' ).replace('{count}', this.files.length);
        // else if (e.target.value)
        fileName = e.target.value.split('\\').pop();

        if (fileName) $label.find('span').html(fileName);else $label.html(labelVal);

        $form = $form ? $form : $($input).parents("form")[0];
        $($form).addClass('loading');
        $($($label).find("figure")[0]).toggleClass('icon-cloud-upload fa fa-spin fa-spinner');

        $.ajaxFileUpload({
            url: $form.action,
            dataType: 'json',
            fileElementId: 'logo-file',
            success: function success(d) {
                $("#logo-img").attr('src', d.responseText.replace(/<\/?[^>]*>/g, ''));
            },
            error: function error(er) {
                $("#logo-img").attr('src', er.responseText.replace(/<\/?[^>]*>/g, ''));
            },
            complete: function complete() {
                $($form).removeClass('loading');
                $($($label).find("figure")[0]).toggleClass('icon-cloud-upload fa fa-spin fa-spinner');
                setTimeout(function () {
                    var sel = '#' + $($form).attr('id');
                    $.pjax.reload(sel);
                }, 100);
            }
        });
    }
});

},{}]},{},[1]);

//# sourceMappingURL=display-settings.js.map
