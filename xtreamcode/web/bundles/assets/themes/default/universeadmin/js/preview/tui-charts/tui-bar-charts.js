(function ($) {
  'use strict';

  $(document).ready(function() {
    (function () {
      var container = document.getElementById('tui-chart-widget-ex1');
      var data = {
        categories: ['June', 'July', 'Aug', 'Sep', 'Oct', 'Nov'],
        series: [
          {
            name: 'Budget',
            data: [5000, 3000, 5000, 7000, 6000, 4000]
          },
          {
            name: 'Income',
            data: [8000, 1000, 7000, 2000, 5000, 3000]
          }
        ]
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 500,
          title: 'Monthly Revenue',
          format: '1,000'
        },
        yAxis: {
          title: 'Month'
        },
        xAxis: {
          title: 'Amount',
          min: 0,
          max: 9000,
          suffix: '$'
        }
      };
      tui.chart.barChart(container, data, options);
    })();

    (function () {
      var container = document.getElementById('tui-chart-widget-ex2');
      var data = {
        categories: ['May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        series: [
          {
            name: 'Budget',
            data: [4000, 5000, 3000, 5000, 7000, 6000, 4000, 1000]
          },
          {
            name: 'Income',
            data: [7000, 8000, 1000, 7000, 2000, 7000, 3000, 5000]
          },
          {
            name: 'Expenses',
            data: [-5000, -4000, -4000, -6000, -3000, -4000, -5000, -7000]
          }
        ]
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 600,
          title: 'Monthly Revenue',
          format: '1,000'
        },
        yAxis: {
          title: 'Month'
        },
        xAxis: {
          title: 'Amount',
          min: -10000,
          max: 10000
        },
        series: {
          showLabel: true
        }
      };

      tui.chart.barChart(container, data, options);
    })();

    (function() {
      var container = document.getElementById('tui-chart-widget-ex3');
      var data = {
        categories: ['June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        series: [
          {
            name: 'Budget',
            data: [5000, 3000, 5000, 7000, 6000, 4000, 1000]
          },
          {
            name: 'Income',
            data: [8000, 1000, 7000, 2000, 6000, 3000, 5000]
          },
          {
            name: 'Expenses',
            data: [4000, 4000, 6000, 3000, 4000, 5000, 7000]
          },
          {
            name: 'Debt',
            data: [6000, 3000, 3000, 1000, 2000, 4000, 3000]
          }
        ]
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 550,
          title: 'Monthly Revenue',
          'format': '1,000'
        },
        yAxis: {
          title: 'Month'
        },
        xAxis: {
          title: 'Amount',
          max: 24000
        },
        series: {
          stackType: 'normal'
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
      tui.chart.barChart(container, data, options);
    })();

    (function() {
      var container = document.getElementById('tui-chart-widget-ex4');
      var data = {
        categories: ['100 ~', '90 ~ 99', '80 ~ 89', '70 ~ 79', '60 ~ 69', '50 ~ 59', '40 ~ 49', '30 ~ 39', '20 ~ 29', '10 ~ 19', '0 ~ 9'],
        series: [
          {
            name: 'Male',
            data: [3832, 38696, 395906, 1366738, 2482657, 4198869, 4510524, 3911135, 3526321, 2966126, 2362433]
          },
          {
            name: 'Female',
            data: [12550, 128464, 839761, 1807901, 2630336, 4128479, 4359815, 3743214, 3170926, 2724383, 2232516]
          }
        ]
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 550,
          title: 'Population Distribution',
          format: '1,000'
        },
        yAxis: [{
          title: 'Age Group',
          labelMargin: 15
        }, {
          title: 'Age Group',
          labelMargin: 15
        }],
        series: {
          diverging: true
        }
      };
      tui.chart.barChart(container, data, options);
    })();

    (function () {
      var container = document.getElementById('tui-chart-widget-ex5');
      var data = {
        categories: ['100 ~', '90 ~ 99', '80 ~ 89', '70 ~ 79', '60 ~ 69', '50 ~ 59', '40 ~ 49', '30 ~ 39', '20 ~ 29', '10 ~ 19', '0 ~ 9'],
        series: [
          {
            name: 'Male',
            data: [3832, 38696, 395906, 1366738, 2482657, 4198869, 4510524, 3911135, 3526321, 2966126, 2362433]
          },
          {
            name: 'Female',
            data: [12550, 128464, 839761, 1807901, 2630336, 4128479, 4359815, 3743214, 3170926, 2724383, 2232516]
          }
        ]
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 550,
          title: 'Population Distribution',
          format: '1,000'
        },
        yAxis: {
          title: 'Age Group',
          align: 'center'
        },
        xAxis: {
          labelMargin: 10
        },
        series: {
          diverging: true
        }
      };
      tui.chart.barChart(container, data, options);
    })();

    (function () {
      var container = document.getElementById('tui-chart-widget-ex6');
      var data = {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        series: [
          {
            name: 'Seoul',
            data: [[-8.3, 0.3], [-5.8, 3.1], [-0.6, 9.1], [5.8, 16.9], [11.5, 22.6], [16.6, 26.6], [21.2, 28.8], [21.8, 30.0], [15.8, 25.6], [8.3, 19.6], [1.4, 11.1], [-5.2, 3.2]]
          }
        ]
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 550,
          title: 'Temperature Range'
        },
        yAxis: {
          title: 'Month'
        },
        xAxis: {
          title: 'Temperature (Celsius)'
        },
        series: {
          showLabel: false,
          barWidth: 25
        },
        tooltip: {
          suffix: '°C'
        }
      };
      tui.chart.barChart(container, data, options);
    })();
  });
})(jQuery);
