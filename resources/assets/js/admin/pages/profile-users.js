$(function () {
    var $input, $label, $form;
    var $image = $('.avatar-crop img');
    var $resizeButton = $('button#resize-button');

    $('.input-file').each(function () {
        $input = $(this),
            $label = $input.next('label');
    
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

    $($resizeButton).on('click', function () {
        const $data = $($image).cropper('getData'),
            $resizeForm = $("form#resize-avatar");
        
        $.post({
            url: $($resizeForm).attr('action'),
            data: $data,
            success: (jsonData) => {
                if (jsonData.status != 'error') {
                    Admin.User.avatarUrl = jsonData.avatarUrl;
                    toastr.success(`<h4>${jsonData.message}</h4>`);
                    $($resizeButton).fadeOut();
                    $image.cropper('destroy');
                } else {
                    toastr.error(`<h4>${jsonData.message}</h4>`);
                }
            },
            error: (er) => {
                toastr.error(`<h4>${er.responseText}</h4>`);
            },
            complete: () => {
                setTimeout(() => {
                    const sel = `#${$($form).attr('id')}`;
                    $.pjax.reload(sel);
                }, 100);
            }
        });
    });

    function uploadFile(e) {
        const fileName = e.target.value.split('\\').pop();
    
        if (fileName)
            $label.find('span').html(fileName);
    
        $form = $form ? $form : $($input).parents("form")[0];
        $($form).addClass('loading');
        $($($label).find("figure")[0]).toggleClass('icon-cloud-upload fa fa-spin fa-spinner');
    
        $.ajaxFileUpload({
            url: $form.action,
            dataType: 'json',
            fileElementId: 'avatar-file',
            success: (d) => {
                $($image).attr('src', d.url);
                $($image).cropper({
                    aspectRatio: 1,
                    rotatable: false,
                    scalable: false,
                    zoomable: false
                });
                $($resizeButton).fadeIn();
            },
            error: (er) => {
                
            },
            complete: () => {
                $($form).removeClass('loading');
                $($($label).find("figure")[0]).toggleClass('icon-cloud-upload fa fa-spin fa-spinner');
            }
        });
    }
});