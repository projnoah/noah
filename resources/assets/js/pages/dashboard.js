const Vue = require('vue');

import BlogShareMenu from "./classes/BlogShareMenu";

const Dashboard = {
    vm() {
        return vm ? vm : new Vue({
            el: "#app",
            data: {
                isTopMenuOpen: false,
            },
            methods: {
                toggleTopMenu: () => {
                    vm.isTopMenuOpen ? $(vm.$el).removeClass('show-menu') : $(vm.$el).addClass('show-menu');
                    vm.isTopMenuOpen = !vm.isTopMenuOpen;
                },
                openPage: (newWindow = false, ev) => {
                    if (newWindow) {
                        window.open($(ev.target).attr('data-link'), "_blank");
                    } else {
                        window.location.href = $(ev.target).attr('data-link');
                    }
                },
                bodyClicked: (ev) => {
                    const target = ev.target;
                    if (vm.isTopMenuOpen && target !== document.querySelector('.profile-button')) {
                        vm.toggleTopMenu();
                    }
                },
                searchQuery: function (ev) {
                    const form = ev.target,
                        input = $(form).find("input[name=keyword]")[0];
                    
                    if (input.value.trim() != "") {
                        window.location.href = `${form.action}/${input.value}`;
                    }
                }
            }
        });
    },
};

const vm = Dashboard.vm();

$(document).ready(function () {
    document.querySelector('.content-wrap').addEventListener('click', vm.bodyClicked);

    const blogItems = $(".blogs-list .blog-item");
    
    // Blog share menus
    let shareEl = $(blogItems).children(".blog-share");
    $(shareEl).each(function () {
        new BlogShareMenu(this);
    });
    
    // Sticky avatar
    $(blogItems).each(function () {
        $(this).waypoint( (direction) => {
            if (!vm.isTopMenuOpen) {
                const avatar = $(this).find(".blog-avatar")[0];
                direction == "up" ? $(avatar).removeClass('avatar--fixed') : $(avatar).addClass('avatar--fixed');
            }
        }, {
            offset: '68px'
        });
        // When we're approaching the next one with the offset of 64(avatar height)+68+22(margin)
        // Add avatar--absolute class to the previous avatar
        $(this).waypoint( (direction) => {
            // Only apply if not the first one
            if (!!$(this).prev().length && !vm.isTopMenuOpen) {
                const prev = $(this).prev()[0],
                    avatar = $(prev).find(".blog-avatar")[0];
                
                direction == "up" ? $(avatar).removeClass("avatar--absolute") : $(avatar).addClass("avatar--absolute");
            }
        }, {offset: '156px'});
    });

    // let fixedWidgets = $(".widget[widget-fixed]");
    // $(fixedWidgets).each(function () {
    //     $(this).waypoint(() => {
    //         $(this).toggleClass('widget--fixed');
    //     }, {offset: '68px'});
    // });
});