/*
 |------------------------------------------------------------
 | AJAX Form Submission
 |------------------------------------------------------------
 |
 | @project Project Noah
 | @author Cali
 |
 */
const loadingIcon = '<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp;';

(function () {
    $("form").each(function () {
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
})();