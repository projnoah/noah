(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

/*
 |------------------------------------------------------------
 | AJAX Form Submission
 |------------------------------------------------------------
 |
 | @project Project Noah
 | @author Cali
 |
 */
var loadingIcon = '<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp;';

(function () {
    $("form").each(function () {
        var form = this;
        $(this).on('submit', function (e) {
            e.preventDefault();

            $(form).addClass('loading');

            var button = $(form).find("button[type=submit]")[0],
                originText = button.innerHTML;
            $(button).html(loadingIcon + '&nbsp;' + originText);

            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                error: function error(_error) {
                    if (_error.status === 422) {
                        var errors = JSON.parse(_error.responseText);

                        var _loop = function _loop(er) {
                            var sel = '[name=' + er + ']',
                                groupEl = $($(form).find(sel)[0]).parents('.form-group')[0];
                            // Add error class to the form-group
                            $(groupEl).addClass('has-error shaky');
                            setTimeout(function () {
                                return $(groupEl).removeClass('has-error shaky');
                            }, 8000);

                            toastr.error('<h4>' + errors[er][0] + '</h4>');
                        };

                        for (var er in errors) {
                            _loop(er);
                        }
                    }
                },
                success: function success(data) {
                    if (data.status !== 'error') {
                        if (typeof data.redirectUrl != 'undefined') {
                            window.location.href = data.redirectUrl;
                        }

                        toastr.success('<h4>' + data.message + '</h4>');
                    } else {
                        toastr.error('<h4>' + data.message + '</h4>');
                    }
                },
                complete: function complete() {
                    $(button).html(originText);
                    $(form).removeClass('loading');
                    $(form).addClass('done-loaded');
                    setTimeout(function () {
                        $(form).removeClass('done-loaded');
                    }, 300);
                }
            });
        });
    });
})();

},{}],2:[function(require,module,exports){
'use strict';

$(function () {
    // Panel Control
    $('.panel-collapse').click(function () {
        $(this).closest(".panel").children('.panel-body').slideToggle('fast');
    });

    $('.panel-reload').click(function () {
        var el = $(this).closest(".panel").children('.panel-body');
        blockUI(el);
        window.setTimeout(function () {
            unblockUI(el);
        }, 1000);
    });

    $('.panel-remove').click(function () {
        $(this).closest(".panel").hide();
    });

    // Slimscroll
    $('.slimscroll').slimscroll({
        allowPageScroll: true
    });

    // Uniform
    var checkBox = $("input[type=checkbox]:not(.switchery), input[type=radio]:not(.no-uniform)");
    if (checkBox.length > 0) {
        checkBox.each(function () {
            $(this).uniform();
        });
    }
});

},{}],3:[function(require,module,exports){
"use strict";

require("./all");

require("./ajaxForm");

$(function () {
    $('#keywords-select').select2({
        tags: true,
        maximumSelectionLength: 15
    });
});

},{"./ajaxForm":1,"./all":2}]},{},[3]);

//# sourceMappingURL=general-settings.js.map
