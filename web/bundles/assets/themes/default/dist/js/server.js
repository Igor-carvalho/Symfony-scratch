var ram = [], cpu = [], ramTemp = 0, cpuTemp = 0, ramTotal;
var IndexDashboard = function() {
    return{
        init: function() {
            function statusSystem() {
                    $.ajax({type: "POST", url: system_path, dataType: "json", success: function(response) {
                        ramTemp = (response.ramUsed * 100) / response.ramTotal;
                            cpuTemp = Math.round(response.cpu.user + response.cpu.nice + response.cpu.sys);
                            var time = 100;
                            var first = true;
                            setInterval(function() {
                                if (first) {
                                    first = false;
                                    statusSystem();
                                }
                            }, time);
                        }, error: function(f) {
                        }});
            }

            var totalPoints = 250;
            function ramValue() {
                if (ram.length >= totalPoints) {
                    ram = ram.slice(1);
                }

                while (ram.length < totalPoints) {
                    ram.push(ramTemp);
                }
                var res = [];
                for (var i = 0; i < ram.length; ++i) {
                    res.push([i, ram[i]]);
                }

                return res;
            }

            function cpuValue() {
                if (cpu.length >= totalPoints) {
                    cpu = cpu.slice(1);
                }
                while (cpu.length < totalPoints) {
                    cpu.push(cpuTemp);
                }
                var res = [];
                for (var i = 0; i < cpu.length; ++i) {
                    res.push([i, cpu[i]]);
                }

                return res;
            }

            function initCharts() {
                if (!jQuery.plot) {
                    return
                }

                if ($('#ram').size() != 0) {
                    var updateIntervalRAM = 100;
                    var plot_statisticsRAM = $.plot($("#ram"), [ramValue()], {
                        grid: {
                            borderColor: "#f3f3f3",
                            borderWidth: 1,
                            tickColor: "#f3f3f3"
                        },
                        series: {
                            shadowSize: 0, // Drawing is faster without shadows
                            color: "#3c8dbc"
                        },
                        lines: {
                            fill: true, //Converts the line chart to area chart
                            color: "#3c8dbc"
                        },
                        yaxis: {
                            min: 0,
                            max: 100,
                            show: true
                        },
                        xaxis: {
                            show: false
                        }
                    });

                    function statisticsUpdateRAM() {
                        plot_statisticsRAM.setData([ramValue()]);
                        plot_statisticsRAM.draw();
                        setTimeout(statisticsUpdateRAM, updateIntervalRAM);

                    }

                    statisticsUpdateRAM();

                }
                if ($('#cpu').size() != 0) {
                    var updateIntervalCPU = 100;
                    var plot_statisticsCPU = $.plot($("#cpu"), [cpuValue()], {
                        grid: {
                            borderColor: "#f3f3f3",
                            borderWidth: 1,
                            tickColor: "#f3f3f3"
                        },
                        series: {
                            shadowSize: 0, // Drawing is faster without shadows
                            color: "#3c8dbc"
                        },
                        lines: {
                            fill: true, //Converts the line chart to area chart
                            color: "#3c8dbc"
                        },
                        yaxis: {
                            min: 0,
                            max: 100,
                            show: true
                        },
                        xaxis: {
                            show: false
                        }
                    });
                    function statisticsUpdateCPU() {
                        plot_statisticsCPU.setData([cpuValue()]);
                        plot_statisticsCPU.draw();
                        setTimeout(statisticsUpdateCPU, updateIntervalCPU);
                    }

                    statisticsUpdateCPU();

                    $('#cpu').bind("mouseleave", function() {
                        $("#tooltip").remove();
                    });
                }


            }

            statusSystem();
            initCharts();
        }
    }
}().init();