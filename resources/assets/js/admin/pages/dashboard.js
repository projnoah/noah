import "./all";

$(document).ready(function () {

    // CounterUp Plugin
    $('.counter').counterUp({
        delay: 3,
        time: 450
    });

    var flot = function () {
        var dataset =  [
            {
                data: visitorsData.visitors,
                color: "rgba(34,186,160,1)",
                lines: {
                    show: true,
                    fill: 0.2,
                },
                shadowSize: 0,
            },{
                data: visitorsData.visitors,
                color: "#fff",
                lines: {
                    show: false,
                },
                curvedLines: {
                    apply: false,
                },
                points: {
                    show: true,
                    fill: true,
                    radius: 4,
                    fillColor: "rgba(34,186,160,1)",
                    lineWidth: 2
                },
                shadowSize: 0
            }
        ];

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
                ticks: ticks,
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