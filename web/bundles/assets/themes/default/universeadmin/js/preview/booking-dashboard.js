(function ($) {
  'use strict';

  $(document).ready(function() {
    var bdWidgetOverviewChartDom = $('#bd-widget-overview-chart');

    if (bdWidgetOverviewChartDom.length) {
      var bdWidgetOverviewChartOptions = {
        tooltip: {
          trigger: 'axis'
        },
        title: null,
        legend: null,
        toolbox: null,
        grid: {
          top: 10,
          right: 60,
          left: 60,
          bottom: 40
        },
        xAxis: [{
          type: 'category',
          boundaryGap: false,
          data: ['21 Jun','22 Jun','23 Jun','24 Jun','25 Jun','26 Jun','27 Jun'],
          axisLine: {
            lineStyle: {
              color: '#e9ebee'
            }
          },
          axisTick: {
            show: false
          },
          splitLine: {
            lineStyle: {
              color: '#e9ebee'
            }
          },
          axisLabel: {
            margin: 20,
            fontFamily: 'Open Sans',
            fontSize: 14,
            color: '#939daa'
          }
        }],
        yAxis : [
          {
            splitLine: {
              lineStyle: {
                color: '#e9ebee'
              }
            },
            axisLine: {
              lineStyle: {
                color: '#e9ebee'
              }
            },
            axisTick: {
              show: false
            },
            max: 800,
            min: 0,
            axisLabel: {
              fontFamily: 'Open Sans',
              fontSize: 14,
              color: '#939daa'
            }
          }
        ],
        series: [{
            type:'line',
            data:[700, 532, 601, 534, 490, 730, 600],
            showSymbol: false,
            lineStyle: {
              normal: {
                color: '#2DC1D3'
              }
            }
          },
          {
            type:'line',
            data:[500, 382, 491, 334, 290, 330, 310],
            showSymbol: false,
            lineStyle: {
              normal: {
                color: '#A7CF7A'
              }
            }
          },
          {
            type:'line',
            data:[150, 232, 101, 154, 190, 530, 110],
            showSymbol: false,
            lineStyle: {
              normal: {
                color: '#C26FAB'
              }
            }
          }]
      };
      var bdWidgetOverviewChart = echarts.init(bdWidgetOverviewChartDom.get(0));
      bdWidgetOverviewChart.setOption(bdWidgetOverviewChartOptions, true);
    }

    var bdWidgetMostBookedChartDom = $('#bd-widget-most-booked-chart');

    if (bdWidgetMostBookedChartDom.length) {
      var bdWidgetMostBookedChartOptions = {
        color: ['#269af1'],
        tooltip : {
          trigger: 'axis',
          axisPointer : {
            type : 'shadow'
          }
        },
        grid: {
          top: 30,
          left: 25,
          right: 40,
          bottom: 20,
          containLabel: true
        },
        xAxis : [
          {
            type : 'category',
            data : ['10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00'],
            axisTick: {
              show: false
            },
            splitLine: {
              lineStyle: {
                color: '#e9ebee'
              }
            },
            axisLine: {
              lineStyle: {
                color: '#e9ebee'
              }
            },
            axisLabel: {
              margin: 20,
              fontFamily: 'Open Sans',
              fontSize: 14,
              color: '#939daa'
            }
          }
        ],
        yAxis : [
          {
            type : 'value',
            axisTick: {
              show: false
            },
            splitLine: {
              lineStyle: {
                color: '#e9ebee'
              }
            },
            axisLine: {
              lineStyle: {
                color: '#e9ebee'
              }
            },
            axisLabel: {
              margin: 20,
              fontFamily: 'Open Sans',
              fontSize: 14,
              color: '#939daa'
            }
          }
        ],
        series : [
          {
            type:'bar',
            barWidth: '50%',
            data:[12, 10, 6, 9, 17, 8, 3, 8, 19, 8],
            label: {
              normal: {
                show: true,
                position: 'insideTop'
              }
            }
          }
        ]
      };
      var bdWidgetMostBookedChart = echarts.init(bdWidgetMostBookedChartDom.get(0));
      bdWidgetMostBookedChart.setOption(bdWidgetMostBookedChartOptions, true);
    }

    var stepGoalChartDom = document.getElementById("bg-widget-donut-stats-chart");

    if (stepGoalChartDom) {
      var stepGoalChart = echarts.init(stepGoalChartDom);
      var stepGoalChartOptions = {
        legend: null,
        series: [
          {
            name:'1',
            type:'pie',
            hoverAnimation: false,
            radius: ['75%', '100%'],
            avoidLabelOverlap: false,
            label: false,
            labelLine: {
              normal: {
                show: false
              }
            },
            data:[
              {
                value: 15,
                name:'1',
                itemStyle: {
                  normal: {
                    color: '#35ae47'
                  }
                }
              },
              {
                value: 15,
                name:'2',
                itemStyle: {
                  normal: {
                    color: '#eb3b48'
                  }
                }
              },
              {
                value: 15,
                name:'3',
                itemStyle: {
                  normal: {
                    color: '#7552e0'
                  }
                }
              },
              {
                value: 15,
                name:'3',
                itemStyle: {
                  normal: {
                    color: '#269af1'
                  }
                }
              },
              {
                value: 40,
                name:'3',
                itemStyle: {
                  normal: {
                    color: '#f4b631'
                  }
                }
              }
            ]
          }
        ]
      };
      stepGoalChart.setOption(stepGoalChartOptions, true);
    }

    var bdWidgetTopCountriesChartDom = $('#bd-widget-top-countries-chart');

    if (bdWidgetTopCountriesChartDom.length) {
      var bdWidgetTopCountriesChartOptions = {
        color: ['#269af1'],
        tooltip : {
          trigger: 'axis',
          axisPointer : {
            type : 'shadow'
          }
        },
        grid: {
          top: 30,
          left: 25,
          right: 40,
          bottom: 20,
          containLabel: true
        },
        xAxis : [
          {
            type : 'category',
            data : ['UK', 'Lithuana', 'Mexico', 'US', 'Malaysia'],
            axisTick: {
              show: false
            },
            splitLine: {
              lineStyle: {
                color: '#e9ebee'
              }
            },
            axisLine: {
              lineStyle: {
                color: '#e9ebee'
              }
            },
            axisLabel: {
              margin: 20,
              fontFamily: 'Open Sans',
              fontSize: 14,
              color: '#939daa'
            }
          }
        ],
        yAxis : [
          {
            type : 'value',
            axisTick: {
              show: false
            },
            splitLine: {
              lineStyle: {
                color: '#e9ebee'
              }
            },
            axisLine: {
              lineStyle: {
                color: '#e9ebee'
              }
            },
            axisLabel: {
              margin: 20,
              fontFamily: 'Open Sans',
              fontSize: 14,
              color: '#939daa'
            }
          }
        ],
        series : [
          {
            type:'bar',
            barWidth: '50%',
            data:[12, 10, 6, 9, 17],
            itemStyle: {
              normal: {
                color: function (item) {
                  if (item.name == 'UK') {
                    return '#35ae47';
                  } else if (item.name == 'Lithuana') {
                    return '#eb3b48';
                  } else if (item.name == 'Mexico') {
                    return '#7552e0';
                  } else if (item.name == 'US') {
                    return '#269af1';
                  } else if (item.name == 'Malaysia') {
                    return '#f4b631';
                  }
                }
              }
            }
          }
        ]
      };
      var bdWidgetTopCountriesChart = echarts.init(bdWidgetTopCountriesChartDom.get(0));
      bdWidgetTopCountriesChart.setOption(bdWidgetTopCountriesChartOptions, true);
    }

    var bdWidgetClientDatabaseChartDom = $('#bd-widget-client-database-chart');

    if (bdWidgetClientDatabaseChartDom.length) {
      var bdWidgetClientDatabaseChartOptions = {
        tooltip: {
          trigger: 'axis'
        },
        title: null,
        legend: null,
        toolbox: null,
        grid: {
          top: 10,
          right: 40,
          left: 55,
          bottom: 40
        },
        xAxis: [{
          type: 'category',
          boundaryGap: false,
          data: ['21 Jun','22 Jun','23 Jun','24 Jun','25 Jun','26 Jun','27 Jun'],
          axisLine: {
            lineStyle: {
              color: '#e9ebee'
            }
          },
          axisTick: {
            show: false
          },
          splitLine: {
            lineStyle: {
              color: '#e9ebee'
            }
          },
          axisLabel: {
            show: false
          }
        }],
        yAxis : [
          {
            splitLine: {
              lineStyle: {
                color: '#e9ebee'
              }
            },
            axisLine: {
              lineStyle: {
                color: '#e9ebee'
              }
            },
            axisTick: {
              show: false
            },
            max: 800,
            min: 0,
            axisLabel: {
              fontFamily: 'Open Sans',
              fontSize: 14,
              color: '#939daa'
            }
          }
        ],
        series: [{
          type:'line',
          data:[400, 532, 601, 334, 490, 230, 600],
          showSymbol: false,
          lineStyle: {
            normal: {
              color: '#47C7D8'
            }
          }
        }]
      };
      var bdWidgetClientDatabaseChart = echarts.init(bdWidgetClientDatabaseChartDom.get(0));
      bdWidgetClientDatabaseChart.setOption(bdWidgetClientDatabaseChartOptions, true);
    }
  });
})(jQuery);
