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
      if ($("#campana").val() != null)
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
      }

      else{

        var route = "/descargadashboard1";
        var fd = new FormData(document.getElementById("buscadetallecodigos"));

       $.ajax({
        url: route,
        headers: { 'X-CSRF-Token': $('meta[name="_token"]').attr('content')},
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
              var percentComplete = (evt.loaded / evt.total) * 100;
              $('div.progress > div.progress-bar').css({ "width:" percentComplete + "%" }); }
            }, false);

       //Download progress
       xhr.addEventListener("progress", function (evt)
       {
       if (evt.lengthComputable)
        { var percentComplete = (evt.loaded / evt.total) *100;
       $("div.progress > div.progress-bar").css({ "width:" percentComplete + "%" }); } },
       false);
       return xhr;
       },
        error: function(res){

       alert(res.length);

          setTimeout(function() {
                  toastr.options = {
                      closeButton: true,
                      progressBar: true,
                      showMethod: 'slideDown',
                      timeOut: 4000
                  };
                  toastr.error('Error en pagina, consulta con el administrador', 'Error');

              }, 0);
         hide();
        },
        success: function(res){

           if(res.length == 0){

             setTimeout(function() {
                     toastr.options = {
                         closeButton: true,
                         progressBar: true,
                         showMethod: 'slideDown',
                         timeOut: 4000
                     };
                     toastr.error('No se encontraron resultados con los parametros establecidos', 'Resultados no encontrados');

                 }, 0);

             hide();
           }
           else {

                for (var i = 0; i < res.length; i++) {


                }




              setTimeout(function() {
                      toastr.options = {
                          closeButton: true,
                          progressBar: true,
                          showMethod: 'slideDown',
                          timeOut: 4000
                      };
                      toastr.success('Se encontraron: '+ res.length+ ' registros.', 'Registros encontrados');
                  }, 0);

           }

                }
              });




      }

  }


}

function isValidDate(dateString) {
  var regEx = /^\d{4}-\d{2}-\d{2}$/;
  return dateString.match(regEx) != null;
}
