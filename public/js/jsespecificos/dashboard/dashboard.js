$(document).ready(function(){

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



var data = [{
    label: "Sin trabajar",
    data: 48,
    color: "#d3d3d3",
},  {
    label: "Trabajados",
    data: 52,
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



});


function chosechido()
{

      $(".chosen-select").chosen({width: "100%"});
}

function buscaresultado()
{


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
      $('div.progress > div.progress-bar').css({ 'width':'0%' });
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
          var progressBar = 0;

         $.ajax({
          url: route,
          headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content')},
          type: 'post',
          data: fd,
          dataType:"json",
          cache:false,
          timeout:20000,
          processData: false,  // tell jQuery not to process the data
          contentType: false,
          async: true,
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
       },
          error: function(){
  // si da error
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

               hide();
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

                  }
                });

}


function buscapenetracion() {


            var route = "/descargadashboardpenetracion";
            var fd = new FormData(document.getElementById("formfiltro"));
            var progressBar = 0;

           $.ajax({
            url: route,
            headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content')},
            type: 'post',
            data: fd,
            dataType:"json",
            cache:false,
            timeout:20000,
            processData: false,  // tell jQuery not to process the data
            contentType: false,
            async: true,
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
         },
            error: function(){
    // si da error
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

                 hide();
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

                    }
                  });

}
