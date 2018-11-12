(function ($) {
  'use strict';

  $(document).ready(function() {
    (function () {
      var container = document.getElementById('tui-chart-widget-ex1');
      var data = {
        categories: ['Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct'],
        series: {
          column: [
            {
              name: 'Seoul',
              data: [11.3, 17.0, 21.0, 24.4, 25.2, 20.4, 13.9]
            },
            {
              name: 'NewYork',
              data: [9.9, 16.0, 21.2, 24.2, 23.2, 19.4, 13.3]

            },

            {
              name: 'Sydney',
              data: [18.3, 15.2, 12.8, 11.8, 13.0, 15.2, 17.6]
            },
            {
              name: 'Moskva',
              data: [4.4, 12.2, 16.3, 18.5, 16.7, 10.9, 4.2]
            }
          ],
          line: [
            {
              name: 'Average',
              data: [11, 15.1, 17.8, 19.7, 19.5, 16.5, 12.3]
            }
          ]
        }
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 540,
          title: '24-hr Average Temperature'
        },
        yAxis: {
          title: 'Temperature (Celsius)'
        },
        xAxis: {
          title: 'Month'
        },
        series: {
          line: {
            showDot: true
          }
        },
        tooltip: {
          grouped: true,
          suffix: '°C'
        }
      };
      var theme = {
        series: {
          column: {
            colors: [
              '#83b14e', '#458a3f', '#295ba0', '#2a4175', '#289399'
            ]
          },
          line: {
            colors: ['#333']
          }
        }
      };

// For apply theme

// tui.chart.registerTheme('myTheme', theme);
// options.theme = 'myTheme';

      var chart = tui.chart.comboChart(container, data, options);
    })();

    (function () {
      var container = document.getElementById('tui-chart-widget-ex2');
      var data = {
        categories: ['Browser'],
        seriesAlias: {
          pie1: 'pie',
          pie2: 'pie'
        },
        series: {
          pie1: [
            {
              name: 'Chrome',
              data: 46.02
            },
            {
              name: 'IE',
              data: 20.47
            },
            {
              name: 'Firefox',
              data: 17.71
            },
            {
              name: 'Safari',
              data: 5.45
            },
            {
              name: 'Opera',
              data: 3.10
            },
            {
              name: 'Etc',
              data: 7.25
            }
          ],
          pie2: [
            {
              name: 'Chrome 1',
              data: 26.02
            },
            {
              name: 'Chrome 2',
              data: 20
            },
            {
              name: 'IE 1',
              data: 5.47
            },
            {
              name: 'IE1 2',
              data: 7
            }, {
              name: 'IE 3',
              data: 8
            },
            {
              name: 'Firefox 1',
              data: 7.71
            },
            {
              name: 'Firefox 2',
              data: 10
            },
            {
              name: 'Safari 1',
              data: 5.45
            },
            {
              name: 'Opera 1',
              data: 3.10
            },
            {
              name: 'Etc 1',
              data: 7.25
            }
          ]
        }
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 560,
          title: 'Usage share of web browsers'
        },
        series: {
          pie1: {
            radiusRange: ['57%'],
            labelAlign: 'center',
            showLegend: true
          },
          pie2: {
            radiusRange: ['70%', '100%'],
            labelAlign: 'outer',
            showLegend: true
          }
        },
        legend: {
          visible: false
        },
        tooltip: {
          suffix: '%'
        },
        theme: 'newTheme'
      };

      tui.chart.registerTheme('newTheme', {
        series: {
          pie1: {
            colors: ['#00a9ff', '#ffb840', '#ff5a46', '#00bd9f', '#785fff', '#f28b8c', '#989486', '#516f7d', '#29dbe3', '#dddddd'],
            label: {
              color: '#fff',
              fontFamily: 'sans-serif'
            }
          },
          pie2: {
            colors: [
              '#33baff', '#66ccff',
              '#ffc666', '#ffd48c', '#FFDB9F',
              '#ff7b6b', '#ff9c90',
              '#33cab2',
              '#937fff', '#f5a2a3'],
            label: {
              color: '#fff',
              fontFamily: 'sans-serif'
            }
          }
        }
      });

      tui.chart.comboChart(container, data, options);
    })();

    (function () {
      var container = document.getElementById('tui-chart-widget-ex3');
      var data = {
        categories: ['2014.01', '2014.02', '2014.03', '2014.04', '2014.05', '2014.06', '2014.07', '2014.08', '2014.09', '2014.10', '2014.11', '2014.12',
          '2015.01', '2015.02', '2015.03', '2015.04', '2015.05', '2015.06', '2015.07', '2015.08', '2015.09', '2015.10', '2015.11', '2015.12'],
        series: {
          area: [
            {
              name: 'Effective Load',
              data: [150, 130, 100, 125, 128, 110, 134, 162, 120, 90, 98, 143,
                142, 124, 113, 129, 118, 120, 145, 172, 110, 70, 68, 103]
            }
          ],
          line: [
            {
              name: 'Power Usage',
              data: [72, 80, 110, 107, 126, 134, 148, 152, 130, 120, 114, 127,
                90, 72, 130, 117, 129, 137, 134, 160, 121, 110, 114, 117]
            }
          ]
        }
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 540,
          title: 'Energy Usage'
        },
        yAxis: {
          title: 'Energy (kWh)',
          min: 0,
          pointOnColumn: true
        },
        xAxis: {
          title: 'Month',
          tickInterval: 'auto'
        },
        series: {
          zoomable: true
        },
        tooltip: {
          suffix: 'kWh'
        },
        theme: 'newTheme'
      };

      tui.chart.registerTheme('newTheme', {
        series: {
          area: {
            colors: ['#ffb840']
          },
          line: {
            colors: ['#785fff']
          }
        }
      });

      var chart = tui.chart.comboChart(container, data, options);
    })();

    (function () {
      var container = document.getElementById('tui-chart-widget-ex4');
      var data = {
        series: {
          scatter: [
            {
              name: 'Efficiency',
              data: [
                { x: 10, y: 20 },
                { x: 14, y: 30 },
                { x: 18, y: 10 },
                { x: 20, y: 30 },
                { x: 24, y: 15 },
                { x: 25, y: 25 },
                { x: 26, y: 5 },
                { x: 30, y: 35 },
                { x: 34, y: 15 },
                { x: 36, y: 35 },
                { x: 37, y: 40 },
                { x: 38, y: 20 },
                { x: 40, y: 30 },
                { x: 42, y: 50 },
                { x: 46, y: 40 },
                { x: 47, y: 50 },
                { x: 48, y: 60 },
                { x: 50, y: 55 },
                { x: 54, y: 50 },
                { x: 58, y: 62 },
                { x: 58, y: 47 },
                { x: 62, y: 66 },
                { x: 66, y: 42 },
                { x: 65, y: 52 },
                { x: 70, y: 54 },
                { x: 74, y: 32 },
                { x: 78, y: 48 },
                { x: 82, y: 54 },
                { x: 86, y: 40 },
                { x: 90, y: 30 }
              ]
            }
          ],
          line: [
            {
              name: 'Expenses',
              data: [
                { x: 0, y: 10 },
                { x: 30, y: 11 },
                { x: 60, y: 50 },
                { x: 70, y: 99 }
              ]
            }
          ]
        }
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 540,
          title: 'Efficiency vs Expenses'
        },
        yAxis: {
          title: 'Percentage (%)'
        },
        xAxis: {
          title: 'Temperature (C)'
        },
        series: {
          line: {
            spline: true
          }
        }
      };
      var theme = {
        series: {
          scatter: {
            colors: ['#ffb840']
          },
          line: {
            colors: ['#785fff']
          }
        }
      };

// For apply theme

// tui.chart.registerTheme('myTheme', theme);
// options.theme = 'myTheme';

      var chart = tui.chart.comboChart(container, data, options);
    })();
  });
})(jQuery);
