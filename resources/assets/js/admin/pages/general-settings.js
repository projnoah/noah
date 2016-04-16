import "./all";
import "./ajaxForm";

$(function () {
    $('#keywords-select').select2({
        tags: true,
        maximumSelectionLength: 15
    });
    $('#robots-select').select2({
        tags: true,
    });
    $('#timezone-select').select2();
    $('#locale-select').select2();
});