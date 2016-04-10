(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
"use strict";

/*
 |------------------------------------------------------------
 | Helpers
 |------------------------------------------------------------
 |
 | @project Project Noah
 | @author Cali
 */
var Noah = {
    /**
     * Display an error alert.
     * 显示失败提示框
     *
     * @param title
     * @param message
     */
    displayErrorAlert: function displayErrorAlert(title, message) {
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
    displaySuccessAlert: function displaySuccessAlert(title, message) {
        swal({
            title: title,
            text: message,
            type: "success",
            timer: 2500,
            showConfirmButton: false
        });
    },
    displayAvatarNotification: function displayAvatarNotification(message) {
        var callback = arguments.length <= 1 || arguments[1] === undefined ? function () {} : arguments[1];

        var notification = new NotificationFx({
            message: "<div class=\"ns-thumb\"><img src=\"" + AVATAR_URL + "\"/></div><div class=\"ns-content\"><p>" + message + "</p></div>",
            layout: 'other',
            ttl: 4000,
            effect: 'thumbslider',
            type: 'notice',
            onClose: callback
        });
        notification.show();
    },
    /**
     * Display notification on top
     * 顶部显示提醒
     *
     * @param message {string}
     * @param callback {function}
     * @author Cali
     */
    displayTopBarNotification: function displayTopBarNotification(message) {
        var callback = arguments.length <= 1 || arguments[1] === undefined ? function () {} : arguments[1];

        var notification = new TopBarNotify("<span class=\"fa fa-times\"></span><p>" + message + "</p>", 'warning', callback());
        notification.display();
    }
};
// Add to global namespace
window.Noah = Noah;

},{}],2:[function(require,module,exports){
"use strict";

(function () {
    // Enable pusher logging - don't include this in production
    // Pusher.log = function(message) {
    //     if (window.console && window.console.log) {
    //         window.console.log(message);
    //     }
    // };
    //
    // const pusher = new Pusher('d9e732f47ac49ae33a8a', {
    //     encrypted: true
    // });
    //
    // let channel = pusher.subscribe('post');
    // channel.bind('BroadcastTestEvent', function(data) {
    //     console.log(data);
    // });
})();

},{}]},{},[1,2]);

//# sourceMappingURL=helpers.js.map
