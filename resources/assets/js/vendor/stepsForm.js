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

    let transEndEventNames = {
            'WebkitTransition': 'webkitTransitionEnd',
            'MozTransition': 'transitionend',
            'OTransition': 'oTransitionEnd',
            'msTransition': 'MSTransitionEnd',
            'transition': 'transitionend'
        },
        transEndEventName = transEndEventNames[Modernizr.prefixed('transition')],
        support = {transitions: Modernizr.csstransitions};

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
        onSubmit: function () {
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
        var self = this,
        // first input
            firstElInput = this.questions[this.current].querySelector('input'),
        // focus
            onFocusStartFn = function () {
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
            const keyCode = ev.keyCode || ev.which;
            // enter
            if (keyCode === 13) {
                ev.preventDefault();
                self._nextQuestion();
            }
        });

        // disable tab
        this.el.addEventListener('keydown', (ev) => {
            const keyCode = ev.keyCode || ev.which;
            // tab
            if (keyCode === 9) {
                ev.preventDefault();
            } else if (keyCode === 27) {
                ev.preventDefault();
                if (this.current) this._nextQuestion(false);
            }
        });
    };

    stepsForm.prototype._nextQuestion = function (next = true) {
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
            classie.addClass(this.el, next ? 'show-next' : 'show-prev');

            // remove class "current" from current question and add it to the next one
            // current question
            var nextQuestion = this.questions[this.current];
            classie.removeClass(currentQuestion, 'current');
            classie.addClass(nextQuestion, 'current');
        }

        // after animation ends, remove class "show-next" from form element and change current question placeholder
        let self = this,
            onEndTransitionFn = function (ev) {
                if (support.transitions) {
                    this.removeEventListener(transEndEventName, onEndTransitionFn);
                }
                if (self.isFilled) {
                    self._submit();
                } else {
                    classie.removeClass(self.el, 'show-next');
                    classie.removeClass(self.el, 'show-prev');
                    self.currentNum.innerHTML = self.nextQuestionNum.innerHTML;
                    self.questionStatus.removeChild(self.nextQuestionNum);
                    // force the focus on the next input
                    nextQuestion.querySelector('input').focus();
                }
            };

        if (support.transitions) {
            this.progress.addEventListener(transEndEventName, onEndTransitionFn);
        }
        else {
            onEndTransitionFn();
        }
    }

    // updates the progress bar by setting its width
    stepsForm.prototype._progress = function () {
        this.progress.style.width = this.current * ( 100 / this.questionsCount ) + '%';
    }

    // changes the current question number
    stepsForm.prototype._updateQuestionNumber = function () {
        // first, create next question number placeholder
        this.nextQuestionNum = document.createElement('span');
        this.nextQuestionNum.className = 'number-next';
        this.nextQuestionNum.innerHTML = Number(this.current + 1);
        // insert it in the DOM
        this.questionStatus.appendChild(this.nextQuestionNum);
    }

    // submits the form
    stepsForm.prototype._submit = function () {
        this.current--;
        this.options.onSubmit(this.el);
        setTimeout(() => this._progress(), 300);
    }

    // the validation function
    stepsForm.prototype._validate = function () {
        // current question´s input
        const input = this.questions[this.current].querySelector('input');
        if (input.value === '') {
            this._showError('EMPTY');
            return false;
        }
        const reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
        if (input.type === 'email' && !reg.test(input.value)) {
            this._showError('EMAIL');
            return false;
        }

        return true;
    }

    stepsForm.prototype._showError = function (err) {
        let message = '';
        switch (err) {
            case 'EMPTY' :
                message = data.errors.empty;
                break;
            case 'EMAIL' :
                message = data.errors.email;
                break;
        }
        this.error.innerHTML = message;
        classie.addClass(this.error, 'show');
    }

    // clears/hides the current error message
    stepsForm.prototype._clearError = function () {
        classie.removeClass(this.error, 'show');
    }

    // add to global namespace
    window.stepsForm = stepsForm;

})(window);