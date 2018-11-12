(function ($) {
  'use strict';

  $(document).ready(function() {
    (function () {
      var container = document.getElementById('tui-chart-widget-ex1');
      var data = {
        categories: ["June", "July", "Aug", "Sep", "Oct", "Nov"],
        series: [
          {
            name: 'Budget',
            data: [5000, 3000, 5000, 7000, 6000, 4000]
          },
          {
            name: 'Income',
            data: [8000, 8000, 7000, 2000, 5000, 3000]

          },
          {
            name: 'Expenses',
            data: [4000, 4000, 6000, 3000, 4000, 5000]
          },
          {
            name: 'Debt',
            data: [6000, 3000, 3000, 1000, 2000, 4000]
          }
        ]
      };
      var options = {
        chart: {
          title: 'Annual Incomes',
          width: container.getBoundingClientRect().width,
          height: 700
        },
        series: {
          showDot: false,
          showArea: false
        },
        plot: {
          type: 'circle'
        },
        legend: {
          align: 'bottom'
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

      tui.chart.radialChart(container, data, options);
    })();
  });
})(jQuery);
