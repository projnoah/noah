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