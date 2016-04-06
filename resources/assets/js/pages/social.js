/*
 |------------------------------------------------------------
 | Social Connect JavaScript
 |------------------------------------------------------------
 |
 | @project Project Noah
 | @author Cali
 |
 */
$(function () {
    const socialForm = document.getElementById('social-form');
    let loadingMessageEl = socialForm.querySelector('.loading-message');
    let successMessageEl = socialForm.querySelector('.final-message');
    let failed = 0;

    // Setup form
    const setupForm = () => {
        new stepsForm(socialForm, {
            onSubmit: (form) => {
                // Hide form
                classie.addClass(socialForm.querySelector('.pn-social-form-inner'), 'fade');
                classie.addClass(loadingMessageEl, 'show');

                loadingMessageEl.innerHTML = `<i class="fa fa-square fa-2x"></i>${data.loading}`;
                successMessageEl.innerHTML = `<i class="fa fa-check-circle"></i>${data.success}`;

                setTimeout(function () {
                    classie.addClass(loadingMessageEl.querySelector('i'), 'loading');
                    submitForm(form);
                }, 850);
            }
        });
    }

    setupForm();

    // AJAX form submission
    const submitForm = function (form) {
        if (failed >= 5) {
            loadingMessageEl.innerHTML = `<i class="fa fa-frown-o"></i>${data.failed}`;
            return false;
        }
        $.post({
            url: $(form).attr('action'),
            data: $(form).serialize(),
            error: () => {
                failed++;
                submitForm(form);
            },
            success: (JSON) => {
                loadingMessageEl.innerHTML = "";
                
                if (JSON.status == "succeeded") {
                    // Success
                    classie.addClass(successMessageEl, 'show');
                    setTimeout(() => window.location.href = JSON.redirect, 1000);
                } else {
                    // Something fails
                    showError(JSON.messages[0]);
                }
            }
        });
    }

    // Display errors
    const showError = function (message) {
        classie.removeClass(loadingMessageEl, 'show');
        $('.pn-social-form-inner').removeClass('fade');

        const template = `<div id="input-errors"><h3>${message}</h3></div>`;

        $(template).prependTo($('.submission'));

        let errorEl = document.getElementById('input-errors');

        setTimeout( () => {
            if (errorEl)
                $(errorEl).fadeOut();
            setTimeout(() => $(errorEl).remove(), 350);
        }, 1800);
    }
});