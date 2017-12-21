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

chosechido();

 });



 // termina documenta ready



  function pulsar(e) {
        tecla = (document.all) ? e.keyCode :e.which;
        return (tecla!=13);
  }



  // para select multiple

  function agregaSeleccion(origen, destino) {
            obj = document.getElementById(origen);
            if (obj.selectedIndex == -1)
                return;

            for (i = 0; opt = obj.options[i]; i++)
                if (opt.selected) {
                    valor = opt.value; // almacenar value
                    txt = obj.options[i].text; // almacenar el texto
                    obj.options[i] = null; // borrar el item si está seleccionado
                    obj2 = document.getElementById(destino);

                    opc = new Option(txt, valor,"defaultSelected");
                    eval(obj2.options[obj2.options.length] = opc);
                }

                var select = document.getElementById('dispositionSeleccionados');

                for ( var i = 0, l = select.options.length, o; i < l; i++ )
                {
                  o = select.options[i];
                    o.selected = true;
                }

                var select = document.getElementById('dispositionSeleccionadosmodal');

                for ( var i = 0, l = select.options.length, o; i < l; i++ )
                {
                  o = select.options[i];
                    o.selected = true;
                }

  }

  function agregaTodo(origen, destino) {
                obj = document.getElementById(origen);
                obj2 = document.getElementById(destino);
                aux = obj.options.length;
                for (i = 0; i < aux; i++) {
                    aux2 = 0;
                    opt = obj.options[aux2];
                valor = opt.value; // almacenar value
                txt = obj.options[aux2].text; // almacenar el texto
                obj.options[aux2] = null; // borrar el item si está seleccionado

                opc = new Option(txt, valor,"defaultSelected");
                eval(obj2.options[obj2.options.length] = opc);
            }

            var select = document.getElementById('dispositionSeleccionados');

            for ( var i = 0, l = select.options.length, o; i < l; i++ )
            {
              o = select.options[i];
                o.selected = true;
            }

            var select = document.getElementById('dispositionSeleccionadosmodal');

            for ( var i = 0, l = select.options.length, o; i < l; i++ )
            {
              o = select.options[i];
                o.selected = true;
            }


  }

  // termina para select multiple




  // guardar formulario de nueva interaccion
 function guardaformulariocatalogo(){


       $("#creacatalogo").validate({
         rules: {
           catalogo: {
             required: true,
           },
           dispositionSeleccionados: {
           required: true,
           },
           catalogodescripcion: {
           required: true,
           }
         }
       });



          if(   $("#creacatalogo").valid() == false )
          { return $("#creacatalogo").valid();}
       else {

        jsShowWindowLoad('Guardando');

         var route = "/newcatalogo/creacatalogonew";
         var token = $("#token").val();
         var fd = new FormData(document.getElementById("creacatalogo"));
         var progressBar = document.getElementById("progress");
         console.log(fd.get("catalogo"));


         $.ajax({
           url: route,
           headers: {'X-CSRF_TOKEN': token},
           type: 'POST',
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
                     toastr.success('Se agregó el catálogo', 'Catálogo guardado');

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


  function chosechido()
  {

        $(".chosen-select").chosen({width: "100%"});
  }





  function openmodal(id) {

        $("#hdnid").val(id);

        var route = "/newcatalogo/muestracatalogodisponibles/"+id;

       $.get(route, function(res){

        $("#listaDispositionmodal").empty();

        for (var i = 0; i < res.length; i++) {
          $("#listaDispositionmodal").append('<option value="'+res[i].id+'">'+res[i].nombre+'</option>');
        }

       });

        var route = "/newcatalogo/muestracatalogoseleccionados/"+id;
       $.get(route, function(res){
           $("#dispositionSeleccionadosmodal").empty();

        for (var i = 0; i < res.length; i++) {
          $("#dispositionSeleccionadosmodal").append('<option selected="selected" value="'+res[i].id+'">'+res[i].nombre+'</option>');
        }
       });

       var route = "/newcatalogo/muestracatalogonombre/"+id;

       $.get(route, function(res){

        $("#catalogomodal").val(res.nombre);
        $("#catalogodescripcionmodal").val(res.descripcion);
       });


        $("#modaledita").modal('toggle');



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
         var route = "/newcatalogo/editacatalogo/"+$("#hdnid").val();
         var token = $("#token").val();
         var fd = new FormData(document.getElementById("editacatalogomodal"));

         $.ajax({
           url: route,
           headers: {'X-CSRF_TOKEN': token},
           type: 'POST',
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
                     toastr.success('Se guardaron los cambios', 'Catalogo guardado');

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
