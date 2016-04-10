/*
 |------------------------------------------------------------
 | Blog Share Gooey Menu
 |------------------------------------------------------------
 |
 | @project Project Noah
 | @author Cali
 */
export default class BlogShareMenu {
    constructor(el) {
        this.el = el;
        this.initEvent();
    }

    initEvent() {
        this.menuOpen = false;
        this.toggleButton = $(this.el).find(".share-toggle-button")[0];
        this.shareButtons = $(this.el).find(".share-button");
        this.buttonsNum = this.shareButtons.length;
        this.buttonsMid = (this.buttonsNum / 2);
        this.spacing = 60;

        $(this.el).on("mousedown", () => {
            this.toggleShareMenu();
        });
    }

    openShareMenu() {
        TweenMax.to(this.toggleButton, 0.1, {
            scaleX: 1.2,
            scaleY: 0.6,
            ease: Quad.easeOut,
            onComplete: () => {
                TweenMax.to(this.toggleButton, .8, {
                    scale: 0.6,
                    ease: Elastic.easeOut,
                    easeParams: [1.1, 0.6]
                });
                TweenMax.to($(this.toggleButton).find(".share-icon"), .8, {
                    scale: 1.4,
                    ease: Elastic.easeOut,
                    easeParams: [1.1, 0.6]
                });
            }
        });
        var buttonsMid = this.buttonsMid,
            spacing = this.spacing;
        this.shareButtons.each(function (i) {
            var $cur = $(this);
            var pos = i - buttonsMid;
            if (pos >= 0) pos += 1;
            var dist = Math.abs(pos);
            $cur.css({
                zIndex: buttonsMid - dist
            });
            TweenMax.to($cur, 1.1 * (dist), {
                x: pos * spacing,
                scaleY: 0.6,
                scaleX: 1.1,
                ease: Elastic.easeOut,
                easeParams: [1.01, 0.5]
            });
            TweenMax.to($cur, .8, {
                delay: (0.2 * (dist)) - 0.1,
                scale: 0.6,
                ease: Elastic.easeOut,
                easeParams: [1.1, 0.6]
            });

            TweenMax.fromTo($cur.children(".share-icon"), 0.2, {
                scale: 0
            }, {
                delay: (0.2 * dist) - 0.1,
                scale: 1,
                ease: Quad.easeInOut
            });
        });
    }

    closeShareMenu() {
        TweenMax.to([this.toggleButton, $(this.toggleButton).children(".share-icon")], 1.4, {
            delay: 0.1,
            scale: 1,
            ease: Elastic.easeOut,
            easeParams: [1.1, 0.3]
        });
        var buttonsMid = this.buttonsMid;
        this.shareButtons.each(function (i) {
            var $cur = $(this);
            var pos = i - buttonsMid;
            if (pos >= 0) pos += 1;
            var dist = Math.abs(pos);
            $cur.css({
                zIndex: dist
            });

            TweenMax.to($cur, 0.4 + ((buttonsMid - dist) * 0.1), {
                x: 0,
                scale: .95,
                ease: Quad.easeInOut,
            });

            TweenMax.to($cur.children(".share-icon"), 0.2, {
                scale: 0,
                ease: Quad.easeIn
            });
        });
    }

    toggleShareMenu() {
        this.menuOpen = !this.menuOpen;

        this.menuOpen ? this.openShareMenu() : this.closeShareMenu();
    }
};