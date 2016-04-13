const Vue = require('vue');

$(function () {
    const Admin = new Vue({
        el: "body",
        data: {
            colorChangerForm: $('form#color-changer')[0],
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
            }
        },
        ready() {
            
        }
    });
    
    window.Admin = Admin;
});