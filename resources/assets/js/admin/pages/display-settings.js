$(function () {
    var $input, $label, $form;

    $('.input-file').each(function () {
        $input = $(this),
            $label = $input.next('label');
        var labelVal = $label.html();

        $label.on('click', function () {
            $($input).click();
        });

        $input.on('change', uploadFile);

        // Firefox bug fix
        $input
            .on('focus', function () {
                $input.addClass('has-focus');
            })
            .on('blur', function () {
                $input.removeClass('has-focus');
            });
    });

    function uploadFile(e) {
        var fileName = '';

        // if (this.files && this.files.length > 1)
        //     fileName = ( this.getAttribute('data-multiple-caption') || '' ).replace('{count}', this.files.length);
        // else if (e.target.value)
        fileName = e.target.value.split('\\').pop();

        if (fileName)
            $label.find('span').html(fileName);
        else
            $label.html(labelVal);

        $form = $form ? $form : $($input).parents("form")[0];
        $($form).addClass('loading');
        $($($label).find("figure")[0]).toggleClass('icon-cloud-upload fa fa-spin fa-spinner');

        $.ajaxFileUpload({
            url: $form.action,
            dataType: 'json',
            fileElementId: 'logo-file',
            success: (d) => {
                $("#logo-img").attr('src', d.responseText.replace(/<\/?[^>]*>/g, ''));
            },
            error: (er) => {
                $("#logo-img").attr('src', er.responseText.replace(/<\/?[^>]*>/g, ''));
            },
            complete: () => {
                $($form).removeClass('loading');
                $($($label).find("figure")[0]).toggleClass('icon-cloud-upload fa fa-spin fa-spinner');
                setTimeout(() => {
                    const sel = `#${$($form).attr('id')}`;
                    $.pjax.reload(sel);
                }, 100);
            }
        });
    }
});