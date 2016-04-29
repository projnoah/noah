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

    var flot = function flot() {
        var dataset = [{
            data: visitorsData.visitors,
            color: "rgba(34,186,160,1)",
            lines: {
                show: true,
                fill: 0.2
            },
            shadowSize: 0
        }, {
            data: visitorsData.visitors,
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

        var ticks = visitorsData.dates;

        var plot = $.plot("#visitor-chart", dataset, {
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
            yaxis: {
                min: 0
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
                content: "%y/PV",
                defaultTheme: false
            }
        });
    };

    flot();

    $(".live-tile").liveTile();
    $(document).on('pjax:beforeReplace', function () {
        $(".live-tile").liveTile("destroy");
    });
});

},{"./all":1}]},{},[2]);
