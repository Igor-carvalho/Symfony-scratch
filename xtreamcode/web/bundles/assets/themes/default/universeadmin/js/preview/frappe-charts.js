(function ($) {
  'use strict';

  $(document).ready(function() {
    var typeData = {
      labels: ["12am-3am", "3am-6am", "6am-9am", "9am-12pm",
        "12pm-3pm", "3pm-6pm", "6pm-9pm", "9pm-12am"],

      yMarkers: [
        {
          label: "Marker",
          value: 43
          // type: 'dashed'
        }
      ],

      yRegions: [
        {
          label: "Region",
          start: -10,
          end: 50
        }
      ],
      datasets: [
        {
          name: "Some Data",
          values: [18, 40, 30, 35, 8, 52, 17, -4],
          axisPosition: 'right',
          chartType: 'bar'
        },
        {
          name: "Another Set",
          values: [30, 50, -10, 15, 18, 32, 27, 14],
          axisPosition: 'right',
          chartType: 'bar'
        },
        {
          name: "Yet Another",
          values: [15, 20, -3, -15, 58, 12, -17, 37],
          chartType: 'line'
        }
      ]
    };

    var chart = new Chart("#chart-ex1", { // or DOM element
      data: typeData,
      title: "My Awesome Chart",
      type: 'axis-mixed', // or 'bar', 'line', 'pie', 'percentage'
      height: 250,
      colors: ['purple', '#ffa3ef', 'red']
    });

    var fireball_5_25 = [
      [4, 0, 3, 1, 1, 2, 1, 1, 1, 0, 1, 1],
      [2, 3, 3, 2, 1, 3, 0, 1, 2, 7, 10, 4],
      [5, 6, 2, 4, 0, 1, 4, 3, 0, 2, 0, 1],
      [0, 2, 6, 2, 1, 1, 2, 3, 6, 3, 7, 8],
      [6, 8, 7, 7, 4, 5, 6, 5, 22, 12, 10, 11],
      [7, 10, 11, 7, 3, 2, 7, 7, 11, 15, 22, 20],
      [13, 16, 21, 18, 19, 17, 12, 17, 31, 28, 25, 29],
      [24, 14, 21, 14, 11, 15, 19, 21, 41, 22, 32, 18],
      [31, 20, 30, 22, 14, 17, 21, 35, 27, 50, 117, 24],
      [32, 24, 21, 27, 11, 27, 43, 37, 44, 40, 48, 32],
      [31, 38, 36, 26, 23, 23, 25, 29, 26, 47, 61, 50],
    ];
    var fireball_2_5 = [
      [22, 6, 6, 9, 7, 8, 6, 14, 19, 10, 8, 20],
      [11, 13, 12, 8, 9, 11, 9, 13, 10, 22, 40, 24],
      [20, 13, 13, 19, 13, 10, 14, 13, 20, 18, 5, 9],
      [7, 13, 16, 19, 12, 11, 21, 27, 27, 24, 33, 33],
      [38, 25, 28, 22, 31, 21, 35, 42, 37, 32, 46, 53],
      [50, 33, 36, 34, 35, 28, 27, 52, 58, 59, 75, 69],
      [54, 67, 67, 45, 66, 51, 38, 64, 90, 113, 116, 87],
      [84, 52, 56, 51, 55, 46, 50, 87, 114, 83, 152, 93],
      [73, 58, 59, 63, 56, 51, 83, 140, 103, 115, 265, 89],
      [106, 95, 94, 71, 77, 75, 99, 136, 129, 154, 168, 156],
      [81, 102, 95, 72, 58, 91, 89, 122, 124, 135, 183, 171],
    ];
    var fireballOver25 = [
      // [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
      [0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0],
      [0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0],
      [1, 1, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0],
      [0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 2],
      [3, 2, 1, 3, 2, 0, 2, 2, 2, 3, 0, 1],
      [2, 3, 5, 2, 1, 3, 0, 2, 3, 5, 1, 4],
      [7, 4, 6, 1, 9, 2, 2, 2, 20, 9, 4, 9],
      [5, 6, 1, 2, 5, 4, 5, 5, 16, 9, 14, 9],
      [5, 4, 7, 5, 1, 5, 3, 3, 5, 7, 22, 2],
      [5, 13, 11, 6, 1, 7, 9, 8, 14, 17, 16, 3],
      [8, 9, 8, 6, 4, 8, 5, 6, 14, 11, 21, 12]
    ];

    var reportCountList = [152, 222, 199, 287, 534, 709, 1179, 1256, 1632, 1856, 1850];
    var lineCompositeData = {
      labels: ["2007", "2008", "2009", "2010", "2011", "2012", "2013", "2014", "2015", "2016", "2017"],
      yMarkers: [
        {
          label: "Average 100 reports/month",
          value: 1200
        }
      ],
      datasets: [{
        "name": "Events",
        "values": reportCountList
      }]
    };

    var monthNames = ["January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"];

    var barCompositeData = {
      labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      datasets: [
        {
          name: "Over 25 reports",
          values: fireballOver25[9]
        },
        {
          name: "5 to 25 reports",
          values: fireball_5_25[9]
        },
        {
          name: "2 to 5 reports",
          values: fireball_2_5[9]
        }
      ]
    };

    var lineCompositeChart = new Chart ('#chart-ex2', {
      title: "Fireball/Bolide Events - Yearly (reported)",
      data: lineCompositeData,
      type: 'line',
      height: 270,
      colors: ['green'],
      isNavigable: 1,
      valuesOverPoints: 1,

      lineOptions: {
        dotSize: 8
      }
      // yAxisMode: 'tick'
      // regionFill: 1
    });

    var barCompositeChart = new Chart ('#chart-ex3', {
      title: "My Awesome Chart",
      data: barCompositeData,
      type: 'bar',
      height: 250,
      colors: ['violet', 'light-blue', '#46a9f9'],
      valuesOverPoints: 1,
      axisOptions: {
        xAxisMode: 'tick'
      },
      barOptions: {
        stacked: 1
      }
    });

    var args = {
      data: typeData,
      type: 'pie',
      height: 250,
      colors: ['purple', 'magenta', 'light-blue'],
      title: "My Awesome Chart",
      maxLegendPoints: 6,
      maxSlices: 10,

      tooltipOptions: {
        formatTooltipX: function (d) {
          return (d + '').toUpperCase();
        },
        formatTooltipY: function (d) {
          return d + ' pts';
        }
      }
    };
    var aggrChart = new Chart("#chart-ex4", args);

    var args2 = {
      title: "My Awesome Chart",
      data: typeData,
      type: 'percentage',
      height: 250,
      colors: ['purple', 'magenta', 'light-blue'],

      maxLegendPoints: 6,
      maxSlices: 10,

      tooltipOptions: {
        formatTooltipX: function (d) {
          return (d + '').toUpperCase();
        },
        formatTooltipY: function (d) {
          return d + ' pts';
        }
      }
    };
    var aggrChartEx5 = new Chart("#chart-ex5", args2);

    var update_data_all_labels = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun", "Mon", "Tue",
      "Wed", "Thu", "Fri", "Sat", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri",
      "Sat", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun", "Mon"];

    var getRandom = function () {
      return Math.floor(Math.random() * 75 - 15);
    };
    var update_data_all_values = Array.from({length: 30}, getRandom);

    // We're gonna be shuffling this
    var update_data_all_indices = update_data_all_labels.map(function (d,i) {
      return i;
    });

    var get_update_data = function(source_array, length)  {
      length = length || 10;
      var indices = update_data_all_indices.slice(0, length);

      return indices.map(function(index) {
        return source_array[index]
      });
    };

    var update_data = {
      labels: get_update_data(update_data_all_labels),
      datasets: [{
        "values": get_update_data(update_data_all_values)
      }],
      yMarkers: [
        {
          label: "Altitude",
          value: 25,
          type: 'dashed'
        }
      ],
      yRegions: [
        {
          label: "Range",
          start: 10,
          end: 45
        }
      ]
    };

    var update_chart = new Chart("#chart-ex6", {
      data: update_data,
      title: "My Awesome Chart",
      type: 'line',
      height: 250,
      colors: ['#ff6c03'],
      lineOptions: {
        // hideLine: 1,
        regionFill: 1
      }
    });


    var trends_data = {
      labels: [1967, 1968, 1969, 1970, 1971, 1972, 1973, 1974, 1975, 1976,
        1977, 1978, 1979, 1980, 1981, 1982, 1983, 1984, 1985, 1986,
        1987, 1988, 1989, 1990, 1991, 1992, 1993, 1994, 1995, 1996,
        1997, 1998, 1999, 2000, 2001, 2002, 2003, 2004, 2005, 2006,
        2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016] ,
      datasets: [
        {
          values: [132.9, 150.0, 149.4, 148.0,  94.4,  97.6,  54.1,  49.2,  22.5, 18.4,
            39.3, 131.0, 220.1, 218.9, 198.9, 162.4,  91.0,  60.5,  20.6,  14.8,
            33.9, 123.0, 211.1, 191.8, 203.3, 133.0,  76.1,  44.9,  25.1,  11.6,
            28.9,  88.3, 136.3, 173.9, 170.4, 163.6,  99.3,  65.3,  45.8,  24.7,
            12.6,   4.2,   4.8,  24.9,  80.8,  84.5,  94.0, 113.3,  69.8,  39.8]
        }
      ]
    };

    var plotChartArgs = {
      title: "Mean Total Sunspot Count - Yearly",
      data: trends_data,
      type: 'line',
      height: 250,
      colors: ['#238e38'],
      lineOptions: {
        hideDots: 1,
        heatline: 1
      },
      axisOptions: {
        xAxisMode: 'tick',
        yAxisMode: 'span',
        xIsSeries: 1
      }
    };

    new Chart("#chart-ex7", plotChartArgs);

    var plotChartArgs2 = {
      title: "Mean Total Sunspot Count - Yearly",
      data: trends_data,
      type: 'line',
      height: 250,
      colors: ['#238e38'],
      lineOptions: {
        hideDots: 0,
        heatline: 0,
        hideLine: 1
      },
      axisOptions: {
        xAxisMode: 'tick',
        yAxisMode: 'span',
        xIsSeries: 1
      }
    };

    new Chart("#chart-ex8", plotChartArgs2);

    var plotChartArgs3 = {
      title: "Mean Total Sunspot Count - Yearly",
      data: trends_data,
      type: 'line',
      height: 250,
      colors: ['#238e38'],
      lineOptions: {
        hideDots: 1,
        heatline: 1,
        regionFill: 1
      },
      axisOptions: {
        xAxisMode: 'tick',
        yAxisMode: 'span',
        xIsSeries: 1
      }
    };

    new Chart("#chart-ex9", plotChartArgs3);

    var plotChartArgs4 = {
      title: "Mean Total Sunspot Count - Yearly",
      data: trends_data,
      type: 'line',
      height: 250,
      colors: ['#238e38'],
      lineOptions: {
        hideDots: 1,
        heatline: 0,
        regionFill: 0
      },
      axisOptions: {
        xAxisMode: 'tick',
        yAxisMode: 'span',
        xIsSeries: 1
      }
    };

    new Chart("#chart-ex10", plotChartArgs4);


    var heatmapData = {};
    var current_date = new Date();
    var timestamp = current_date.getTime()/1000;
    timestamp = Math.floor(timestamp - (timestamp % 86400)).toFixed(1); // convert to midnight

    for (var i = 0; i< 375; i++) {
      heatmapData[parseInt(timestamp)] = Math.floor(Math.random() * 5);
      timestamp = Math.floor(timestamp - 86400).toFixed(1);
    }

    var heatmap = new Chart("#chart-ex11", {
      data: heatmapData,
      type: 'heatmap',
      title: "My Awesome Chart",
      legendScale: [0, 1, 2, 4, 5],
      height: 115,
      discreteDomains: 0
    });

    var heatmap2 = new Chart("#chart-ex12", {
      data: heatmapData,
      type: 'heatmap',
      title: "My Awesome Chart",
      legendScale: [0, 1, 2, 4, 5],
      height: 115,
      discreteDomains: 0,
      legendColors: ['#ebedf0', '#fdf436', '#ffc700', '#ff9100', '#06001c']
    });
  });
})(jQuery);
