/*
 |------------------------------------------------------------
 | Login Page JavaScript
 | 登录页面 JavaScript
 |------------------------------------------------------------
 |
 | 登录, 注册与密码重置相关的JavaScript脚本
 |
 | @project Project Noah
 | @author Cali
 |
 */
var Vue = require('vue');

import PasswordResetDialog from "./components/password-reset-dialog.vue";

$(function () {
    "use strict";
    const progressBtn = new UIProgressButton(document.querySelector('.progress-button'));

    // Trim declaration
    if (!String.prototype.trim) {
        (function () {
            // Make sure we trim BOM and NBSP
            const trim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
            String.prototype.trim = () => {
                return this.replace(trim, '');
            };
        })();
    }

    // Setup the App object
    const App = {
        /**
         * Lock: prevents hitting submit again
         * 按钮锁: 预防重复表单提交
         *
         * @author Cali
         */
        buttonLock: false,

        /**
         * Main form object
         * 主要表单对象
         *
         * @author Cali
         */
        $form: $('#login-form'),

        /**
         * Initial set up
         * 初始化设置
         *
         * @author Cali
         */
        initSetup() {
            [].slice.call(document.querySelectorAll('input.input__field')).forEach((inputEl) => {
                // In case the input is already filled..
                if (inputEl.value.trim() !== '') {
                    classie.add(inputEl.parentNode, 'input--filled');
                }

                // Bind events:
                inputEl.addEventListener('focus', App.onInputFocus);
                inputEl.addEventListener('blur', App.onInputBlur);
            });

            this.blurBackgroundTypingPassword();
            this.submitWhenHitsEnter();
            this.setupDialog();
        },

        /**
         * Focus input event listener
         * 输入焦点事件处理
         *
         * @author Cali
         */
        onInputFocus(ev) {
            classie.add(ev.target.parentNode, 'input--filled');
        },

        /**
         * Blur input event listener
         * 输入离开事件处理
         *
         * @author Cali
         */
        onInputBlur(ev) {
            if (ev.target.value.trim() === '') {
                classie.remove(ev.target.parentNode, 'input--filled');
            }
        },

        /**
         * Apply blur filter when typing in password
         * 输入密码时增加高斯模糊图层
         *
         * @author Cali
         */
        blurBackgroundTypingPassword() {
            // When the password input got focused, let's blur out the background
            $("input#input-password").focus(() => $('body').addClass("blur-out"))
                .blur(() => $('body').removeClass("blur-out"));
        },

        /**
         * Bind the enter key to form submission
         * 绑定回车提交表单
         *
         * @author Cali
         */
        submitWhenHitsEnter() {
            $("#panel input").keydown(e => {
                if (e.keyCode === 13) {
                    $(progressBtn.el.querySelector('button')).click();
                }
            });
        },

        /**
         * New up dialog and its event listeners
         * 新建对话框与事件响应
         *
         * @author Cali
         */
        setupDialog() {
            var dialogTrigger = document.querySelector('[data-dialog]'),
                dialog = document.getElementById(dialogTrigger.getAttribute('data-dialog')),
                dlg = new DialogFx(dialog);

            dialogTrigger.addEventListener('click', dlg.toggle.bind(dlg));
        },

        /**
         * Submit the form using AJAX
         * AJAX提交表单
         *
         * @returns {boolean}
         * @author Cali
         */
        submit() {
            let has_empty_field = false;
            $('input.input__field--login').each(function () {
                if ($(this).val().trim() === '') {
                    $(this).focus();
                    has_empty_field = true;
                    return false;
                }
            });
            // If any field is empty
            if (has_empty_field || this.buttonLock) return false;

            this.buttonLock = true;

            // Let's send a request to login
            setTimeout(() => this.sendLoginRequest(this.$form), 200);
        },

        /**
         * Send request to server
         * 发送服务器请求
         *
         * @param form {Object}
         * @author Cali
         */
        sendLoginRequest(form) {
            $.post({
                url: $(form).attr('action'),
                data: $(form).serializeArray(),
                error: (error) => {
                    this.buttonLock = false;
                    this.setLoginStatus(false);
                    console.log(JSON.parse(error.responseText));
                },
                success: (JSON) => {
                    this.buttonLock = false;

                    if (JSON.status == 'succeeded') {
                        // Login success
                        this.setLoginStatus(true);
                        // Redirect back to the intended url
                        setTimeout(() => window.location.href = JSON.redirect, 1000);
                    } else {
                        // Login failed
                        this.setLoginStatus(false);
                        // Handle error message
                        this.handleError(JSON);
                    }
                }
            });
        },

        /**
         * Display notification on top
         * 顶部显示提醒
         *
         * @param errorMsg {string}
         * @author Cali
         */
        notify(errorMsg) {
            const notification = new TopBarNotify('<span class="fa fa-times"></span><p>' + errorMsg + '</p>', 'warning', function () {
            });
            notification.display();
        },

        /**
         * Handle error message and display a notification
         * 验证错误时处理 与 显示提醒消息
         *
         * @param JSON {Object}
         * @author Cali
         */
        handleError(JSON) {
            var errorMsg = "";
            if (this.vm().isRegister) {
                var messages = JSON.messages;
                if (messages.hasOwnProperty('email')) {
                    errorMsg = messages.email;
                } else if (messages.hasOwnProperty('password')) {
                    errorMsg = messages.password;
                } else {
                    errorMsg = messages.username;
                }
            } else {
                errorMsg = JSON.error;
            }
            // Create the notification
            this.notify(errorMsg);
        },

        /**
         * Set current login status, change progress button accordingly
         * 设置当前登录状态来修改按键样式
         *
         * @param status {int}
         * @author Cali
         */
        setLoginStatus(status) {
            progressBtn.setProgress(1);
            progressBtn.stop(status ? 1 : -1);
        },

        /**
         * Setup the V-M Vue singleton
         * 设置 视图-模型 单例
         *
         * @returns {Vue Object}
         */
        vm() {
            return vm ? vm : new Vue({
                el: '#app',
                components: {PasswordResetDialog},
                data: {
                    isRegister: data.isRegister == 'true' ? true : false
                },
                ready() {
                    $("#remember_me_cb").iCheck();
                },
                computed: {
                    title() {
                        return this.isRegister ? data.register.title : data.login.title
                    },
                    url() {
                        return this.isRegister ? data.register.url : data.login.url
                    },
                    buttonTitle() {
                        return this.isRegister ? data.register.title : data.login.title
                    },
                    inputs() {
                        return this.isRegister ? data.register.inputs : data.login.inputs
                    },
                    switchButtonTitle() {
                        return !(this.isRegister) ? data.register.title : data.login.title
                    }
                },
                methods: {
                    /**
                     * Toggle between register and login form
                     * 登录/注册表单切换
                     *
                     * @author Cali
                     */
                    toggleForm() {
                        this.isRegister = !this.isRegister;
                        this.substituteTitle();
                        setTimeout(() => App.initSetup(), 300);
                    },

                    /**
                     * Submit the main form
                     * 提交主要表单
                     *
                     * @author Cali
                     */
                    submitForm() {
                        App.submit();
                    },

                    /**
                     * Substitute the document title accordingly
                     * 替换文件标题
                     *
                     * @author Cali
                     */
                    substituteTitle() {
                        document.title = this.title;
                    }
                }
            });
        }
    };

    // Get Vue
    let vm = App.vm();
    vm.substituteTitle();

    // Wait for some animations
    setTimeout(() => App.initSetup(), 300);
});