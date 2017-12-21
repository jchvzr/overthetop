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


jsShowWindowLoad('Guardando');

  var route = "/newcode/creacodigo";
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
           jsRemoveWindowLoad()
      location.reload();
    },
       error: function(){
         setTimeout(function() {
                 toastr.options = {
                     closeButton: true,
                     progressBar: true,
                     showMethod: 'slideDown',
                     timeOut: 4000
                 };
                 toastr.error('No se guardo cambio', 'Error de conexion');

             }, 1300);
          jsRemoveWindowLoad()
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

       jsShowWindowLoad('Guardando');

       var route = "/newcode/editacodigo";
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
                jsRemoveWindowLoad()
          location.reload();
         },
            error: function(){
              setTimeout(function() {
                      toastr.options = {
                          closeButton: true,
                          progressBar: true,
                          showMethod: 'slideDown',
                          timeOut: 4000
                      };
                      toastr.error('No se guardo cambio', 'Error de conexion');

                  }, 1300);
               jsRemoveWindowLoad()
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
      imgCentro = "<div style='text-align:center;height:" + alto + "px;'><div  style='color:#000;margin-top:" + heightdivsito + "px; font-size:20px;font-weight:bold'>" + mensaje + "</div></br>"+
      "<div id='rendimientocampcargando' class='cargando'><div>.</div><div>.</div><div>.</div><div>A</div><div>R</div><div>E</div><div>P</div><div>S</div><div>E</div></div></br><img  src='img/load.gif'></div>";

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
