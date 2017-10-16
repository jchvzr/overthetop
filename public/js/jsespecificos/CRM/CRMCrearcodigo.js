$(document).ready(function(){

  $('#monto').keypress(function(tecla) {
      if(tecla.charCode < 48 || tecla.charCode > 57) return false;
      //((tecla.charCode < 97 || tecla.charCode > 122) && (tecla.charCode < 65 || tecla.charCode > 90) && (tecla.charCode != 45))
  });




  $('.dataTables-example').dataTable({
      responsive: true,
      "dom": 'T<"clear">lfrtip',
      "tableTools": {
          "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
      }
  });



 });



 // termina documenta ready

 // funciones extra

 // guardar formulario de nueva interaccion
function guardaformulariocodigo(){


$("#creacodigo").validate({
  rules: {
    codigo: {
      required: true,
    },
    dispositionTratamiento: {
		required: true,
	  }
  }
});



   if(   $("#creacodigo").valid() == false )
   { return $("#creacodigo").valid();}
else {


  var route = "/CRM/creacodigo/";
  var token = $("#token").val();
  var fd = new FormData(document.getElementById("creacodigo"));
  var progressBar = document.getElementById("progress");



  $.ajax({
    url: route,
    headers: {'X-CSRF_TOKEN': token},
    type: 'post',
    data: fd,
    processData: false,  // tell jQuery not to process the data
    contentType: false,
    success: function(){
      setTimeout(function() {
              toastr.options = {
                  closeButton: true,
                  progressBar: true,
                  showMethod: 'slideDown',
                  timeOut: 4000
              };
              toastr.success('Se agrego el codigo', 'Codigo guardado');

          }, 1300);
      location.reload();
    }
  });


  }





 }


 function openmodal(id) {


   var route = "/newcode/mostrarcodigo/"+id;
  $.get(route, function(res){

  $("#hdnid").val(id);
  $('#codigomodal').val(res.nombre);


  $("input:checkbox").each(function() {



  if (this.name ==  "modalcontacto"){


  if(res.contacto == 1){

     this.checked = true;
  }
  else{

     this.checked = false;
  }
}
if (this.name ==  "modalrpc") {
  if(res.rpc == 1){

         this.checked = true;
      }
      else{

         this.checked = false;
      }
    }
if (this.name ==  "modalexito") {
  if(res.exito == 1){

         this.checked = true;
      }
      else{

         this.checked = false;
      }
   }
});




   $("#modaldispositionTratamiento").empty();

   $("#modaldispositionTratamiento").append('<option selected="selected" value="'+res.id_dispositionTratamiento+'">'+res.tratamiento+'</option>');

   var route = "/newcode/mostrartratamiento/"+id;
  $.get(route, function(res){
   for (var i = 0; i < res.length; i++) {
     $("#modaldispositionTratamiento").append('<option value="'+res[i].id+'">'+res[i].tratamiento+'</option>');
   }
  });

   $("#modaledita").modal('toggle');

 });

}



function cerrarmodal() {


  var x = confirm("Estas seguro de cerrar sin guardar cambios?");

  if (x){

  $("#modaledita").modal('hide');
}

 return false;

}


 function guardacambio() {

     var x = confirm("Estas seguro de guardar los cambios?");

     if (x){


       var route = "/newcode/editacodigo/"+$("#hdnid").val();
       var token = $("#token").val();
       var fd = new FormData(document.getElementById("editacodigomodal"));

       $.ajax({
         url: route,
         headers: {'X-CSRF_TOKEN': token},
         type: 'post',
         data: fd,
         processData: false,  // tell jQuery not to process the data
         contentType: false,

         success: function(result){
           setTimeout(function() {
                   toastr.options = {
                       closeButton: true,
                       progressBar: true,
                       showMethod: 'slideDown',
                       timeOut: 4000
                   };
                   toastr.success('Se guardaron los cambios', 'Codigo guardado');

               }, 1300);
          location.reload();
         }
       });



     $("#modaledita").modal('hide');
   }

    return false;


 }




  function pulsar(e) {
    tecla = (document.all) ? e.keyCode :e.which;
    return (tecla!=13);
  }
