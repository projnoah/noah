const Vue = require('vue');
/*
 |------------------------------------------------------------
 | Helpers
 |------------------------------------------------------------
 |
 | @project Project Noah
 | @author Cali
 */
const Noah = {
    /**
     * Display an error alert.
     * 显示失败提示框
     *
     * @param title
     * @param message
     */
    displayErrorAlert: (title, message) => {
        swal({
            title: title,
            text: message,
            type: "error",
            timer: 2500,
            showConfirmButton: false
        });
    },
    /**
     * Display a success alert.
     * 显示成功提示框
     *
     * @param title
     * @param message
     */
    displaySuccessAlert: (title, message) => {
        swal({
            title: title,
            text: message,
            type: "success",
            timer: 2500,
            showConfirmButton: false
        });
    },
    /**
     * Display notification on top
     * 顶部显示提醒
     *
     * @param message {string}
     * @param callback {function}
     * @author Cali
     */
    displayTopBarNotification: (message, callback = () => {
    }) => {
        const notification = new TopBarNotify(`<span class="fa fa-times"></span><p>${message}</p>`, 'warning', callback());
        notification.display();
    },
    vm() {
        return typeof(vm) != "undefined" ? vm : new Vue({
            el: "#app",
            data: {
                isTopMenuOpen: false,
            },
            methods: {
                toggleTopMenu: () => {
                    vm.isTopMenuOpen ? $(vm.$el).removeClass('show-menu') : $(vm.$el).addClass('show-menu');
                    vm.isTopMenuOpen = !vm.isTopMenuOpen;
                },
                bodyClicked: (ev) => {
                    const target = ev.target;
                    if (vm.isTopMenuOpen && target !== document.querySelector('.profile-button')) {
                        vm.toggleTopMenu();
                    }
                }
            }
        });
    },
};
// Add to global namespace
window.Noah = Noah;

if (typeof(HAS_VUE) == "undefined") {
    var vm = Noah.vm();
    document.querySelector('.content-wrap').addEventListener('click', vm.bodyClicked);
}