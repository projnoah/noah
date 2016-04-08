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
    displayTopBarNotification: (message, callback = () => {}) => {
        const notification = new TopBarNotify(`<span class="fa fa-times"></span><p>${message}</p>`, 'warning', callback());
        notification.display();
    }
};
// Add to global namespace
window.Noah = Noah;