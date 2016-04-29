(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

$(function () {
    var upgradingIcon = '<h1><i class="fa fa-cog fa-spin fa-3x"></i></h1>',
        upgradeUrl = $("#upgrade-form").attr('action');
    var lastLog = '',
        forever = true,
        timer = null,
        progress = 0;

    $(".new-version-gift img").on('click', function (e) {
        // Upgrade
        $(".new-version-gift").html(upgradingIcon).removeClass('new-version-available');
        $("#upgrade-progress").fadeIn();

        fetchLogs();

        setTimeout(function () {
            $.ajax(upgradeUrl, {
                type: 'PATCH',
                data: { _token: $("meta[name=_token]").attr('content') },
                success: function success() {
                    toastr.success('<h4>' + upgradeCompleteMessage + '</h4>');
                },
                timeout: 3600
            });
        }, 150);
    });

    // Get new version descriptions
    $.ajax(upgradeQueryUrl, {
        type: 'GET',
        dataType: 'json',
        success: function success(data) {
            $("#upgrade-description").html(data.description);
        },
        error: function error() {
            $("#upgrade-description").html('Error');
        }
    });

    function fetchLogs() {
        timer = window.setInterval(fetchUpgradeLog, 100);
    }

    function fetchUpgradeLog() {
        if (forever) {
            $.ajax(upgradeUrl, {
                type: 'POST',
                dataType: 'json',
                data: { _token: $("meta[name=_token]").attr('content') },
                success: function success(logData) {
                    if (logData.upgrade == 'pending') {
                        if (lastLog != logData.message) {
                            lastLog = logData.message;
                            $('<p>' + logData.message + '</p>').appendTo($(".upgrade-logs"));
                            progress += 12.5;
                            $("#upgrade-progress .progress-bar").css('width', progress + '%');
                        }
                    } else {
                        forever = false;
                        upgradeCompleted();
                    }
                }
            });
        } else {
            window.clearInterval(timer);
        }
    }

    function upgradeCompleted() {
        $("#upgrade-progress").fadeOut();
        $("#new-version-badge").remove();
        $("#new-version-footer").remove();
        setTimeout(function () {
            return $.pjax.reload(pjaxContainer);
        }, 1050);
    }
});

},{}]},{},[1]);
