(function ($) {
  'use strict';

  $(document).ready(function() {
    (function() {
      var container = document.getElementById('tui-chart-widget-ex1');
      var data = {
        categories: ['01/01/2016', '02/01/2016', '03/01/2016', '04/01/2016', '05/01/2016', '06/01/2016', '07/01/2016', '08/01/2016', '09/01/2016', '10/01/2016', '11/01/2016', '12/01/2016'],
        series: [
          {
            name: 'Seoul',
            data: [-3.5, -1.1, 4.0, 11.3, 17.5, 21.5, 24.9, 25.2, 20.4, 13.9, 6.6, -0.6]
          },
          {
            name: 'Seattle',
            data: [3.8, 5.6, 7.0, 9.1, 12.4, 15.3, 17.5, 17.8, 15.0, 10.6, 6.4, 3.7]
          },
          {
            name: 'Sydney',
            data: [22.1, 22.0, 20.9, 18.3, 15.2, 12.8, 11.8, 13.0, 15.2, 17.6, 19.4, 21.2]
          },
          {
            name: 'Moskva',
            data: [-10.3, -9.1, -4.1, 4.4, 12.2, 16.3, 18.5, 16.7, 10.9, 4.2, -2.0, -7.5]
          },
          {
            name: 'Jungfrau',
            data: [-13.2, -13.7, -13.1, -10.3, -6.1, -3.2, 0.0, -0.1, -1.8, -4.5, -9.0, -10.9]
          }
        ]
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 540,
          title: '24-hr Average Temperature'
        },
        yAxis: {
          title: 'Temperature (Celsius)',
          pointOnColumn: true
        },
        xAxis: {
          title: 'Month',
          type: 'datetime',
          dateFormat: 'MMM'
        },
        series: {
          showDot: false,
          zoomable: true
        },
        tooltip: {
          suffix: '°C'
        }
      };
      var chart = tui.chart.lineChart(container, data, options);
    })();

    (function() {
      var container = document.getElementById('tui-chart-widget-ex2');
      var data = {
        categories: ['June', 'July', 'Aug', 'Sep', 'Oct', 'Nov'],
        series: [
          {
            name: 'Budget',
            data: [5000, 3000, 6000, 3000, 6000, 4000]
          },
          {
            name: 'Income',
            data: [8000, 1000, 7000, 2000, 5000, 3000]
          },
          {
            name: 'Outgo',
            data: [900, 6000, 1000, 9000, 3000, 1000]
          }
        ]
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 540,
          title: '24-hr Average Temperature'
        },
        yAxis: {
          title: 'Amount',
          pointOnColumn: true
        },
        xAxis: {
          title: 'Month'
        },
        series: {
          spline: true,
          showDot: false
        },
        tooltip: {
          suffix: '°C'
        }
      };
      var theme = {
        series: {
          colors: [
            '#83b14e', '#458a3f', '#295ba0', '#2a4175', '#289399',
            '#289399', '#617178', '#8a9a9a', '#516f7d', '#dddddd'
          ]
        }
      };

// For apply theme

// tui.chart.registerTheme('myTheme', theme);
// options.theme = 'myTheme';

      tui.chart.lineChart(container, data, options);
    })();

    (function () {
      setChartData(window);
      var options = {
        chart: {
          width: document.getElementById('tui-chart-widget-ex3-1').getBoundingClientRect().width,
          height: 400
        },
        yAxis: {
          pointOnColumn: true
        },
        xAxis: {
          title: 'Month',
          type: 'datetime',
          dateFormat: 'YYYY-MM-DD',
          tickInterval: 'auto'
        },
        series: {
          showDot: false,
          zoomable: true
        },
        tooltip: {
          grouped: true
        },
        legend: {
          showCheckbox: true,
          visible: true
        }
      };

      var container1 = document.getElementById('tui-chart-widget-ex3-1');
      var data1 = {
        "categories": window.categories,
        "series": window.series1
      };
      var chart1 = tui.chart.lineChart(container1, data1, options);

      var container2 = document.getElementById('tui-chart-widget-ex3-2');
      var data2 = {
        "categories": window.categories,
        "series": window.series2
      };
      var chart2 = tui.chart.lineChart(container2, data2, options);

      var container3 = document.getElementById('tui-chart-widget-ex3-3');
      var data3 = {
        "categories": window.categories,
        "series": window.series3
      };
      var chart3 = tui.chart.lineChart(container3, data3, options);

      chart1.on('afterShowTooltip', function (params) {
        chart2.showTooltip(params);
        chart3.showTooltip(params);
      });
      chart2.on('afterShowTooltip', function (params) {
        chart1.showTooltip(params);
        chart3.showTooltip(params);
      });
      chart3.on('afterShowTooltip', function (params) {
        chart1.showTooltip(params);
        chart2.showTooltip(params);
      });

      chart1.on('beforeHideTooltip', function (params) {
        chart2.hideTooltip();
        chart3.hideTooltip();
      });
      chart2.on('beforeHideTooltip', function (params) {
        chart1.hideTooltip();
        chart3.hideTooltip();
      });
      chart3.on('beforeHideTooltip', function (params) {
        chart1.hideTooltip();
        chart2.hideTooltip();
      });

      function setChartData(obj) {
        obj.categories = [1488294000000, 1488294000000, 1488294000000, 1488294000000, 1488380400000, 1488466800000, 1488553200000, 1488639600000, 1488726000000, 1488812400000, 1488898800000,
          1488985200000, 1489071600000, 1489158000000, 1489244400000, 1489330800000, 1489417200000, 1489503600000, 1489590000000, 1489676400000, 1489762800000, 1489849200000,
          1489935600000, 1490022000000, 1490108400000, 1490194800000, 1490281200000, 1490367600000, 1490454000000, 1490540400000
        ];
        obj.series1 = [
          {
            name: 'Region1',
            data: [
              1694, 1778, 1610, 1521, 1722, null, 1660, 1695, 1676, 1732, 1811,
              1667, 1667, 1720, null, null, null, 1643, 1688, 1700, 1739, 1719,
              1680, 1900, 1667, 1674, 1665, 1714, 1400, 1682
            ]
          },
          {
            name: 'Region2',
            data: [926, 787, 666, 777, 1078, 1091, 1129, 1190, 1062, 1114, 1040,
              2034, 899, 916, 942, 988, 1096, 1173, 1185, 1099, 2176, 1134,
              1172, 1391, 1100, 1246, 1258, 1158, 1204, 1186
            ]
          },
          {
            name: 'Region3',
            data: [650, 510, 580, 500, 655, 610, 547, 721, 756, 652, 780,
              756, 635, 653, 851, 798, 791, 817, 814, 725, 991, 837,
              844, 986, 906, 950, 1096, 1193, 991, 1013
            ]
          },
          {
            name: 'Region4',
            data: [
              183, 183, 183, 173, 167, 176, 159, 162, 149, 191, 189,
              184, 284, 485, 593, 655, 705, 171, 172, 162, 196, 165,
              181, 196, 172, 164, 175, 172, 183, 183
            ]
          }
        ];
        obj.series2 = [
          {
            name: 'Region1',
            data: [
              535, 523, 592, 502, 935, 923, 835, 783, 732, 735, 888,
              857, 764, 747, 763, 625, 456, 256, 246, 424, 388, 462,
              568, 668, 467, 568, 464, 356, 367, 246
            ]
          },
          {
            name: 'Region2',
            data: [0, 0, 0, 0, 0, 423, 144, 0, 0, 0, 0,
              453, 0, 0, 0, 0, 762, 0, 0, 0, 0, 0,
              425, 0, 0, 0, 0, 162, 0, 0
            ]
          },
          {
            name: 'Region3',
            data: [1674, 1503, 1532, 1443, 1445, 1564, 1553, 1556, 1658, 1573, 1357,
              1535, 1462, 1564, 1646, 1546, 1674, 1417, 1564, 1334, 1557, 1535,
              1567, 1534, 1347, 1546, 1664, 1565, 1552, 1646
            ]
          },
          {
            name: 'Region4',
            data: [
              835, 745, 843, 753, 956, 946, 946, 822, 865, 756, 864,
              567, 835, 656, 753, 846, 785, 885, 768, 814, 975, 645,
              1081, 856, 432, 565, 553, 345, 254, 452
            ]
          }
        ];
        obj.series3 = [
          {
            name: 'Region1',
            data: [
              245, 352, 352, 391, 432, 423, 380, 345, 362, 386, 456,
              null, null, null, 693, 753, 726, 634, 680, 770, 801, 846,
              880, 820, 840, null, null, 359, 343, null
            ]
          },
          {
            name: 'Region2',
            data: [500, 500, 500, 500, 500, 500, 1000, 1000, 1000, 1000, 1000,
              1000, 500, 500, 500, 500, 500, 500, 1000, 1000, 1000, 1000,
              1000, 1000, 500, 500, 500, 500, 500, 500
            ]
          },
          {
            name: 'Region3',
            data: [800, 800, 800, 800, 800, 800, 800, 800, 800, 800, 800,
              800, 800, 800, 800, 800, 800, 800, 800, 800, 800, 800,
              800, 800, 800, 800, 800, 800, 800, 800
            ]
          },
          {
            name: 'Region4',
            data: [
              200, 200, 200, 200, 200, 200, 200, 200, 200, 200, 200,
              200, 200, 200, 200, 200, 200, 200, 200, 200, 200, 200,
              200, 200, 200, 200, 200, 200, 200, 200
            ]
          }
        ];
      }
    })();
  });
})(jQuery);
