try {

  /*
      ==============================
      |    @Options Charts Script   |
      ==============================
  */
  
  /*
      =============================
          Daily Sales | Options
      =============================
  */
      var d_2options1 = {
        chart: {
              height: 160,
              type: 'bar',
              stacked: true,
              stackType: '100%',
              toolbar: {
                show: false,
              }
          },
          dataLabels: {
              enabled: false,
          },
          stroke: {
              show: true,
              width: 1,
          },
          colors: ['#e2a03f', '#e0e6ed'],
          responsive: [{
              breakpoint: 480,
              options: {
                  legend: {
                      position: 'bottom',
                      offsetX: -10,
                      offsetY: 0
                  }
              }
          }],
          series: [{
              name: 'Sales',
              data: [44, 55, 41, 67, 22, 43, 21]
          },{
              name: 'Last Week',
              data: [13, 23, 20, 8, 13, 27, 33]
          }],
          xaxis: {
              labels: {
                  show: false,
              },
              categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'],
          },
          yaxis: {
              show: false
          },
          fill: {
              opacity: 1
          },
          plotOptions: {
              bar: {
                  horizontal: false,
                  columnWidth: '25%',
                  
              }
          },
          legend: {
              show: false,
          },
          grid: {
              show: false,
              xaxis: {
                  lines: {
                      show: false
                  }
              },
              padding: {
                top: 10,
                right: 0,
                bottom: -40,
                left: 0
              }, 
          },
      }
  
  /*
      =============================
          Total Orders | Options
      =============================
  */ 
  var d_2options2 = {
    chart: {
      id: 'sparkline1',
      group: 'sparklines',
      type: 'area',
      height: 290,
      sparkline: {
        enabled: true
      },
    },
    stroke: {
        curve: 'smooth',
        width: 2
    },
    fill: {
      opacity: 1,
    },
    series: [{
      name: 'Sales',
      data: [28, 40, 36, 52, 38, 60, 38, 52, 36, 40]
    }],
    labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
    yaxis: {
      min: 0
    },
    grid: {
      padding: {
        top: 125,
        right: 0,
        bottom: 0,
        left: 0
      }, 
    },
    tooltip: {
      x: {
        show: false,
      },
      theme: 'dark'
    },
    colors: ['#1abc9c']
  }

  

      
     
      
      
    
  /*
      ==================================
          Sales By Category | Options
      ==================================
  */

  var options = {
        chart: {
            type: 'donut',
            width: 380
        },
        colors: ['#5c1ac3', '#e2a03f', '#e7515a', '#e2a03f'],
        dataLabels: {
          enabled: false
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            fontSize: '14px',
            markers: {
              width: 10,
              height: 10,
            },
            itemMargin: {
              horizontal: 0,
              vertical: 8
            }
        },
        plotOptions: {
          pie: {
            donut: {
              size: '65%',
              background: 'transparent',
              labels: {
                show: true,
                name: {
                  show: true,
                  fontSize: '29px',
                  fontFamily: 'Nunito, sans-serif',
                  color: undefined,
                  offsetY: -10
                },
                value: {
                  show: true,
                  fontSize: '26px',
                  fontFamily: 'Nunito, sans-serif',
                  color: '20',
                  offsetY: 16,
                  formatter: function (val) {
                    return val
                  }
                },
                total: {
                  show: true,
                  showAlways: true,
                  label: 'Total',
                  color: '#888ea8',
                  formatter: function (w) {
                    return w.globals.seriesTotals.reduce( function(a, b) {
                      return a + b
                    }, 0)
                  }
                }
              }
            }
          }
        },
        stroke: {
          show: true,
          width: 25,
        },
        series: [985, 737, 270],
        labels: ['Apparel', 'Sports', 'Others'],
        responsive: [{
            breakpoint: 1599,
            options: {
                chart: {
                    width: '350px',
                    height: '400px'
                },
                legend: {
                    position: 'bottom'
                }
            },
    
            breakpoint: 1439,
            options: {
                chart: {
                    width: '250px',
                    height: '390px'
                },
                legend: {
                    position: 'bottom'
                },
                plotOptions: {
                  pie: {
                    donut: {
                      size: '65%',
                    }
                  }
                }
            },
        }]
  }
  
  /*
      ==============================
      |    @Render Charts Script    |
      ==============================
  */
  
  
  /*
      ============================
          Daily Sales | Render
      ============================
  */
  var d_2C_1 = new ApexCharts(document.querySelector("#daily-sales"), d_2options1);
  d_2C_1.render();
  
  /*
      ============================
          Total Orders | Render
      ============================
  */
  var d_2C_2 = new ApexCharts(document.querySelector("#total-orders"), d_2options2);
  d_2C_2.render();
  

  
  /*
      =================================
          Sales By Category | Render
      =================================
  */
  var chart = new ApexCharts(
      document.querySelector("#chart-2"),
      options
  );
  
  chart.render();
  
  /*
      =============================================
          Perfect Scrollbar | Recent Activities
      =============================================
  */
 $('.mt-container').each(function(){ const ps = new PerfectScrollbar($(this)[0]); });
  
  const topSellingProduct = new PerfectScrollbar('.widget-table-three .table-scroll table', {
    wheelSpeed:.5,
    swipeEasing:!0,
    minScrollbarLength:40,
    maxScrollbarLength:100,
    suppressScrollY: true
  
  });
  
  } catch(e) {
      console.log(e);
  }

