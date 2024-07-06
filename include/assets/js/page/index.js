if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}
$(function() {
    "use strict";

  
    $(document).ready(function() {

        var options = {
            series: [
                {
                    name: 'Purchase',
                    data: [0.4, 0.65, 0.76, 0.88, 1.5, 2.1, 2.9, 4.1, 4.2, 4.5, 3.9, 3.5, 3
                ]},{
                    name: 'Sell',
                    data: [-0.8, -1.05, -1.06, -1.18, -1.4, -2.2, -4.4, -4.1, -4, -4.1, -3.4, -3.1, -2.8
                ]}
            ],
            chart: {
                type: 'bar',
                height: 300,
                stacked: true,
                toolbar: {
                    show: false,
                },
            },
            colors: ['var(--chart-color2)', 'var(--chart-color3)'],
            plotOptions: {
                bar: {
                    horizontal: true,
                    barHeight: '80%',
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 1,
                colors: ["#fff"]
            },
            
            grid: {
                xaxis: {
                    lines: {
                        show: false
                    }
                }
            },
            yaxis: {
                min: -5,
                max: 5,
                title: {
                    // text: 'Age',
                },
            },
            tooltip: {
            shared: false,
                x: {
                    formatter: function (val) {
                        return val
                    }
                },
                y: {
                    formatter: function (val) {
                        return Math.abs(val) + "%"
                    }
                }
            },
            xaxis: {
                categories: ['70+', '56-70', '36-55', '21-35', '10-20','0-9'],
                labels: {
                    formatter: function (val) {
                        return Math.abs(Math.round(val)) + "%"
                    }
                }
            },
        };

        var chart = new ApexCharts(document.querySelector("#apex-GenderOverview"), options);
        chart.render();

    });

    //online and off line
    $(document).ready(function() {
        var options = {
            series: [{
                name: "Online Shopping",
                data: [15, 19, 11, 17, 21, 18, 20],
            },{
                name: 'Offline Shopping',
                data: [12, 15, 14, 16, 18, 13, 17],
            }],

            chart: {
                height: 270,
                type: 'line', // line , bar
                
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                position: 'top', // top, bottom
                horizontalAlign: 'right', // left, right
            },
            stroke: {
                width: 2,
                curve: 'smooth' // straight, smooth
            },
            yaxis: {
                show: false,
            },
            xaxis: {
                categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            }
        };

        var chart = new ApexCharts(document.querySelector("#apex-shoppingstatus"), options);
        chart.render();
    });





});

function myMap() {

    let map;

    
      map = new google.maps.Map(document.getElementById("googleMap"), {
        center: new google.maps.LatLng(-33.91722, 151.23064),
        zoom: 16,
      });
      const iconBase =
        "http://pixelwibes.com/template/ebazar/html/dist/assets/images/";
      const icons = {
        emb: {
          icon: iconBase + "shop.png",
        }
      };
      const features = [
        {
          position: new google.maps.LatLng(-33.91721, 151.2263),
          type: "emb",
        },
        {
          position: new google.maps.LatLng(-33.91539, 151.2282),
          type: "emb",
        },
        {
          position: new google.maps.LatLng(-33.91747, 151.22912),
          type: "emb",
        },
        {
          position: new google.maps.LatLng(-33.9191, 151.22907),
          type: "emb",
        },
        {
          position: new google.maps.LatLng(-33.91725, 151.23011),
          type: "emb",
        },
        {
          position: new google.maps.LatLng(-33.91872, 151.23089),
          type: "emb",
        },
        {
          position: new google.maps.LatLng(-33.91784, 151.23094),
          type: "emb",
        },
        {
          position: new google.maps.LatLng(-33.91682, 151.23149),
          type: "emb",
        },
        {
          position: new google.maps.LatLng(-33.9179, 151.23463),
          type: "emb",
        },
        {
          position: new google.maps.LatLng(-33.91666, 151.23468),
          type: "emb",
        },
        {
          position: new google.maps.LatLng(-33.916988, 151.23364),
          type: "emb",
        },
        {
          position: new google.maps.LatLng(-33.91662347903106, 151.22879464019775),
          type: "emb",
        },
        {
          position: new google.maps.LatLng(-33.916365282092855, 151.22937399734496),
          type: "emb",
        },
        {
          position: new google.maps.LatLng(-33.91665018901448, 151.2282474695587),
          type: "emb",
        },
        {
          position: new google.maps.LatLng(-33.919543720969806, 151.23112279762267),
          type: "emb",
        },
        {
          position: new google.maps.LatLng(-33.91608037421864, 151.23288232673644),
          type: "emb",
        },
        {
          position: new google.maps.LatLng(-33.91851096391805, 151.2344058214569),
          type: "emb",
        },
        {
          position: new google.maps.LatLng(-33.91818154739766, 151.2346203981781),
          type: "emb",
        },
        {
          position: new google.maps.LatLng(-33.91727341958453, 151.23348314155578),
          type: "emb",
        },
      ];
    
      // Create markers.
      for (let i = 0; i < features.length; i++) {
        const marker = new google.maps.Marker({
          position: features[i].position,
          icon: icons[features[i].type].icon,
          map: map,
        });
      }
 

}
