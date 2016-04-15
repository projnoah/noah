import "./all";
import "./ajaxForm";

$(function () {
    $('#keywords-select').select2({
        tags: true,
        maximumSelectionLength: 15
    });
    
});