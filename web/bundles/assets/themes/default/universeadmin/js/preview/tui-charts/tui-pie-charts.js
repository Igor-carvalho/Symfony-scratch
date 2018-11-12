(function ($) {
  'use strict';

  $(document).ready(function() {
    (function() {
      var container = document.getElementById('tui-chart-widget-ex1');
      var data = {
        categories: ['Browser'],
        series: [
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
        ]
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 560,
          title: 'Usage share of web browsers'
        },
        tooltip: {
          suffix: '%'
        }
      };
      tui.chart.pieChart(container, data, options);
    })();

    (function () {
      var container = document.getElementById('tui-chart-widget-ex2');
      var data = {
        categories: ['Browser'],
        series: [
          {
            name: 'Chrome',
            data: 30.02
          },
          {
            name: 'IE',
            data: 25.47
          },
          {
            name: 'Firefox',
            data: 12.71
          },
          {
            name: 'Safari',
            data: 10.45
          },
          {
            name: 'Opera',
            data: 10.10
          },
          {
            name: 'Etc',
            data: 11.25
          }
        ]
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 560,
          title: 'Usage share of web browsers',
          format: function(value, chartType, areaType, valuetype, legendName) {
            if (areaType === 'makingSeriesLabel') { // formatting at series area
              value = value + '%';
            }

            return value;
          }
        },
        series: {
          showLegend: true,
          showLabel: true,
          labelAlign: 'center'
        },
        tooltip: {
          suffix: '%'
        },
        legend: {
          visible: false
        }
      };
      var theme = {
        series: {
          series: {
            colors: [
              '#83b14e', '#458a3f', '#295ba0', '#2a4175', '#289399',
              '#289399', '#617178', '#8a9a9a', '#516f7d', '#dddddd'
            ]
          },
          label: {
            color: '#fff',
            fontFamily: 'sans-serif'
          }
        }
      };
      tui.chart.registerTheme('myTheme', theme);
      options.theme = 'myTheme';

      tui.chart.pieChart(container, data, options);
    })();

    (function () {
      var container = document.getElementById('tui-chart-widget-ex3');
      var data = {
        categories: ['Browser'],
        series: [
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
        ]
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 560,
          title: 'Usage share of web browsers',
          format: function(value, chartType, areaType, valuetype, legendName) {
            if (areaType === 'makingSeriesLabel') { // formatting at series area
              value = value + '%';
            }

            return value;
          }
        },
        series: {
          showLabel: true,
          showLegend: true,
          labelAlign: 'outer'
        },
        tooltip: {
          suffix: '%'
        },
        legend: {
          visible: false
        }
      };
      var theme = {
        series: {
          series: {
            colors: [
              '#83b14e', '#458a3f', '#295ba0', '#2a4175', '#289399',
              '#289399', '#617178', '#8a9a9a', '#516f7d', '#dddddd'
            ]
          },
          label: {
            color: '#fff',
            fontFamily: 'sans-serif'
          }
        }
      };

// For apply theme

      tui.chart.registerTheme('myTheme', theme);
      options.theme = 'myTheme';

      tui.chart.pieChart(container, data, options);
    })();

    (function () {
      var container = document.getElementById('tui-chart-widget-ex4');
      var data = {
        categories: ['Browser'],
        series: [
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
        ]
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 560,
          title: 'Usage share of web browsers',
          format: function(value, chartType, areaType, valuetype, legendName) {
            if (areaType === 'makingSeriesLabel') { // formatting at series area
              value = value + '%';
            }

            return value;
          }
        },
        series: {
          radiusRange: ['40%', '100%'],
          showLabel: true
        },
        tooltip: {
          suffix: '%'
        },
        legend: {
          align: 'bottom'
        }
      };
      var theme = {
        series: {
          series: {
            colors: [
              '#83b14e', '#458a3f', '#295ba0', '#2a4175', '#289399',
              '#289399', '#617178', '#8a9a9a', '#516f7d', '#dddddd'
            ]
          },
          label: {
            color: '#fff',
            fontFamily: 'sans-serif'
          }
        }
      };

// For apply theme

      tui.chart.registerTheme('myTheme', theme);
      options.theme = 'myTheme';

      tui.chart.pieChart(container, data, options);
    })();

    (function () {
      var container = document.getElementById('tui-chart-widget-ex5');
      var data = {
        categories: ['Browser'],
        series: [
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
        ]
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 400,
          title: 'Usage share of web browsers',
          format: function(value, chartType, areaType, valuetype, legendName) {
            if (areaType === 'makingSeriesLabel') { // formatting at series area
              value = value + '%';
            }

            return value;
          }
        },
        series: {
          startAngle: -90,
          endAngle: 90,
          radiusRange: ['60%', '100%'],
          showLabel: true,
          showLegend: true
        },
        tooltip: {
          suffix: '%'
        },
        legend: {
          align: 'top'
        }
      };

      var theme = {
        series: {
          series: {
            colors: [
              '#83b14e', '#458a3f', '#295ba0', '#2a4175', '#289399',
              '#289399', '#617178', '#8a9a9a', '#516f7d', '#dddddd'
            ]
          },
          label: {
            color: '#fff',
            fontFamily: 'sans-serif'
          }
        }
      };

// For apply theme

      tui.chart.registerTheme('myTheme', theme);
      options.theme = 'myTheme';

      tui.chart.pieChart(container, data, options);
    })();
  });
})(jQuery);
