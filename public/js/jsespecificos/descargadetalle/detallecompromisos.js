
$(document).ready(function(){


hide();

 });

 // termina documenta ready


// se presiona boton de buscar
function buscadetalleint(){
 // valida que se tenga algun valor en el input si no no hace nada mas que mostrar alerta
 $("#tableInteraccion").empty();
  $("#progress").show();

// busqueda de datos generales y llena vista datos generales

 var route = "/descargadashboard1";
 var token = $("#token").val();
 var fd = new FormData(document.getElementById("buscadetallecodigos"));
 var progressBar = 0;

$.ajax({
 url: route,
 headers: {'X-CSRF_TOKEN': token},
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
              toastr.error('No se encontraron resultados en las fechas establecidas', 'Verifica las fechas');

          }, 0);

      hide();
    }
    else {

         for (var i = 0; i < res.length; i++) {

         $("#tableInteraccion").append('<tr class="gradeX"><strong><td>'+res[i].fechaFin+'</td><td>'+res[i].usuario+'</td><td>'+res[i].cuenta+
         '</td><td>'+res[i].nombre+'</td><td>'+res[i].comentario+'</td><td>'+res[i].idcampana+'</td><td>'+res[i].monto+'</td><td>'+res[i].hecho+'</td></strong></tr>');
         var percenttabla = (i / res.length) *100;
         $("div.progress > div.progress-bar").css({ "width": percenttabla + "%" });
         }


                  $("#interactiontable").dataTable({
                    retrieve: true,
                      responsive: true,
                      "dom": 'T<"clear">lfrtip',
                      "tableTools": {
                          "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                      }

                  });


       show();
       setTimeout(function() {
               toastr.options = {
                   closeButton: true,
                   progressBar: true,
                   showMethod: 'slideDown',
                   timeOut: 4000
               };
               toastr.success('Se encontraron: '+ res.length+ ' registros.', 'Registros encontrados');
           }, 0);
           $("#progress").hide();
    }

         }
       });
}




   function mandaraexcel() {
   $("#interactiontable").table2excel({
     filename: "Detallecompromisos",
     fileext:".xls"
   });
 }


 function hide()
 {
   $("#interactiontable").hide()
   $("#mandaexcel").hide();
   $("#progress").hide();

 }

 function show()
 {

   $("#mandaexcel").show();
   $("#interactiontable").show();
   $("#progress").show();
 }
