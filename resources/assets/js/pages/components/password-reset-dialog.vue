<template>
    <div id="reset-dialog" class="dialog">
        <div class="dialog__overlay"></div>
        <div class="dialog__content">
            <h2>{{ title }}</h2>
            <i class="fa fa-close dialog__close action" data-dialog-close></i>
            <form role="form" action="{{ url }}" method="POST" @submit.prevent="resetPasswordSubmit">
                <input type="hidden" name="_token" value="{{ token }}">
                <input type="email" class="email" name="email" placeholder="{{ placeholder }}" required autocomplete="off">
                <button type="submit" class="submit"><i class="fa fa-envelope"></i>&nbsp;{{ button }}</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            title() {
                return data.reset.title;
            },
            url() {
                return data.reset.url;
            },
            placeholder() {
                return data.reset.placeholder;
            },
            button() {
                return data.reset.button;
            },
            token() {
                return document.querySelector('meta[name="_token"]').attributes['content'].nodeValue;
            }
        },
        methods: {
            /**
             * Submit the password reset form
             * 提交重置密码表单
             *
             * @param e
             * @author Cali
             */
            resetPasswordSubmit(e) {
                const form = e.target,
                        self = this;

                this.setLoadingButton(false);

                $.post({
                    url: form.action,
                    data: $(form).serialize(),
                    error: function (error) {
                        Noah.displayErrorAlert("出错了", error.responseJSON.message);
                        self.setLoadingButton(true);
                    },
                    success: function (JSON) {
                        self.setLoadingButton(true);

                        if (JSON.status === 'succeeded') {
                            Noah.displaySuccessAlert("成功发送", JSON.message);
                            classie.removeClass(document.querySelector('#reset-dialog'), 'dialog--open');
                        } else {
                            Noah.displayErrorAlert("出错了", JSON.message);
                        }
                    }
                });
            },
            /**
             * Set the loading button.
             * 设置加载按钮
             *
             * @param done
             * @author Cali
             */
            setLoadingButton(done) {
                let button = this.$el.querySelector('button[type=submit]');

                done ? $(button).removeAttr('disabled') : $(button).attr('disabled', 'disabled');

                button.innerHTML = done ? `<i class="fa fa-envelope"></i>&nbsp;${this.button}` : `<i class="fa fa-spin fa-circle-o-notch"></i>`;
            }
        }
    }
</script>