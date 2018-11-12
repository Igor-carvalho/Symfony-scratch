(function ($) {
  'use strict';

  $(document).ready(function() {
    var ecommerceWidgetDChartDom = document.getElementById("ecommerce-widget-d-chart");

    if (ecommerceWidgetDChartDom) {
      var ecommerceWidgetDChart = echarts.init(ecommerceWidgetDChartDom);
      var ecommerceWidgetDChartOptions = {
        title: null,
        legend: null,
        toolbox: null,
        tooltip: {
          show: false
        },
        grid: {
          left: 0,
          right: 0,
          bottom: 0,
          top: 0
        },
        label: false,
        series : [
          {
            type: 'pie',
            hoverAnimation: false,
            radius : '100%',
            center: ['50%', '50%'],
            selectedMode: 'single',
            selectedOffset: 0,
            label: {
              normal: {
                show: false
              }
            },
            labelLine: {
              normal: {
                show: false
              }
            },
            data:[
              {
                value:20,
                name: 'Pending',
                itemStyle: {
                  normal: {
                    color: '#9579da'
                  }
                }
              },
              {
                value:10, name: 'Abadon',
                itemStyle: {
                  normal: {
                    color: '#eb86be'
                  }
                }
              },
              {
                value:70,
                name: 'Completed',
                itemStyle: {
                  normal: {
                    color: '#f4d0b5'
                  }
                }
              }
            ]
          }
        ]
      };
      ecommerceWidgetDChart.setOption(ecommerceWidgetDChartOptions, true);
    }

    var ecommerceWidgetEChartDom = $('#ecommerce-widget-e-chart');

    if (ecommerceWidgetEChartDom.length) {
      var ecommerceWidgetEChartOptions = {
        tooltip: {
          trigger: 'axis'
        },
        title: null,
        legend: null,
        toolbox: null,
        grid: {
          top: 10,
          right: 50,
          left: 50,
          bottom: 40
        },
        xAxis: [{
          type: 'category',
          boundaryGap: false,
          data: ['Sunday','Monday','Thusday','Wednesday','Thursday','Friday','Saturday'],
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
            fontSize: 12,
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
              fontSize: 12,
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
              color: '#eb5463'
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
                color: '#3aadd9'
              }
            }
          }]
      };
      var ecommerceWidgetEChart = echarts.init(ecommerceWidgetEChartDom.get(0));
      ecommerceWidgetEChart.setOption(ecommerceWidgetEChartOptions, true);
    }
  });
})(jQuery);
