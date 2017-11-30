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

//chosechido();

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
          {
            return $("#creacatalogo").valid();
          }
       else {
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
           location.reload();
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

        var route = "/newcompany/muestracompany/"+id;

       $.get(route, function(res){
       $("#hdnid").val(res.id);
       $("#nombremodal").val(res.nombre);
       $("#emailmodal").val(res.email);
       $("#domiciliomodal").val(res.domicilio);
       $("#telefonomodal").val(res.telefono);
       $("#logoempresa").attr("src","/img/"+res.archivoid);

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

         var route = "/newcampaign/editacampana";
         var token = $("#token").val();
         var fd = new FormData(document.getElementById("editacampañamodal"));

         $.ajax({
           url: route,
           headers: {'X-CSRF_TOKEN': token},
           type: 'POST',
           data: fd,
           processData: false,  // tell jQuery not to process the data
           contentType: false,
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
           success: function(result){
             setTimeout(function() {
                     toastr.options = {
                         closeButton: true,
                         progressBar: true,
                         showMethod: 'slideDown',
                         timeOut: 4000
                     };
                     toastr.success('Se guardaron los cambios', 'Campaña guardada');

                 }, 1300);
            location.reload();
           }
         });

       $("#modaledita").modal('hide');
     }

      return false;
 }
