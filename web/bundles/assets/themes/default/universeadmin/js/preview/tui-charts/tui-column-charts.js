(function ($) {
  'use strict';

  $(document).ready(function() {
    (function() {
      var container = document.getElementById('tui-chart-widget-ex1');
      var data = {
        categories: ['June, 2015', 'July, 2015', 'August, 2015', 'September, 2015', 'October, 2015', 'November, 2015', 'December, 2015'],
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
          format: '1,000'
        },
        yAxis: {
          title: 'Amount',
          min: 0,
          max: 9000
        },
        xAxis: {
          title: 'Month'
        },
        legend: {
          align: 'top'
        }
      };
      tui.chart.columnChart(container, data, options);
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
          },
          {
            name: 'Debt',
            data: [-3000, -6000, -3000, -3000, -1000, -2000, -4000, -3000]
          }
        ]
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 650,
          title: 'Monthly Revenue',
          "format": "1,000"
        },
        yAxis: {
          title: 'Amount',
          min: -10000,
          max: 10000
        },
        xAxis: {
          title: 'Month'
        },
        legend: {
          visible: false
        }
      };
      tui.chart.columnChart(container, data, options);
    })();

    (function () {
      var container = document.getElementById('tui-chart-widget-ex3');
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
          },
          {
            name: 'Debt',
            data: [-3000, -6000, -3000, -3000, -1000, -2000, -4000, -3000]
          }
        ]
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 540,
          title: 'Monthly Revenue',
          format: '1,000'
        },
        yAxis: {
          title: 'Amount'
        },
        xAxis: {
          title: 'Month'
        },
        series: {
          stackType: 'percent',
          barWidth: 60
        },
        tooltip: {
          grouped: true
        },
        legend: {
          align: 'bottom4000'
        }
      };
      tui.chart.columnChart(container, data, options);
    })();

    (function () {
      var container = document.getElementById('tui-chart-widget-ex4');
      var data = {
        categories: ["0 ~ 9", "10 ~ 19", "20 ~ 29", "30 ~ 39", "40 ~ 49", "50 ~ 59", "60 ~ 69", "70 ~ 79", "80 ~ 89", "90 ~ 99", "100 ~"],
        series: [
          {
            name: 'Male - Seoul',
            data: [400718, 506749, 722122, 835851, 850007, 773094, 496232, 267037, 67004, 7769, 1314],
            stack: 'Male'
          },
          {
            name: 'Female - Seoul',
            data: [380595, 472893, 724408, 829149, 853032, 812687, 548381, 316142, 127406, 22177, 3770],
            stack: 'Female'
          },
          {
            name: 'Male - Incheon',
            data: [139283, 167132, 209256, 233977, 261195, 251151, 127721, 61452, 17138, 1974, 194],
            stack: 'Male'
          },
          {
            name: 'Female - Incheon',
            data: [132088, 155895, 192760, 221250, 255601, 243374, 130406, 80763, 38005, 6057, 523],
            stack: 'Female'
          }
        ]
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 540,
          title: 'Population Distribution',
          format: '1,000'
        },
        xAxis: {
          title: 'Age Group'
        },
        yAxis: {
          title: 'Amount'
        },
        series: {
          stackType: 'normal'
        },
        legend: {
          align: 'bottom'
        },
        tooltip: {
          grouped: true
        }
      };
      tui.chart.columnChart(container, data, options);
    })();

    (function () {
      var container = document.getElementById('tui-chart-widget-ex5');
      var data = {
        categories: ["0 ~ 9", "10 ~ 19", "20 ~ 29", "30 ~ 39", "40 ~ 49", "50 ~ 59", "60 ~ 69", "70 ~ 79", "80 ~ 89", "90 ~ 99", "100 ~"],
        series: [
          {
            name: 'Male - Seoul',
            data: [400718, 506749, 722122, 835851, 850007, 773094, 496232, 267037, 67004, 7769, 1314],
            stack: 'Male'
          },
          {
            name: 'Female - Seoul',
            data: [380595, 472893, 724408, 829149, 853032, 812687, 548381, 316142, 127406, 22177, 3770],
            stack: 'Female'
          },
          {
            name: 'Male - Incheon',
            data: [139283, 167132, 209256, 233977, 261195, 251151, 127721, 61452, 17138, 1974, 194],
            stack: 'Male'
          },
          {
            name: 'Female - Incheon',
            data: [132088, 155895, 192760, 221250, 255601, 243374, 130406, 80763, 38005, 6057, 523],
            stack: 'Female'
          }
        ]
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 540,
          title: 'Population Distribution',
          format: '1,000'
        },
        xAxis: {
          title: 'Age Group'
        },
        series: {
          stackType: 'normal',
          diverging: true
        },
        legend: {
          align: 'top'
        },
        tooltip: {
          grouped: true
        }
      };
      tui.chart.columnChart(container, data, options);
    })();
  });
})(jQuery);
