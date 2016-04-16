(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

$(function () {
    // Panel Control
    $('.panel-collapse').click(function () {
        $(this).closest(".panel").children('.panel-body').slideToggle('fast');
    });

    $('.panel-reload').click(function () {
        var el = $(this).closest(".panel").children('.panel-body');
        blockUI(el);
        window.setTimeout(function () {
            unblockUI(el);
        }, 1000);
    });

    $('.panel-remove').click(function () {
        $(this).closest(".panel").hide();
    });

    // Slimscroll
    $('.slimscroll').slimscroll({
        allowPageScroll: true
    });

    // Uniform
    var checkBox = $("input[type=checkbox]:not(.switchery), input[type=radio]:not(.no-uniform)");
    if (checkBox.length > 0) {
        checkBox.each(function () {
            $(this).uniform();
        });
    }

    Admin.$compile(document.querySelector('body'));
});

},{}],2:[function(require,module,exports){
"use strict";

require("./all");

$(document).ready(function () {

    // CounterUp Plugin
    $('.counter').counterUp({
        delay: 3,
        time: 450
    });

    var flot2 = function flot2() {

        // We use an inline data source in the example, usually data would
        // be fetched from a server

        var data = [],
            totalPoints = 100;

        function getRandomData() {

            if (data.length > 0) data = data.slice(1);

            // Do a random walk

            while (data.length < totalPoints) {

                var prev = data.length > 0 ? data[data.length - 1] : 50,
                    y = prev + Math.random() * 10 - 5;

                if (y < 0) {
                    y = 0;
                } else if (y > 100) {
                    y = 100;
                }

                data.push(y);
            }

            // Zip the generated y values with the x values

            var res = [];
            for (var i = 0; i < data.length; ++i) {
                res.push([i, data[i]]);
            }

            return res;
        }

        var plot2 = $.plot("#flotchart2", [getRandomData()], {
            series: {
                shadowSize: 0 // Drawing is faster without shadows
            },
            yaxis: {
                min: 0,
                max: 100
            },
            xaxis: {
                show: false
            },
            colors: ["#22BAA0"],
            legend: {
                show: false
            },
            grid: {
                color: "#AFAFAF",
                hoverable: true,
                borderWidth: 0,
                backgroundColor: '#FFF'
            },
            tooltip: true,
            tooltipOpts: {
                content: "Y: %y",
                defaultTheme: false
            }
        });

        function update() {
            plot2.setData([getRandomData()]);

            plot2.draw();
            setTimeout(update, 30);
        }

        update();
    };

    flot2();
    var flot1 = function flot1() {
        var data = [[0, 65], [1, 59], [2, 80], [3, 81], [4, 56], [5, 55], [6, 40]];
        var data2 = [[0, 28], [1, 48], [2, 40], [3, 19], [4, 86], [5, 27], [6, 90]];
        var dataset = [{
            data: data,
            color: "rgba(220,220,220,1)",
            lines: {
                show: true,
                fill: 0.2
            },
            shadowSize: 0
        }, {
            data: data,
            color: "#fff",
            lines: {
                show: false
            },
            points: {
                show: true,
                fill: true,
                radius: 4,
                fillColor: "rgba(220,220,220,1)",
                lineWidth: 2
            },
            curvedLines: {
                apply: false
            },
            shadowSize: 0
        }, {
            data: data2,
            color: "rgba(34,186,160,1)",
            lines: {
                show: true,
                fill: 0.2
            },
            shadowSize: 0
        }, {
            data: data2,
            color: "#fff",
            lines: {
                show: false
            },
            curvedLines: {
                apply: false
            },
            points: {
                show: true,
                fill: true,
                radius: 4,
                fillColor: "rgba(34,186,160,1)",
                lineWidth: 2
            },
            shadowSize: 0
        }];

        var ticks = [[0, "1"], [1, "2"], [2, "3"], [3, "4"], [4, "5"], [5, "6"], [6, "7"], [7, "8"]];

        var plot1 = $.plot("#flotchart1", dataset, {
            series: {
                color: "#14D1BD",
                lines: {
                    show: true,
                    fill: 0.2
                },
                shadowSize: 0,
                curvedLines: {
                    apply: true,
                    active: true
                }
            },
            xaxis: {
                ticks: ticks
            },
            legend: {
                show: false
            },
            grid: {
                color: "#AFAFAF",
                hoverable: true,
                borderWidth: 0,
                backgroundColor: '#FFF'
            },
            tooltip: true,
            tooltipOpts: {
                content: "%yK",
                defaultTheme: false
            }
        });
    };

    flot1();

    $(".live-tile").liveTile();
    $(document).on('pjax:beforeReplace', function () {
        $(".live-tile").liveTile("destroy");
    });
});

},{"./all":1}]},{},[2]);

//# sourceMappingURL=dashboard.js.map
