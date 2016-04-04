<template>
    <div id="reset-dialog" class="dialog">
        <div class="dialog__overlay"></div>
        <div class="dialog__content">
            <h2>{{ title }}</h2>
            <i class="fa fa-close dialog__close action" data-dialog-close></i>
            <form role="form" action="{{ url }}" method="POST" @submit.prevent="resetPasswordSubmit">
                <input type="hidden" name="_token" value="{{ token }}">
                <input type="email" class="email" placeholder="{{ placeholder }}" required>
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
                var form = e.target;

                console.log(form);
            },
        }
    }
</script>