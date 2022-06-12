var options = {
  chart: {
      height: 250,
      type: 'radialBar',
      dropShadow: {
        enabled: true,
        top: 10,
        left: 0,
        bottom: 0,
        right: 0,
        blur: 2,
        color: '#45404a2e',
        opacity: 0.35
      },
  },
  plotOptions: {
      radialBar: {
          startAngle: -135,
          endAngle: 135,
          track: {
            background: '#b9c1d4',
            opacity: 0.3,            
          },
          dataLabels: {
              name: {
                  fontSize: '16px',
                  color: '#8997bd',
                  offsetY: 0
              },
              value: {
                  offsetY: 0,
                  fontSize: '40px',
                  color: '#8997bd',
                  formatter: function (val) {
                      return val + "%";
                  }
              }
          }
      }
  },
  fill: {
      gradient: {
          enabled: true,
          shade: 'dark',
          shadeIntensity: 0.15,
          inverseColors: false,
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 50, 65, 91]
      },
  },
  stroke: {
      dashArray: 2
  },
  colors: ["#727cf5"],
  series: [90],
  labels: [''],
  // responsive: [{
  //     breakpoint: 300,
  //     options: {
  //       chart: {
  //         height: 200
  //       }
  //     }
  // }]
}

var chart = new ApexCharts(
  document.querySelector("#apex_radialbar3"),
  options
);

chart.render();

var options = {
    chart: {
      height: 200,
      type: 'line',
      zoom: {
        enabled: false
      },
      toolbar: {
        show: false
      },
      dropShadow: {
        enabled: true,
        top: 10,
        left: 0,
        bottom: 0,
        right: 0,
        blur: 2,
        color: '#45404a2e',
        opacity: 0.35
      },
    },
    colors: ['#f6d365'],
    dataLabels: {
      enabled: true,
    },
    stroke: {
      width: [3, 3],
      curve: 'smooth'
    },
    series: [{
      name: "",
      data: [95, 96, 98, 99, 98, 97, 96, 99, 98, 98]
    }
    ],
    title: {
      text: 'SL WO',
      align: 'left',
      style: {
        fontSize: "14px",
        color: '#8997bd'
      }
    },
    grid: {
      row: {
        colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
        opacity: 0.2
      },
      borderColor: '#f1f3fa'
    },
    markers: {
      style: 'inverted',
      size: 6
    },
    xaxis: {
      categories: [1,2,3,4,5,6,7,8,9,10],
      axisBorder: {
        show: true,
        color: '#bec7e0',
      },  
      axisTicks: {
        show: true,
        color: '#bec7e0',
      },    
      title: {
        text: ''
      }
    },
    yaxis: {
      title: {
        text: ''
      },
    },
    legend: {
      position: 'top',
      horizontalAlign: 'right',
      floating: true,
      offsetY: -25,
      offsetX: 5
    },
    responsive: [{
      breakpoint: 600,
      options: {
        chart: {
          toolbar: {
            show: false
          }
        },
        legend: {
          show: false
        },
      }
    }]
  }
  
  var chart = new ApexCharts(
    document.querySelector("#slwo"),
    options
  );
  
  chart.render();

  var options = {
    chart: {
      height: 200,
      type: 'line',
      zoom: {
        enabled: false
      },
      toolbar: {
        show: false
      },
      dropShadow: {
        enabled: true,
        top: 10,
        left: 0,
        bottom: 0,
        right: 0,
        blur: 2,
        color: '#45404a2e',
        opacity: 0.35
      },
    },
    colors: ['#f6d365'],
    dataLabels: {
      enabled: true,
    },
    stroke: {
      width: [3, 3],
      curve: 'smooth'
    },
    series: [{
      name: "",
      data: [95, 96, 98, 99, 98, 97, 96, 99, 98, 98]
    }
    ],
    title: {
      text: 'ODS',
      align: 'left',
      style: {
        fontSize: "14px",
        color: '#8997bd'
      }
    },
    grid: {
      row: {
        colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
        opacity: 0.2
      },
      borderColor: '#f1f3fa'
    },
    markers: {
      style: 'inverted',
      size: 6
    },
    xaxis: {
      categories: [1,2,3,4,5,6,7,8,9,10],
      axisBorder: {
        show: true,
        color: '#bec7e0',
      },  
      axisTicks: {
        show: true,
        color: '#bec7e0',
      },    
      title: {
        text: ''
      }
    },
    yaxis: {
      title: {
        text: ''
      },
    },
    legend: {
      position: 'top',
      horizontalAlign: 'right',
      floating: true,
      offsetY: -25,
      offsetX: 5
    },
    responsive: [{
      breakpoint: 600,
      options: {
        chart: {
          toolbar: {
            show: false
          }
        },
        legend: {
          show: false
        },
      }
    }]
  }
  
  var chart = new ApexCharts(
    document.querySelector("#ods"),
    options
  );
  
  chart.render();

  var options = {
    chart: {
      height: 200,
      type: 'line',
      zoom: {
        enabled: false
      },
      toolbar: {
        show: false
      },
      dropShadow: {
        enabled: true,
        top: 10,
        left: 0,
        bottom: 0,
        right: 0,
        blur: 2,
        color: '#45404a2e',
        opacity: 0.35
      },
    },
    colors: ['#f6d365'],
    dataLabels: {
      enabled: true,
    },
    stroke: {
      width: [3, 3],
      curve: 'smooth'
    },
    series: [{
      name: "",
      data: [95, 96, 98, 99, 98, 97, 96, 99, 98, 98]
    }
    ],
    title: {
      text: 'TST',
      align: 'left',
      style: {
        fontSize: "14px",
        color: '#8997bd'
      }
    },
    grid: {
      row: {
        colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
        opacity: 0.2
      },
      borderColor: '#f1f3fa'
    },
    markers: {
      style: 'inverted',
      size: 6
    },
    xaxis: {
      categories: [1,2,3,4,5,6,7,8,9,10],
      axisBorder: {
        show: true,
        color: '#bec7e0',
      },  
      axisTicks: {
        show: true,
        color: '#bec7e0',
      },    
      title: {
        text: ''
      }
    },
    yaxis: {
      title: {
        text: ''
      },
    },
    legend: {
      position: 'top',
      horizontalAlign: 'right',
      floating: true,
      offsetY: -25,
      offsetX: 5
    },
    responsive: [{
      breakpoint: 600,
      options: {
        chart: {
          toolbar: {
            show: false
          }
        },
        legend: {
          show: false
        },
      }
    }]
  }
  
  var chart = new ApexCharts(
    document.querySelector("#tst"),
    options
  );
  
  chart.render();

  var options = {
    chart: {
      height: 200,
      type: 'line',
      zoom: {
        enabled: false
      },
      toolbar: {
        show: false
      },
      dropShadow: {
        enabled: true,
        top: 10,
        left: 0,
        bottom: 0,
        right: 0,
        blur: 2,
        color: '#45404a2e',
        opacity: 0.35
      },
    },
    colors: ['#f6d365'],
    dataLabels: {
      enabled: true,
    },
    stroke: {
      width: [3, 3],
      curve: 'smooth'
    },
    series: [{
      name: "",
      data: [95, 96, 98, 99, 98, 97, 96, 99, 98, 98]
    }
    ],
    title: {
      text: 'QOH',
      align: 'left',
      style: {
        fontSize: "14px",
        color: '#8997bd'
      }
    },
    grid: {
      row: {
        colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
        opacity: 0.2
      },
      borderColor: '#f1f3fa'
    },
    markers: {
      style: 'inverted',
      size: 6
    },
    xaxis: {
      categories: [1,2,3,4,5,6,7,8,9,10],
      axisBorder: {
        show: true,
        color: '#bec7e0',
      },  
      axisTicks: {
        show: true,
        color: '#bec7e0',
      },    
      title: {
        text: ''
      }
    },
    yaxis: {
      title: {
        text: ''
      },
    },
    legend: {
      position: 'top',
      horizontalAlign: 'right',
      floating: true,
      offsetY: -25,
      offsetX: 5
    },
    responsive: [{
      breakpoint: 600,
      options: {
        chart: {
          toolbar: {
            show: false
          }
        },
        legend: {
          show: false
        },
      }
    }]
  }
  
  var chart = new ApexCharts(
    document.querySelector("#qoh"),
    options
  );
  
  chart.render();

var options = {
  chart: {
    height: 370,
    type: 'line',
    stacked: false,
    toolbar: {
      show: false
    },
  },
  colors: ['#f6d365'],
  
  stroke: {
    show: true,
    width: 2,
    colors: ['transparent'],
    curve: 'smooth'
  },
  plotOptions: {
    bar: {
      horizontal: false,
      endingShape: 'rounded',
      columnWidth: '60%',
      dataLabels: {
        position: 'top', // top, center, bottom
      },
    },
    series: {
      dataLabels: {
        enabled: true,
        borderRadius: 5,
        backgroundColor: 'rgba(252, 255, 197, 0.7)',
        borderWidth: 1,
        borderColor: '#AAA',
        y: -6
      }
    },
  },

  colors: ["#5766da", "#1ecab8", "#f6d365","#f93b7a","#FF8C00"],
  series: [{
    name: 'Registrasi',
    type: 'column',
    data: [586974,656328,502734,596927,434928,430844,272268,212925,309545,327746,358697,230519,0],
  }, {
    name: 'Informasi',
    type: 'column',
    data: [1013893,987945,1143843,1212201,1181527,1341630,1418303,1296065,1418298,1723847,1508457,1650259,0],
  }, {
    name: 'Komplain',
    type: 'column',
    data: [1565263,1569481,1597126,1576605,1316809,1410038,1275643,1042097,1147443,1325531,1458103,1542220,0],
  }, {
    name: 'All Traffic',
    type: 'column',
    data: [3166130,3213754,3243703,3385733,2933264,3182512,2966214,2551087,2875286,3377124,3325257,3422998,0],
  }, {
    name: "Complain Rate",
    type: 'line',
    data: [49,49,49,47,45,44,43,41,40,39,44,45,0],
    dataLabels: {
      enabled: true,
      borderColor: 'red',
      borderWidth: 2,
      padding: 5,
      shadow: true,
      style: {
        fontWeight: 'bold'
      }
    },
  },
  ],

  title: {
    text: 'Trend Complain Rate (MyIH, Socmed, 147, Plasa)',
    align: 'left',
    style: {
      fontSize: "15px",
      color: '#000000'
    }
  },

  fill: {
    type: 'gradient',
    gradient: {
      shade: 'dark',
      shadeIntensity: 1,
      type: 'horizontal',
      opacityFrom: 1,
      opacityTo: 1,
      stops: [0, 100, 100, 100]
    },
  },

  markers: {
    size: 7,
    opacity: 0.9,
    colors: ["#FF8C00"],
    strokeColor: "#fff",
    strokeWidth: 2,
    style: 'inverted', // full, hollow, inverted
    hover: {
      size: 7,
    }
  },

  legend: {
    position: 'top',
    horizontalAlign: 'right',
    floating: true,
    offsetY: -25,
    offsetX: 5
  },
  
  xaxis: {
    categories: ["2020-11","2020-11","2020-12","2021-01","2021-02","2021-03","2021-04","2021-05","2021-06","2021-07","2021-08","2021-09","2021-10"]
  },
  
  yaxis: [
    {
      seriesName: 'All Traffic',
      axisTicks: {
        show: true
      },
      axisBorder: {
        show: true,
      },
      title: {
        text: "Parameter"
      }
    },
    {
      seriesName: 'All Traffic',
      show: false
    }, 
    {
      seriesName: 'All Traffic',
      show: false
    }, 
    {
      seriesName: 'All Traffic',
      show: false
    }, {
      opposite: true,
      seriesName: 'DataB',
      axisTicks: {
        show: true
      },
      axisBorder: {
        show: true,
      },
      title: {
        text: "Complain Rate"
      }
    }
  ],

  tooltip: {
    shared: false,
    intersect: false,
    y: {
      formatter: function (y) {
        if (typeof y !== "undefined") {
          return y.toFixed(0) + " Data";
        }
        return y;
      }
    }
  },
  
  grid: {
    borderColor: '#f1f3fa'
  },
  
  responsive: [{
    breakpoint: 600,
    options: {
      yaxis: {
        show: true
      },
      legend: {
        show: true
      }
    }
  }]
}

var chart = new ApexCharts(document.querySelector("#complain_rate"), options);
chart.render();

var options = {
  chart: {
    height: 370,
    type: 'line',
    stacked: false,
    toolbar: {
      show: false
    },
  },
  colors: ['#f6d365'],
  dataLabels: {
    enabled: true,
  },
  stroke: {
    show: true,
    width: 2,
    colors: ['transparent'],
    curve: 'smooth'
  },
  plotOptions: {
    bar: {
      horizontal: false,
      endingShape: 'rounded',
      columnWidth: '70%',
      dataLabels: {
        position: 'top', // top, center, bottom
      },
    },
  },

  colors: ["#5766da", "#1ecab8", "#f6d365","#f93b7a","#FF8C00"],
  series: [{
    name: 'Registrasi',
    type: 'column',
    data: [586974,656328,502734,596927,434928,430844,272268,212925,309545,327746,358697,230519,0],
  }, {
    name: 'Informasi',
    type: 'column',
    data: [1013893,987945,1143843,1212201,1181527,1341630,1418303,1296065,1418298,1723847,1508457,1650259,0],
  }, {
    name: 'Komplain',
    type: 'column',
    data: [1565263,1569481,1597126,1576605,1316809,1410038,1275643,1042097,1147443,1325531,1458103,1542220,0],
  }, {
    name: 'All Traffic',
    type: 'column',
    data: [3166130,3213754,3243703,3385733,2933264,3182512,2966214,2551087,2875286,3377124,3325257,3422998,0],
  }, {
    name: "Complain Rate",
    type: 'line',
    data: [49,49,49,47,45,44,43,41,40,39,44,45,0],
  },
  ],

  title: {
    text: 'Trend Complain Rate (MyIH, Socmed, 147, Plasa)',
    align: 'left',
    style: {
      fontSize: "15px",
      color: '#000000'
    }
  },

  fill: {
    type: 'gradient',
    gradient: {
      shade: 'dark',
      shadeIntensity: 1,
      type: 'horizontal',
      opacityFrom: 1,
      opacityTo: 1,
      stops: [0, 100, 100, 100]
    },
  },

  markers: {
    size: 7,
    opacity: 0.9,
    colors: ["#ffbc00"],
    strokeColor: "#fff",
    strokeWidth: 2,
    style: 'inverted', // full, hollow, inverted
    hover: {
      size: 7,
    }
  },

  legend: {
    position: 'top',
    horizontalAlign: 'right',
    floating: true,
    offsetY: -25,
    offsetX: 5
  },

  plotOptions: {
    bar: {
      horizontal: false,
      endingShape: 'rounded',
      columnWidth: '70%',
      dataLabels: {
        position: 'top', // top, center, bottom
      },
    },
  },
  
  xaxis: {
    categories: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31]
  },
  
  yaxis: [
    {
      seriesName: 'All Traffic',
      axisTicks: {
        show: true
      },
      axisBorder: {
        show: true,
      },
      title: {
        text: "Parameter"
      }
    },
    {
      seriesName: 'All Traffic',
      show: false
    }, 
    {
      seriesName: 'All Traffic',
      show: false
    }, 
    {
      seriesName: 'All Traffic',
      show: false
    }, {
      opposite: true,
      seriesName: 'DataB',
      axisTicks: {
        show: true
      },
      axisBorder: {
        show: true,
      },
      title: {
        text: "Complain Rate"
      }
    }
  ],

  tooltip: {
    shared: false,
    intersect: false,
    y: {
      formatter: function (y) {
        if (typeof y !== "undefined") {
          return y.toFixed(2) + " points";
        }
        return y;
      }
    }
  },
  
  grid: {
    borderColor: '#f1f3fa'
  },
  
  responsive: [{
    breakpoint: 600,
    options: {
      yaxis: {
        show: true
      },
      legend: {
        show: true
      }
    }
  }]
}

var chart = new ApexCharts(document.querySelector("#complain_rate_mtd"), options);
chart.render();

