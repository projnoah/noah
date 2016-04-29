$(function () {
    const upgradingIcon = `<h1><i class="fa fa-cog fa-spin fa-3x"></i></h1>`,
        upgradeUrl = $("#upgrade-form").attr('action');
    let lastLog = '',
        forever = true,
        timer = null,
        progress = 0;
    
    $(".new-version-gift img").on('click', function (e) {
        // Upgrade
        $(".new-version-gift").html(upgradingIcon).removeClass('new-version-available');
        $("#upgrade-progress").fadeIn();
        
        fetchLogs();
        
        setTimeout(() => {
            $.ajax(upgradeUrl, {
                type: 'PATCH',
                data: {_token: $("meta[name=_token]").attr('content')},
                success: () => {
                    toastr.success(`<h4>${upgradeCompleteMessage}</h4>`);
                },
                timeout: 3600
            });
        }, 150);
    });

    // Get new version descriptions
    $.ajax(upgradeQueryUrl, {
        type: 'GET',
        dataType: 'json',
        success: (data) => {
            $("#upgrade-description").html(data.description);
        },
        error: () => {
            $("#upgrade-description").html('Error');
        }
    });

    function fetchLogs() {
        timer = window.setInterval(fetchUpgradeLog, 50);
    }

    function fetchUpgradeLog() {
        if (forever) {
            $.ajax(upgradeUrl, {
                type: 'POST',
                dataType: 'json',
                data: {_token: $("meta[name=_token]").attr('content')},
                success: function (logData) {
                    if (logData.upgrade == 'pending') {
                        if (lastLog != logData.message) {
                            lastLog = logData.message;
                            $(`<p>${logData.message}</p>`).appendTo($(".upgrade-logs"));
                            progress += 12.5;
                            $("#upgrade-progress .progress-bar").css('width', `${progress}%`);
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
        setTimeout(() => $.pjax.reload(pjaxContainer), 1050);
    }
});