$(document).ready(function(){

$('#todo').hide();

chosechido();
WinMove();

$('#sandbox-container .input-daterange').datepicker({
    maxViewMode: 2,
    language: "es",
    calendarWeeks: true,
    keyboardNavigation: true,
    format: "yyyy-mm-dd",
    TodayHighlight: true,

});

// Randomly Generated Data

});






function chosechido()
{
      $(".chosen-select").chosen({width: "100%"});
}

function buscaresultado()
{


$('#todo').show();
$('#rendimientocamp').hide();
$('#penetracioncamp').hide();
$('#promesascamp').hide();
$('#rendimientocampcargando').show();
$('#penetracioncampcargando').show();
$('#promesascampcargando').show();



var validainicio = isValidDate($("#start").val());

var validafin = isValidDate($("#end").val());

if ( validainicio == false || validafin == false)
{
  setTimeout(function() {
          toastr.options = {
              closeButton: true,
              progressBar: true,
              showMethod: 'slideDown',
              timeOut: 4000
          };
          toastr.error('Es necesario ingresar un rango de fecha valido,en formato: aaaa-mm-dd', 'Error en rango de fechas');

      }, 1300);

}
else{
      if ($("#campana").val() == null)
      {
        setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.error('Es necesario elegir una campaña', 'Campaña no seleccionada');

            }, 1300);

            $('div.progress > div.progress-bar').css({ 'width':'0%' });
      }

      else{

      buscarendimiento();
      $('div.progress > div.progress-bar').css({ 'width':'0%' });
      buscapenetracion();
      $('div.progress > div.progress-bar').css({ "width":"0%" });
      buscapromesas();
      var percentComplete = 0;
      $('div.progress > div.progress-bar').css({ "width": percentComplete + "%" });
      $('div.progress > div.progress-bar').attr('style', "width: 0%");

      }

  }



}

function isValidDate(dateString) {
  var regEx = /^\d{4}-\d{2}-\d{2}$/;
  return dateString.match(regEx) != null;
}


function buscarendimiento() {

          var route = "/descargadashboard1";
          var fd = new FormData(document.getElementById("formfiltro"));

         $.ajax({
          url: route,
          headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content')},
          type: 'post',
          data: fd,
          dataType:"json",
          cache:false,
          timeout:40000,
          processData: false,  // tell jQuery not to process the data
          contentType: false,
          async: true,/*
         xhr: function () {
              var xhr = new window.XMLHttpRequest();
              //Upload Progress
              xhr.upload.addEventListener("progress", function (evt) {
                 if (evt.lengthComputable) {
                var percentComplete = (evt.loaded / evt.total) * 100; $('div.progress > div.progress-bar').css({ "width": percentComplete + "%" }); } }, false);

         //Download progress
         xhr.addEventListener("progress", function (evt)
         {
         if (evt.lengthComputable)
          { var percentComplete = (evt.loaded / evt.total) *100;
         $("div.progress > div.progress-bar").css({ "width": percentComplete + "%" }); } },
         false);
         return xhr;
       },*/
          error: function(){
  // si da error
           $('#todo').hide();
            setTimeout(function() {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000
                    };
                    toastr.error('Error en pagina, consulta con el administrador', 'Error');

                }, 0);

          },
          success: function(res){
   // si no encuentra nada
             if(res.length == 0){


               setTimeout(function() {
                       toastr.options = {
                           closeButton: true,
                           progressBar: true,
                           showMethod: 'slideDown',
                           timeOut: 4000
                       };
                       toastr.warning('No se encontraron resultados con los parametros establecidos', 'Verifica las fechas y campañas');

                   }, 0);

             }
             else {

  // si tiene resultados
                   $("#codigos").empty();
                   $("#codigos").append(res.codigos);
                   $("#contactos").empty();
                   $("#contactos").append(res.contacto);
                   $("#contactospct").empty();
                   if (res.codigos == 0 ) {
                     var contactospc = "0%";
                   } else
                   {
                      var contactospc = ((( res.contacto / res.codigos).toFixed(2))*100)+"%";
                   }
                   $("#contactospct").append('Contacto / codigos: '+contactospc);
                   $("#contactospctbar").width(contactospc);
                   $("#rpc").empty();
                   $("#rpc").append(res.rpc);
                   $("#rpcpct").empty();
                   if (res.contacto == 0) {
                     var rpcpc = "0%";
                   } else
                   { var rpcpc = ((( res.rpc / res.contacto)*100).toFixed(2))+"%";
                   }
                   $("#rpcpct").append('Rpc / contacto: '+rpcpc);
                   $("#rpcpctbar").width(rpcpc);
                   $("#exito").empty();
                   $("#exito").append(res.exito);
                   $("#exitopct").empty();
                   if (res.rpc == 0) {
                     var exitopc = "0%";
                   } else
                   { var exitopc = ((( res.exito / res.rpc)*100).toFixed(2))+"%";

                   }
                   $("#exitopct").append('Exito / rpc: '+exitopc);
                   $("#exitopctbar").width(exitopc);

             }
             $('#rendimientocamp').show();
             $('#rendimientocampcargando').hide();


                  }
                });

}


function buscapenetracion() {


            var route = "/descargadashboard2";
            var fd = new FormData(document.getElementById("formfiltro"));
            var progressBar = 0;

           $.ajax({
             url: route,
             headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content')},
             type: 'post',
             data: fd,
             dataType:"json",
             cache:false,
             timeout:40000,
             processData: false,  // tell jQuery not to process the data
             contentType: false,
             async: true,/*
           xhr: function () {
                var xhr = new window.XMLHttpRequest();
                //Upload Progress
                xhr.upload.addEventListener("progress", function (evt) {
                   if (evt.lengthComputable) {
                  var percentComplete = (evt.loaded / evt.total) * 100; $('div.progress > div.progress-bar').css({ "width": percentComplete + "%" }); } }, false);

           //Download progress
           xhr.addEventListener("progress", function (evt)
           {
           if (evt.lengthComputable)
            { var percentComplete = (evt.loaded / evt.total) *100;
           $("div.progress > div.progress-bar").css({ "width": percentComplete + "%" }); } },
           false);
           return xhr;
         },*/
            error: function(){
    // si da error
     $('#todo').hide();
              setTimeout(function() {
                      toastr.options = {
                          closeButton: true,
                          progressBar: true,
                          showMethod: 'slideDown',
                          timeOut: 4000
                      };
                      toastr.error('Error en pagina, consulta con el administrador', 'Error');

                  }, 0);

            },
            success: function(res){
     // si no encuentra nada
               if(res.length == 0){

                 setTimeout(function() {
                         toastr.options = {
                             closeButton: true,
                             progressBar: true,
                             showMethod: 'slideDown',
                             timeOut: 4000
                         };
                         toastr.warning('No se encontraron resultados con los parametros establecidos', 'Verifica las fechas y campañas');

                     }, 0);

               }
               else {

    // si tiene resultados
                     $("#cargados").empty();
                     $("#cargados").append('Registros cargados: '+res.registros);
                     $("#trabajados").empty();
                     $("#trabajados").append('Registros trabajados: '+res.trabajados);

                     var data = [{
                         label: "Sin trabajar",
                         data: ((( (res.registros-res.trabajados)/res.registros)*100).toFixed(2)),
                         color: "#d3d3d3",
                     },  {
                         label: "Trabajados",
                         data: ((( res.trabajados/res.registros)*100).toFixed(2)),
                         color: "#1ab394",
                     }];

                     var plotObj = $.plot($("#flot-pie-chart"), data, {
                         series: {
                             pie: {
                               innerRadius: 0.5,
                                 show: true
                             }
                         },
                         grid: {
                             hoverable: true
                         },
                         tooltip: true,
                         tooltipOpts: {
                             content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                             shifts: {
                                 x: 20,
                                 y: 0
                             },
                             defaultTheme: false
                         }
                  });

                  $('#penetracioncamp').show();
                  $('#penetracioncampcargando').hide();

               }

                    }
                  });

}

function buscapromesas() {

  var route = "/descargadashboardpromesas";
  var fd = new FormData(document.getElementById("formfiltro"));
  var progressBar = 0;

  $.ajax({
   url: route,
   headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content')},
   type: 'post',
   data: fd,
   dataType:"json",
   cache:false,
   timeout:40000,
   processData: false,  // tell jQuery not to process the data
   contentType: false,
   async: true,/*
  xhr: function () {
       var xhr = new window.XMLHttpRequest();
       //Upload Progress
       xhr.upload.addEventListener("progress", function (evt) {
          if (evt.lengthComputable) {
         var percentComplete = (evt.loaded / evt.total) * 100; $('div.progress > div.progress-bar').css({ "width": percentComplete + "%" }); } }, false);

  //Download progress
  xhr.addEventListener("progress", function (evt)
  {
  if (evt.lengthComputable)
   { var percentComplete = (evt.loaded / evt.total) *100;
  $("div.progress > div.progress-bar").css({ "width": percentComplete + "%" }); } },
  false);
  return xhr;
},*/
   error: function(){
// si da error
 $('#todo').hide();
     setTimeout(function() {
             toastr.options = {
                 closeButton: true,
                 progressBar: true,
                 showMethod: 'slideDown',
                 timeOut: 4000
             };
             toastr.error('Error en pagina, consulta con el administrador', 'Error');

         }, 0);

   },
   success: function(data2){
// si no encuentra nada
      if(data2.length == 0){

        setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.warning('No se encontraron promesas de pago con los parametros establecidos', 'Sin promesas de pago');

            }, 0);


      }
      else {
//$('#promesascamp').show();
// si tiene resultados

var datos2 = [];
  for (var i = 0; i < data2.length; i++) {
datos2[i] = [gd(data2[i].year,data2[i].month,+data2[i].day),data2[i].compromisos];
}

 var max = 0;

var datos3 = [];
  for (var i = 0; i < data2.length; i++) {
datos3[i] = [gd(data2[i].year,data2[i].month,+data2[i].day),data2[i].monto];

if (data2[i].monto > max )
{
  max = data2[i].monto;
}


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
          max: max,
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
      }

      $('#promesascampcargando').hide();
      $('#promesascamp').show();
           }
         });



}


function gd(year, month, day) {
    return new Date(year, month - 1, day).getTime();
}

function jsRemoveWindowLoad() {
    // eliminamos el div que bloquea pantalla
    $("#WindowLoad").remove();

}

function jsShowWindowLoad(mensaje) {
    //eliminamos si existe un div ya bloqueando
    jsRemoveWindowLoad();

    //si no enviamos mensaje se pondra este por defecto
    if (mensaje === undefined) mensaje = "Procesando la información<br>Espere por favor";

    //centrar imagen gif
    height = 20;//El div del titulo, para que se vea mas arriba (H)
    var ancho = 0;
    var alto = 0;

    //obtenemos el ancho y alto de la ventana de nuestro navegador, compatible con todos los navegadores
    if (window.innerWidth == undefined) ancho = window.screen.width;
    else ancho = window.innerWidth;
    if (window.innerHeight == undefined) alto = window.screen.height;
    else alto = window.innerHeight;

    //operación necesaria para centrar el div que muestra el mensaje
    var heightdivsito = alto/9 - parseInt(height)/9;//Se utiliza en el margen superior, para centrar

   //imagen que aparece mientras nuestro div es mostrado y da apariencia de cargando
    imgCentro = "<div style='text-align:center;height:" + alto + "px;'><div  style='color:#000;margin-top:" + heightdivsito + "px; font-size:20px;font-weight:bold'>" + mensaje + "</div><img  src='img/ajax-loader.gif'></div>";

        //creamos el div que bloquea grande------------------------------------------
        div = document.createElement("div");
        div.id = "WindowLoad"
        div.style.width = ancho + "px";
        div.style.height = alto + "px";
        $("body").append(div);

        //creamos un input text para que el foco se plasme en este y el usuario no pueda escribir en nada de atras
        input = document.createElement("input");
        input.id = "focusInput";
        input.type = "text"

        //asignamos el div que bloquea
        $("#WindowLoad").append(input);

        //asignamos el foco y ocultamos el input text
        $("#focusInput").focus();
        $("#focusInput").hide();

        //centramos el div del texto
        $("#WindowLoad").html(imgCentro);

}
