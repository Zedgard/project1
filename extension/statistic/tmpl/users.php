<!-- User activity statistics -->
<div class="card card-default" id="user-activity1">
    <div class="col-xl-12">
        <div data-scroll-height="642">
            <div class="card-header pt-5 flex-column align-items-start">
                <h4>Посетители за период </h4>
                <div class="date-range-report mt-2" style="float: right;">
                    <span></span>
                </div>

            </div>
            <div class="border-bottom"></div>
            <div class="card-body">
                <canvas id="currentUser1" class="chartjs"></canvas>
            </div>
            <!--
            <div class="card-footer d-flex flex-wrap bg-white border-top">
                <a href="#" class="text-uppercase py-3">Audience Overview</a>
            </div>
            -->
        </div>
    </div>
</div>
<script>
    var data = [];
    $(document).ready(function () {


        var cUser = document.getElementById("currentUser1");
        var myUChart;
        /*======== 2. USER ACTIVITY ========*/
        if ($("#user-activity1")) {
            //console.log("user-activity ");
            var start = moment().subtract(6, "days");
            var end = moment();
            var cb = function (start, end) {
                $("#user-activity1 .date-range-report span").html(start.format("L") + " - " + end.format("L"));
                //console.log("start: " + start.format("L"));
                sendPostLigth('/jpost.php?extension=statistic',
                        {
                            "getStatDaysData": 1,
                            "date_start": start.format("Y-M-D"),
                            "date_end": end.format("Y-M-D")
                        }, function (e) {
                    if (myUChart != undefined) {
                        myUChart.destroy();
                    }
                    var labels = [];
                    var data = [];
                    for (var i = 0; i < e['data'].length; i++) {
                        data.push(Number(e['data'][i]['col']));
                        labels.push(String("'" + e['data'][i]['day'] + "'"));
                    }

                    /*======== 14. CURRENT USER BAR CHART ========*/

                    if (cUser !== null) {
                        myUChart = new Chart(cUser, {
                            type: "bar",
                            data: {
                                labels: labels,
                                datasets: [
                                    {
                                        label: "посетителей",
                                        data: data,
                                        backgroundColor: "#4c84ff"
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                legend: {
                                    display: false
                                },
                                scales: {
                                    xAxes: [
                                        {
                                            gridLines: {
                                                drawBorder: true,
                                                display: false,
                                            },
                                            ticks: {
                                                fontColor: "#8a909d",
                                                fontFamily: "Roboto, sans-serif",
                                                display: false, // hide main x-axis line
                                                beginAtZero: true,
                                                callback: function (tick, index, array) {
                                                    return index % 2 ? "" : tick;
                                                }
                                            },
                                            barPercentage: 1.8,
                                            categoryPercentage: 0.2
                                        }
                                    ],
                                    yAxes: [
                                        {
                                            gridLines: {
                                                drawBorder: true,
                                                display: true,
                                                color: "#eee",
                                                zeroLineColor: "#eee"
                                            },
                                            ticks: {
                                                fontColor: "#8a909d",
                                                fontFamily: "Roboto, sans-serif",
                                                display: true,
                                                beginAtZero: true
                                            }
                                        }
                                    ]
                                },

                                tooltips: {
                                    mode: "index",
                                    titleFontColor: "#888",
                                    bodyFontColor: "#555",
                                    titleFontSize: 12,
                                    bodyFontSize: 15,
                                    backgroundColor: "rgba(256,256,256,0.95)",
                                    displayColors: true,
                                    xPadding: 10,
                                    yPadding: 7,
                                    borderColor: "rgba(220, 220, 220, 0.9)",
                                    borderWidth: 2,
                                    caretSize: 6,
                                    caretPadding: 5
                                }
                            }
                        });
                        //console.log('delete: ' +  myUChart.clear());
                    }

                });
            };

            $("#user-activity1 .date-range-report").daterangepicker(
                    {
                        startDate: start,
                        endDate: end,
                        opens: 'left',
                        ranges: {
                            /*
                            "Сегодня": [moment(), moment()],
                            "Вчера": [
                                moment().subtract(1, "days"),
                                moment().subtract(1, "days")
                            ],
                             */
                            "Последние 7 дней": [moment().subtract(6, "days"), moment()],
                            /* "Последние 30 дней": [moment().subtract(29, "days"), moment()], */
                            "Этот месяц": [moment().startOf("month"), moment().endOf("month")],
                            "Прошлый месяц": [
                                moment()
                                        .subtract(1, "month")
                                        .startOf("month"),
                                moment()
                                        .subtract(1, "month")
                                        .endOf("month")
                            ],
                            "Последние 3 месяца": [moment().subtract(3, "month").startOf("month"), moment().endOf("month")],
                            "Последние 6 месяца": [moment().subtract(6, "month").startOf("month"), moment().endOf("month")],
                        }
                    },
                    cb
                    );
            cb(start, end);
        }


    });
</script>