$(document).ready(function() {



//  <!-- Enable portlets --
WinMove();


graficainicio();

        });

function gd(year, month, day) {
    return new Date(year, month - 1, day).getTime();
}


function filtra(btn)
{

}

function graficainicio()
{


  var route3 = "/graficoiniciodata2"
  $.get(route3, function(data2){

var datos2 = [];
  for (var i = 0; i < data2.length; i++) {
datos2[i] = [gd(data2[i].year,data2[i].month,+data2[i].day),data2[i].compromisos];
}


var datos3 = [];
  for (var i = 0; i < data2.length; i++) {
datos3[i] = [gd(data2[i].year,data2[i].month,+data2[i].day),data2[i].monto];
}


      var dataset = //[];
    [  {
          label: "Monto",
          data: datos3,
          color: "#1ab394",
          bars: {
              show: true,
              align: "center",
              barWidth: 24 * 60 * 60 * 600,
              lineWidth:0
          }

      }, {
          label: "Cantidad de compromisos",
          data: datos2,
          yaxis: 2,
          color: "#464f88",
          lines: {
              lineWidth:1,
                  show: true,
                  fill: true,
              fillColor: {
                  colors: [{
                      opacity: 0.2
                  }, {
                      opacity: 0.2
                  }]
              }
          },
          splines: {
              show: false,
              tension: 0.6,
              lineWidth: 1,
              fill: 0.1
          },
      }
    ];



      var options = {
      xaxis: {
          mode: "time",
          tickSize: [1, "day"],
          tickLength: 0,
          axisLabel: "Date",
          axisLabelUseCanvas: true,
          axisLabelFontSizePixels: 12,
          axisLabelFontFamily: 'Arial',
          axisLabelPadding: 10,
          color: "#d5d5d5"
      },
      yaxes: [{
          position: "left",
          max: 1070,
          color: "#d5d5d5",
          axisLabelUseCanvas: true,
          axisLabelFontSizePixels: 12,
          axisLabelFontFamily: 'Arial',
          axisLabelPadding: 3
      }, {
          position: "right",
          clolor: "#d5d5d5",
          axisLabelUseCanvas: true,
          axisLabelFontSizePixels: 12,
          axisLabelFontFamily: ' Arial',
          axisLabelPadding: 67
      }
      ],
      legend: {
          noColumns: 1,
          labelBoxBorderColor: "#000000",
          position: "nw"
      },
      grid: {
          hoverable: true,
          borderWidth: 0
      },
      tooltip: true,
      tooltipOpts: {
          content: "x: %x, y: %y"
      }
      };


              var previousPoint = null, previousLabel = null;

              $.plot($("#flot-dashboard-chart"), dataset, options);


  });



}
