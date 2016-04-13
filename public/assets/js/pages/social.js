(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

/*
 |------------------------------------------------------------
 | Social Connect JavaScript
 |------------------------------------------------------------
 |
 | @project Project Noah
 | @author Cali
 |
 */
$(function () {
    var socialForm = document.getElementById('social-form');
    var loadingMessageEl = socialForm.querySelector('.loading-message');
    var successMessageEl = socialForm.querySelector('.final-message');
    var failed = 0;

    // Setup form
    var setupForm = function setupForm() {
        new stepsForm(socialForm, {
            onSubmit: function onSubmit(form) {
                // Hide form
                classie.addClass(socialForm.querySelector('.pn-social-form-inner'), 'fade');
                classie.addClass(loadingMessageEl, 'show');

                loadingMessageEl.innerHTML = '<i class="fa fa-square fa-2x"></i>' + data.loading;
                successMessageEl.innerHTML = '<i class="fa fa-check-circle"></i>' + data.success;

                setTimeout(function () {
                    classie.addClass(loadingMessageEl.querySelector('i'), 'loading');
                    submitForm(form);
                }, 850);
            }
        });
    };

    setupForm();

    // AJAX form submission
    var submitForm = function submitForm(form) {
        if (failed >= 5) {
            loadingMessageEl.innerHTML = '<i class="fa fa-frown-o"></i>' + data.failed;
            return false;
        }
        $.post({
            url: $(form).attr('action'),
            data: $(form).serialize(),
            error: function error() {
                failed++;
                submitForm(form);
            },
            success: function success(JSON) {
                loadingMessageEl.innerHTML = "";

                if (JSON.status == "succeeded") {
                    // Success
                    classie.addClass(successMessageEl, 'show');
                    setTimeout(function () {
                        return window.location.href = JSON.redirect;
                    }, 1000);
                } else {
                    // Something fails
                    showError(JSON.messages[0]);
                }
            }
        });
    };

    // Display errors
    var showError = function showError(message) {
        classie.removeClass(loadingMessageEl, 'show');
        $('.pn-social-form-inner').removeClass('fade');

        var template = '<div id="input-errors"><h3>' + message + '</h3></div>';

        $(template).prependTo($('.submission'));

        var errorEl = document.getElementById('input-errors');

        setTimeout(function () {
            if (errorEl) $(errorEl).fadeOut();
            setTimeout(function () {
                return $(errorEl).remove();
            }, 350);
        }, 1800);
    };
});

},{}],2:[function(require,module,exports){
'use strict';

/*
 |------------------------------------------------------------
 | Steps Minimal Form
 |------------------------------------------------------------
 |
 | @project Project Noah
 | @author Cali
 */
;(function (window) {

    'use strict';

    var transEndEventNames = {
        'WebkitTransition': 'webkitTransitionEnd',
        'MozTransition': 'transitionend',
        'OTransition': 'oTransitionEnd',
        'msTransition': 'MSTransitionEnd',
        'transition': 'transitionend'
    },
        transEndEventName = transEndEventNames[Modernizr.prefixed('transition')],
        support = { transitions: Modernizr.csstransitions };

    function extend(a, b) {
        for (var key in b) {
            if (b.hasOwnProperty(key)) {
                a[key] = b[key];
            }
        }
        return a;
    }

    function stepsForm(el, options) {
        this.el = el;
        this.options = extend({}, this.options);
        extend(this.options, options);
        this._init();
    }

    stepsForm.prototype.options = {
        onSubmit: function onSubmit() {
            return false;
        }
    };

    stepsForm.prototype._init = function () {
        // current question
        this.current = 0;

        // questions
        this.questions = [].slice.call(this.el.querySelectorAll('ol.questions > li'));
        // total questions
        this.questionsCount = this.questions.length;
        // show first question
        classie.addClass(this.questions[0], 'current');

        // question control
        this.ctrlNext = this.el.querySelector('button.next');
        this.ctrlPrev = this.el.querySelector('button.prev');

        // progress bar
        this.progress = this.el.querySelector('div.progress');

        // question number status
        this.questionStatus = this.el.querySelector('span.number');
        // current question placeholder
        this.currentNum = this.questionStatus.querySelector('span.number-current');
        this.currentNum.innerHTML = Number(this.current + 1);
        // total questions placeholder
        this.totalQuestionNum = this.questionStatus.querySelector('span.number-total');
        this.totalQuestionNum.innerHTML = this.questionsCount;

        // error message
        this.error = this.el.querySelector('span.error-message');

        // init events
        this._initEvents();
    };

    stepsForm.prototype._initEvents = function () {
        var _this = this;

        var self = this,

        // first input
        firstElInput = this.questions[this.current].querySelector('input'),

        // focus
        onFocusStartFn = function onFocusStartFn() {
            firstElInput.removeEventListener('focus', onFocusStartFn);
            classie.addClass(self.ctrlNext, 'show');
        };

        // show the next question control first time the input gets focused
        firstElInput.addEventListener('focus', onFocusStartFn);

        // show next question
        this.ctrlNext.addEventListener('click', function (ev) {
            ev.preventDefault();
            self._nextQuestion();
        });

        // show previous question
        this.ctrlPrev.addEventListener('click', function (ev) {
            ev.preventDefault();
            self._nextQuestion(false);
        });

        // pressing enter will jump to next question
        document.addEventListener('keydown', function (ev) {
            var keyCode = ev.keyCode || ev.which;
            // enter
            if (keyCode === 13) {
                ev.preventDefault();
                self._nextQuestion();
            }
        });

        // disable tab
        this.el.addEventListener('keydown', function (ev) {
            var keyCode = ev.keyCode || ev.which;
            // tab
            if (keyCode === 9) {
                ev.preventDefault();
            } else if (keyCode === 27) {
                ev.preventDefault();
                if (_this.current) _this._nextQuestion(false);
            }
        });
    };

    stepsForm.prototype._nextQuestion = function () {
        var next = arguments.length <= 0 || arguments[0] === undefined ? true : arguments[0];

        if (next) {
            if (!this._validate()) return false;
        }

        // clear any previous error messages
        this._clearError();

        // current question
        var currentQuestion = this.questions[this.current];

        // increment current question iterator
        next ? ++this.current : --this.current;

        // check if form is filled
        this.isFilled = this.current === this.questionsCount;

        // update progress bar
        this._progress();

        if (!this.isFilled) {
            // change the current question number/status
            this._updateQuestionNumber();

            if (this.current === 0) {
                classie.removeClass(this.ctrlPrev, 'show');
            } else {
                classie.addClass(this.ctrlPrev, 'show');
            }

            // add class "show-next" to form element (start animations)
            if (next) {
                $(this.el).addClass('show-next');
            } else {
                $(this.el).addClass('show-prev');
            }
            // remove class "current" from current question and add it to the next one
            // current question
            var nextQuestion = this.questions[this.current];
            classie.removeClass(currentQuestion, 'current');
            classie.addClass(nextQuestion, 'current');
        }

        // after animation ends, remove class "show-next" from form element and change current question placeholder
        var self = this,
            onEndTransitionFn = function onEndTransitionFn(ev) {
            if (support.transitions) {
                this.removeEventListener(transEndEventName, onEndTransitionFn);
            }
            if (self.isFilled) {
                self._submit();
            } else {
                setTimeout(function () {
                    classie.removeClass(self.el, 'show-next');
                    classie.removeClass(self.el, 'show-prev');
                }, 500);
                self.currentNum.innerHTML = self.nextQuestionNum.innerHTML;
                self.questionStatus.removeChild(self.nextQuestionNum);
                // force the focus on the next input
                nextQuestion.querySelector('input').focus();
            }
        };

        if (support.transitions) {
            this.progress.addEventListener(transEndEventName, onEndTransitionFn);
        } else {
            onEndTransitionFn();
        }
    };

    // updates the progress bar by setting its width
    stepsForm.prototype._progress = function () {
        this.progress.style.width = this.current * (100 / this.questionsCount) + '%';
    };

    // changes the current question number
    stepsForm.prototype._updateQuestionNumber = function () {
        // first, create next question number placeholder
        this.nextQuestionNum = document.createElement('span');
        this.nextQuestionNum.className = 'number-next';
        this.nextQuestionNum.innerHTML = Number(this.current + 1);
        // insert it in the DOM
        this.questionStatus.appendChild(this.nextQuestionNum);
    };

    // submits the form
    stepsForm.prototype._submit = function () {
        var _this2 = this;

        this.current--;
        this.options.onSubmit(this.el);
        setTimeout(function () {
            return _this2._progress();
        }, 300);
    };

    // the validation function
    stepsForm.prototype._validate = function () {
        // current question´s input
        var input = this.questions[this.current].querySelector('input');
        if (input.value === '') {
            this._showError('EMPTY');
            return false;
        }
        var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
        if (input.type === 'email' && !reg.test(input.value)) {
            this._showError('EMAIL');
            return false;
        }

        return true;
    };

    stepsForm.prototype._showError = function (err) {
        var message = '';
        switch (err) {
            case 'EMPTY':
                message = data.errors.empty;
                break;
            case 'EMAIL':
                message = data.errors.email;
                break;
        }
        this.error.innerHTML = message;
        classie.addClass(this.error, 'show');
    };

    // clears/hides the current error message
    stepsForm.prototype._clearError = function () {
        classie.removeClass(this.error, 'show');
    };

    // add to global namespace
    window.stepsForm = stepsForm;
})(window);

},{}]},{},[2,1]);

//# sourceMappingURL=social.js.map
