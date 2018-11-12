(function ($) {
  'use strict';

  $(document).ready(function() {
    (function () {
      var container = document.getElementById('tui-chart-widget-ex1');
      var data = {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        series: [
          {
            name: 'Seoul',
            data: [20, 40, 25, 50, 15, 45, 33, 34]
          },
          {
            name: 'Sydney',
            data: [5, 30, 21, 18, 59, 50, 28, 33]
          },
          {
            name: 'Moskva',
            data: [30, 5, 18, 21, 33, 41, 29, 15]
          }
        ]
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 540,
          title: '24-hr Average Temperature'
        },
        series: {
          zoomable: true,
          showDot: false,
          areaOpacity: 1
        },
        yAxis: {
          title: 'Temperature (Celsius)',
          pointOnColumn: true
        },
        xAxis: {
          title: 'Month'
        },
        tooltip: {
          suffix: '°C'
        }
      };
      tui.chart.areaChart(container, data, options);
    })();

    (function () {
      var container = document.getElementById('tui-chart-widget-ex2');
      var data = {
        categories: ['June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        series: [
          {
            name: 'Budget',
            data: [5000, 3000, 5000, 7000, 6000, 4000, 1000]
          },
          {
            name: 'Income',
            data: [8000, 4000, 7000, 2000, 6000, 3000, 5000]
          },
          {
            name: 'Expenses',
            data: [4000, 4000, 6000, 3000, 4000, 5000, 7000]
          },
          {
            name: 'Debt',
            data: [3000, 4000, 3000, 1000, 2000, 4000, 3000]
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
          title: 'Amount',
          max: 24000,
          pointOnColumn: true
        },
        xAxis: {
          title: 'Month'
        },
        series: {
          stackType: 'normal',
          showDot: false,
          areaOpacity: 1
        },
        tooltip: {
          grouped: true
        }
      };
      tui.chart.areaChart(container, data, options);
    })();

    (function () {
      var container = document.getElementById('tui-chart-widget-ex3');
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
          height: 540,
          title: 'Temperature Range'
        },
        yAxis: {
          title: 'Month',
          pointOnColumn: true
        },
        xAxis: {
          title: 'Temperature (Celsius)'
        },
        series: {
          showLabel: true
        }
      };
      var chart = tui.chart.areaChart(container, data, options);
    })();

    (function () {
      function getRandom(start, end) {
        return start + (Math.floor(Math.random() * (end - start + 1)));
      }

      function zeroFill(number) {
        var filledNumber;

        if (number < 10) {
          filledNumber = '0' + number;
        } else {
          filledNumber = number;
        }

        return filledNumber;
      }

      function adjustTime(time, addTime) {
        addTime = addTime || 60;
        if (time < 0) {
          time += addTime;
        }
        return time;
      }

      function makeDate(hour, minute, second) {
        return zeroFill(adjustTime(hour, 24)) + ':' + zeroFill(adjustTime(minute)) + ':' + zeroFill(adjustTime(second));
      }

      function makeDivisionTime(time) {
        time = Math.abs(time);
        var share = parseInt(time / 60, 10) || 1;

        if (time % 60 === 0) {
          share += 1;
        }

        return share;
      }

      var legends = ['SiteA'];
      var seriesData = tui.util.map(tui.util.range(1), function (value, index) {
        var name = legends[index];
        var data = tui.util.map(tui.util.range(100), function () {
          return getRandom(150, 200);
        });
        return {
          name: name,
          data: data
        };
      });
      var baseNow = new Date();
      var startSecond = baseNow.getSeconds() - seriesData[0].data.length - 1;
      var categories = tui.util.map(seriesData[0].data, function (value, index) {
        var hour = baseNow.getHours();
        var minute = baseNow.getMinutes();
        var second = startSecond + index;

        if (second < 0) {
          minute -= makeDivisionTime(second);
          second = second % 60;
        }

        if (minute < 0) {
          hour -= makeDivisionTime(minute);
        }
        return makeDate(hour, minute, second);
      });
      var container = document.getElementById('tui-chart-widget-ex4');
      var data = {
        categories: categories,
        series: seriesData
      };
      var options = {
        chart: {
          width: container.getBoundingClientRect().width,
          height: 540,
          title: 'Concurrent users'
        },
        xAxis: {
          title: 'seconds',
          tickInterval: 'auto'
        },
        yAxis: {
          title: 'users',
          suffix: 'Users',
          pointOnColumn: true
        },
        series: {
          spline: true,
          zoomable: true
        }
      };
      var chart = tui.chart.areaChart(container, data, options);
    })();

    (function () {
      var container = document.getElementById('tui-chart-widget-ex5');
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
          height: 540,
          title: 'Temperature Range'
        },
        yAxis: {
          title: 'Month',
          pointOnColumn: true
        },
        xAxis: {
          title: 'Temperature (Celsius)'
        },
        series: {
          showLabel: true,
          zoomable: true
        },
        plot: {
          lines: [{
            value: 'May',
            color: '#ff5a46'
          }, {
            value: 'Aug',
            color: '#00a9ff'
          }],
          bands: [{
            range: [['Apr', 'June'], ['May', 'July']],
            color: '#ffb840',
            opacity: 0.15
          }, {
            range: [['Sep', 'Nov'], ['Oct', 'Dec']],
            color: '#19bc9c',
            opacity: 0.15,
            mergeOverlappingRanges: true
          }, {
            range: ['Jan', 'Mar'],
            color: '#4b96e6',
            opacity: 0.15
          }]
        }
      };
      var chart = tui.chart.areaChart(container, data, options);
    })();
  });
})(jQuery);
