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
      =================================
          Revenue Yearly | Options
      =================================
  */
//   var options1 = {
//     chart: {
//       fontFamily: 'Nunito, sans-serif',
//       height: 365,
//       type: 'area',
//       zoom: {
//           enabled: false
//       },
//       dropShadow: {
//         enabled: true,
//         opacity: 0.2,
//         blur: 10,
//         left: -7,
//         top: 22
//       },
//       toolbar: {
//         show: false
//       },
//       events: {
//         mounted: function(ctx, config) {
//           const highest1 = ctx.getHighestValueInSeries(0);
//           const highest2 = ctx.getHighestValueInSeries(1);
  
//           ctx.addPointAnnotation({
//             x: new Date(ctx.w.globals.seriesX[0][ctx.w.globals.series[0].indexOf(highest1)]).getTime(),
//             y: highest1,
//             label: {
//               style: {
//                 cssClass: 'd-none'
//               }
//             },
//             customSVG: {
//                 SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#E22028" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
//                 cssClass: undefined,
//                 offsetX: -8,
//                 offsetY: 5
//             }
//           })
  
//           ctx.addPointAnnotation({
//             x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
//             y: highest2,
//             label: {
//               style: {
//                 cssClass: 'd-none'
//               }
//             },
//             customSVG: {
//                 SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#48D131" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
//                 cssClass: undefined,
//                 offsetX: -8,
//                 offsetY: 5
//             }
//           })
// 		     ctx.addPointAnnotation({
//             x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
//             y: highest2,
//             label: {
//               style: {
//                 cssClass: 'd-none'
//               }
//             },
//             customSVG: {
//                 SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#FEC147" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
//                 cssClass: undefined,
//                 offsetX: -8,
//                 offsetY: 5
//             }
//           })
//         },
//       }
//     },
//     colors: ['#E22028' , '#FEC147' , '#48D131' ],
//     dataLabels: {
//         enabled: false
//     },
//     stroke: {
//         show: true,
//         curve: 'smooth',
//         width: 2,
//         lineCap: 'square'
//     },
//     series: [ {
//         name: 'Pending',
//             data: [0,0,0,0,0,10]
//         },
//     	{
//             name: 'Need action',
//             data: [0,0,0,0,0,2]
//         },
//     	{
//             name: 'Completed',
//             data: [0,0,0,0,0,1]
//         }],
//     labels: ['2018','2019','2020','2021','2022','2023'],
//     xaxis: {
//       axisBorder: {
//         show: false
//       },
//       axisTicks: {
//         show: false
//       },
//       crosshairs: {
//         show: true
//       },
//       labels: {
//         style: {
//             fontSize: '12px',
//             fontFamily: 'Nunito, sans-serif',
//             cssClass: 'apexcharts-xaxis-title',
//         },
//       }
//     },
//     yaxis: {
//       labels: {
		  
//         style: {
//             fontSize: '12px',
//             fontFamily: 'Nunito, sans-serif',
//             cssClass: 'apexcharts-yaxis-title',
//         },
//       }
//     },
//     grid: {
//       borderColor: '#e0e6ed',
//       strokeDashArray: 5,
//       xaxis: {
//           lines: {
//               show: true
//           }
//       },   
//       yaxis: {
//           lines: {
//               show: true,
//           }
//       },
//       padding: {
//         top: 0,
//         right: 0,
//         bottom: 0,
//         left: -10
//       }, 
//     }, 
//     legend: {
//       position: 'top',
//       horizontalAlign: 'right',
//       offsetY: -50,
//       fontSize: '16px',
//       fontFamily: 'Nunito, sans-serif',
//       markers: {
//         width: 10,
//         height: 10,
//         strokeWidth: 0,
//         strokeColor: '#fff',
//         fillColors: undefined,
//         radius: 12,
//         onClick: undefined,
//         offsetX: 0,
//         offsetY: 0
//       },    
//       itemMargin: {
//         horizontal: 0,
//         vertical: 20
//       }
//     },
//     tooltip: {
//       theme: 'dark',
//       marker: {
//         show: true,
//       },
//       x: {
//         show: false,
//       }
//     },
//     fill: {
//         type:"gradient",
//         gradient: {
//             type: "vertical",
//             shadeIntensity: 1,
//             inverseColors: !1,
//             opacityFrom: .28,
//             opacityTo: .05,
//             stops: [45, 100]
//         }
//     },
//     responsive: [{
//       breakpoint: 1920,
//       options: {
// 		  chart: {
//                     height: '227px',
// 					width:'100%',
//                 },
//         legend: {
//             offsetY: -30,
//         },
//       },
//     }]
//   }
  
   /*
      =================================
          Revenue Monthly | Options
      =================================
  */
  var options1Monthly = {
    chart: {
      fontFamily: 'Nunito, sans-serif',
      height: 365,
      type: 'area',
      zoom: {
          enabled: false
      },
      dropShadow: {
        enabled: true,
        opacity: 0.2,
        blur: 10,
        left: -7,
        top: 22
      },
      toolbar: {
        show: false
      },
      events: {
        mounted: function(ctx, config) {
          const highest1 = ctx.getHighestValueInSeries(0);
          const highest2 = ctx.getHighestValueInSeries(1);
  
          ctx.addPointAnnotation({
            x: new Date(ctx.w.globals.seriesX[0][ctx.w.globals.series[0].indexOf(highest1)]).getTime(),
            y: highest1,
            label: {
              style: {
                cssClass: 'd-none'
              }
            },
            customSVG: {
                SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#E22028" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                cssClass: undefined,
                offsetX: -8,
                offsetY: 5
            }
          })
  
          ctx.addPointAnnotation({
            x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
            y: highest2,
            label: {
              style: {
                cssClass: 'd-none'
              }
            },
            customSVG: {
                SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#48D131" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                cssClass: undefined,
                offsetX: -8,
                offsetY: 5
            }
          })
		     ctx.addPointAnnotation({
            x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
            y: highest2,
            label: {
              style: {
                cssClass: 'd-none'
              }
            },
            customSVG: {
                SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#FEC147" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                cssClass: undefined,
                offsetX: -8,
                offsetY: 5
            }
          })
        },
      }
    },
    colors: ['#E22028' , '#FEC147' , '#48D131' ],
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: true,
        curve: 'smooth',
        width: 2,
        lineCap: 'square'
    },
    series: [ {
        name: 'Pending',
        data: [0,2, 4, 6, 8 , 6  , 4 ,2  ,3,5,7  ,3]
    },
	{
        name: 'Need action',
        data: [0, 3, 5, 7,4, 7  , 5 ,7 ,4,2,5 ,1]
    },
	{
        name: 'Completed',
        data: [0, 4, 8, 6,4, 2  , 1 , 3 ,5,8,4 ,3]
    }],
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    xaxis: {
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      },
      crosshairs: {
        show: true
      },
      labels: {
        style: {
            fontSize: '12px',
            fontFamily: 'Nunito, sans-serif',
            cssClass: 'apexcharts-xaxis-title',
        },
      }
    },
    yaxis: {
      labels: {
		  
        style: {
            fontSize: '12px',
            fontFamily: 'Nunito, sans-serif',
            cssClass: 'apexcharts-yaxis-title',
        },
      }
    },
    grid: {
      borderColor: '#e0e6ed',
      strokeDashArray: 5,
      xaxis: {
          lines: {
              show: true
          }
      },   
      yaxis: {
          lines: {
              show: true,
          }
      },
      padding: {
        top: 0,
        right: 0,
        bottom: 0,
        left: -10
      }, 
    }, 
    legend: {
      position: 'top',
      horizontalAlign: 'right',
      offsetY: -50,
      fontSize: '16px',
      fontFamily: 'Nunito, sans-serif',
      markers: {
        width: 10,
        height: 10,
        strokeWidth: 0,
        strokeColor: '#fff',
        fillColors: undefined,
        radius: 12,
        onClick: undefined,
        offsetX: 0,
        offsetY: 0
      },    
      itemMargin: {
        horizontal: 0,
        vertical: 20
      }
    },
    tooltip: {
      theme: 'dark',
      marker: {
        show: true,
      },
      x: {
        show: false,
      }
    },
    fill: {
        type:"gradient",
        gradient: {
            type: "vertical",
            shadeIntensity: 1,
            inverseColors: !1,
            opacityFrom: .28,
            opacityTo: .05,
            stops: [45, 100]
        }
    },
    responsive: [{
      breakpoint: 1920,
      options: {
		  chart: {
                    height: '227px',
					width:'100%',
                },
        legend: {
            offsetY: -30,
        },
      },
    }]
  }
  
  
   /*
      =================================
          Revenue weekly | Options
      =================================
  */
  var options1Weekly = {
    chart: {
      fontFamily: 'Nunito, sans-serif',
      height: 365,
      type: 'area',
      zoom: {
          enabled: false
      },
      dropShadow: {
        enabled: true,
        opacity: 0.2,
        blur: 10,
        left: -7,
        top: 22
      },
      toolbar: {
        show: false
      },
      events: {
        mounted: function(ctx, config) {
          const highest1 = ctx.getHighestValueInSeries(0);
          const highest2 = ctx.getHighestValueInSeries(1);
  
          ctx.addPointAnnotation({
            x: new Date(ctx.w.globals.seriesX[0][ctx.w.globals.series[0].indexOf(highest1)]).getTime(),
            y: highest1,
            label: {
              style: {
                cssClass: 'd-none'
              }
            },
            customSVG: {
                SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#E22028" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                cssClass: undefined,
                offsetX: -8,
                offsetY: 5
            }
          })
  
          ctx.addPointAnnotation({
            x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
            y: highest2,
            label: {
              style: {
                cssClass: 'd-none'
              }
            },
            customSVG: {
                SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#48D131" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                cssClass: undefined,
                offsetX: -8,
                offsetY: 5
            }
          })
		     ctx.addPointAnnotation({
            x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
            y: highest2,
            label: {
              style: {
                cssClass: 'd-none'
              }
            },
            customSVG: {
                SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#FEC147" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                cssClass: undefined,
                offsetX: -8,
                offsetY: 5
            }
          })
        },
      }
    },
    colors: ['#E22028' , '#FEC147' , '#48D131' ],
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: true,
        curve: 'smooth',
        width: 2,
        lineCap: 'square'
    },
    series: [ {
        name: 'Pending',
        data: [0,2, 4, 6, 8 , 6, 4 ]
    },
	{
        name: 'Need action',
        data: [0, 3, 5, 7,4, 7, 5 ]
    },
	{
        name: 'Completed',
        data: [0, 4, 8, 6,4, 2 , 1]
    }],
    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
    xaxis: {
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      },
      crosshairs: {
        show: true
      },
      labels: {
        style: {
            fontSize: '12px',
            fontFamily: 'Nunito, sans-serif',
            cssClass: 'apexcharts-xaxis-title',
        },
      }
    },
    yaxis: {
      labels: {
		  
        style: {
            fontSize: '12px',
            fontFamily: 'Nunito, sans-serif',
            cssClass: 'apexcharts-yaxis-title',
        },
      }
    },
    grid: {
      borderColor: '#e0e6ed',
      strokeDashArray: 5,
      xaxis: {
          lines: {
              show: true
          }
      },   
      yaxis: {
          lines: {
              show: true,
          }
      },
      padding: {
        top: 0,
        right: 0,
        bottom: 0,
        left: -10
      }, 
    }, 
    legend: {
      position: 'top',
      horizontalAlign: 'right',
      offsetY: -50,
      fontSize: '16px',
      fontFamily: 'Nunito, sans-serif',
      markers: {
        width: 10,
        height: 10,
        strokeWidth: 0,
        strokeColor: '#fff',
        fillColors: undefined,
        radius: 12,
        onClick: undefined,
        offsetX: 0,
        offsetY: 0
      },    
      itemMargin: {
        horizontal: 0,
        vertical: 20
      }
    },
    tooltip: {
      theme: 'dark',
      marker: {
        show: true,
      },
      x: {
        show: false,
      }
    },
    fill: {
        type:"gradient",
        gradient: {
            type: "vertical",
            shadeIntensity: 1,
            inverseColors: !1,
            opacityFrom: .28,
            opacityTo: .05,
            stops: [45, 100]
        }
    },
    responsive: [{
      breakpoint: 1920,
      options: {
		  chart: {
                    height: '227px',
					width:'100%',
                },
        legend: {
            offsetY: -30,
        },
      },
    }]
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
      ================================
          Revenue Monthly | Render
      ================================
  */
  
  
   
  
  
        

  
  
 
  
  
  

  
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
  
 