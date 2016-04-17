const Vue = require('vue');

$(document).pjax('a[data-pjax]', '#page-container');

// PJAX JavaScript re-evaluation
$(document).on('pjax:success', function (e, data, status, xhr) {
    if (status == 'success') {
        $("script[pjax-script]").remove();

        $.getScript(xhr.getResponseHeader('X-PJAX-Script'));

        pjaxReEvaluate();
    }
});

$(function () {
    // Switchery
    var elems = Array.prototype.slice.call(document.querySelectorAll('.top-menu .js-switch'));

    elems.forEach(function (html) {
        new Switchery(html, {color: typeof(THEME_COLOR) == "undefined" ? "#23B7E5" : THEME_COLOR});
    });
    
    const Admin = new Vue({
        el: "body",
        data: {
            colorChangerForm: $('form#color-changer')[0],
            settingChangerForm: $('form#setting-changer')[0],
            User: CurrentUser,
            Site: SiteSettings
        },
        computed: {
            _token() {
                return $("meta[name=_token]").attr('content');
            },
            themeColor() {
                return typeof(THEME_COLOR) == "undefined" ? "#23B7E5" : THEME_COLOR;
            }
        },
        methods: {
            changeThemeColor(el) {
                $.ajax({
                    url: $(this.colorChangerForm).attr('action'),
                    type: "PATCH",
                    data: {
                        _token: this._token,
                        theme: $(el).attr('data-css'),
                        color: $(el).attr('data-color')
                    },
                    error: (error) => {
                        toastr.error(error.responseText);
                    },
                    success: (JSON) => {
                        let message = `<h4>${JSON.message}</h4>`;
                        if (JSON.status !== "error") {
                            toastr.success(message);
                        } else {
                            toastr.error(message);
                        }
                    }
                });
            },
            changeThemeSettings(el, type) {
                $.ajax({
                    url: $(this.settingChangerForm).attr('action'),
                    type: "PATCH",
                    data: {
                        _token: this._token,
                        type: type,
                        value: el.checked
                    },
                    error: (error) => {
                        toastr.error(error.responseText);
                    },
                    success: (JSON) => {
                        let message = `<h4>${JSON.message}</h4>`;
                        if (JSON.status !== "error") {
                            toastr.success(message);
                        } else {
                            toastr.error(message);
                        }
                    }
                });
            },
        },
        ready() {
            return () => {

            }
        }
    });

    pjaxReEvaluate(true);

    window.Admin = Admin;
});

const pjaxReEvaluate = (manual = false) => {
    const loadingIcon = '<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp;';

    (function () {
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
        var checkBox = $("input[type=radio]:not(.no-uniform)");
        if (checkBox.length > 0) {
            checkBox.each(function () {
                $(this).uniform();
            });
        }

        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('#page-container .js-switch'));

        elems.forEach(function (html) {
            new Switchery(html, {color: typeof(THEME_COLOR) == "undefined" ? "#23B7E5" : THEME_COLOR});
        });

        $("form:not(.no-ajax)").each(function () {
            const form = this;
            $(this).on('submit', function (e) {
                e.preventDefault();

                $(form).addClass('loading');

                let button = $(form).find("button[type=submit]")[0],
                    originText = button.innerHTML;
                $(button).html(`${loadingIcon}&nbsp;${originText}`);

                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    error: function (error) {
                        if (error.status === 422) {
                            let errors = JSON.parse(error.responseText);
                            for (let er in errors) {
                                const sel = `[name=${er}]`,
                                    groupEl = $($(form).find(sel)[0]).parents('.form-group')[0];
                                // Add error class to the form-group
                                $(groupEl).addClass('has-error shaky');
                                setTimeout(() => $(groupEl).removeClass('has-error shaky'), 8000);

                                toastr.error(`<h4>${errors[er][0]}</h4>`);
                            }
                        }
                    },
                    success: function (data) {
                        if (data.status !== 'error') {
                            if (typeof(data.redirectUrl) != 'undefined') {
                                window.location.href = data.redirectUrl;
                            }

                            toastr.success(`<h4>${data.message}</h4>`);
                        } else {
                            toastr.error(`<h4>${data.message}</h4>`);
                        }
                    },
                    complete: () => {
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

        if (!manual) {
            Admin.$compile(document.querySelector('body'));
        }
    })();
}