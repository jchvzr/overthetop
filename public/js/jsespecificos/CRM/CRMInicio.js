$(document).ready(function(){

/*
  $('.dataTables-example').dataTable({
      responsive: true,
      "dom": 'T<"clear">lfrtip',
      "tableTools": {
          "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
      }
  });
*/

chosechido();

  $('#monto').keypress(function(tecla) {
      if(tecla.charCode < 48 || tecla.charCode > 57) return false;
      //((tecla.charCode < 97 || tecla.charCode > 122) && (tecla.charCode < 65 || tecla.charCode > 90) && (tecla.charCode != 45))
  });


  $(function () {

  // inicia datetimepicker
      $('#datetimepicker12').datetimepicker({
          format : "dd/MM/yyyy hh:mm",
          inline: true,
          sideBySide: true
      });


  });

  // esconde pagina mientras no tenga datos
  hidediv()
  limpiamodalcarga()

// se presiona boton de buscar
$("#buscacliente").click(function(){
 // valida que se tenga algun valor en el input si no no hace nada mas que mostrar alerta
 $("#tableInteraccion").empty();
if($("#buscaclientetxt").val() == "")
  {
    setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
            toastr.error('Es necesario ingresar un numero de cuenta', 'Escribe cuenta');

        }, 1300);
        hidediv()
  }
// si tiene valor el input realiza la busqueda de datos
 else{

// busqueda de datos generales y llena vista datos generales
 var idcliente = $("#buscaclientetxt").val();
 var route = "/buscacliente/"+idcliente;
$.get(route, function(res){

limpiamodalcarga()
showdiv()

// manda datos a primera vista
 $("#customerid").val(res.customerid);
 $("#nombreCliente").val(res.nombreCliente);
 $("#calleCasa").val(res.calleCasa);
 $("#coloniaCasa").val(res.coloniaCasa);
 $("#ciudadCasa").val(res.ciudadCasa);
 $("#cpCasa").val(res.cpCasa);
 $("#calleTrabajo").val(res.calleTrabajo);
 $("#coloniaTrabajo").val(res.coloniaTrabajo);
 $("#ciudadTrabajo").val(res.ciudadTrabajo);
 $("#cpTrabajo").val(res.cpTrabajo);
 $("#telefono1").val(res.telefono1);
 $("#telefono2").val(res.telefono2);
 $("#telefono3").val(res.telefono3);
 $("#telefono4").val(res.telefono4);
 $("#custom1").val(res.custom1);
 $("#custom2").val(res.custom2);
 $("#custom3").val(res.custom3);
 $("#custom4").val(res.custom4);
 $("#custom5").val(res.custom5);
 $("#custom6").val(res.custom6);
 $("#custom7").val(res.custom7);
 $("#custom8").val(res.custom8);
 $("#custom9").val(res.custom9);
 $("#custom10").val(res.custom10);
// manda datos a seguna vista
 $("#customerid2").val(res.customerid);
 $("#customerid3").val(res.customerid);
 $("#nombreCliente2").val(res.nombreCliente);
// manda datos a modal
// manda datos a seguna vista
 $("#customeridmodal").val(res.customerid);
 $("#nombreClienteModal").val(res.nombreCliente);



 var route3 = "/buscacatalogocampaña/"+res.idcampana;
 $.get(route3, function(res){
 $("#dispositions").empty();

 for (var i = 0; i < res.length; i++) {

 $("#dispositions").append('<option value="'+res[i].id+'">'+res[i].nombre+'</option>');

 }
$("#dispositions").trigger("chosen:updated");
});


// valida si la busqueda no tuvo resultados se manda alerta
 if($("#customerid").val() == "")
 {

 setTimeout(function() {
         toastr.options = {
             closeButton: true,
             progressBar: true,
             showMethod: 'slideDown',
             timeOut: 4000
         };
         toastr.error('Valida el numero de cuenta', 'Cliente no encontrado');

     }, 1300);
     hidediv()
   }

// si hubo resultado hace consulta de llenado de tabla indicadores
else
   {
    $("#buscaclientetxt").val('');

    // llenado de tabla de interacciones

      var route2 = "/buscaclienteinteraccion/"+idcliente;
      $.get(route2, function(res){
      $("#tableInteraccion").empty();

      for (var i = 0; i < res.length; i++) {

      $("#tableInteraccion").append('<tr class="gradeX"><strong><td>'+res[i].fechaInteraccion+'</td><td>'+res[i].tipo+
      '</td><td>'+res[i].usuario+'</td><td>'+res[i].nombre+'</td><td>'+res[i].comentario+'</td></strong></tr>');


      }

      $("#interactiontable").dataTable({
        retrieve: true,
          responsive: true,
          "dom": 'T<"clear">lfrtip',
          "tableTools": {
              "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
          }

      });

/*
      $('.dataTables-example').dataTable({
          responsive: true,
          "dom": 'T<"clear">lfrtip',

      });*/
    });


    var route3 = "/buscaclienteinteraccionresumen/"+idcliente;
    $.get(route3, function(res){
      //Flot Bar Chart

      var barOptions = {
          series: {
              bars: {
                  show: true,
                  barWidth: 0.6,
                  fill: true,
                  fillColor: {
                      colors: [{
                          opacity: 0.8
                      }, {
                          opacity: 0.8
                      }]
                  }
              }
          },
          xaxis: {
              mode: "categories",
              tickDecimals: 0,
              tickLength: 1
          },
          colors: ["#1ab394"],
          grid: {
              color: "#999999",
              hoverable: true,
              clickable: true,
              tickColor: "#D4D4D4",
              borderWidth:0
          },
          legend: {
              show: false
          },
          tooltip: true,
          tooltipOpts: {
              content: "x: %x, y: %y"
          }
      };

      $.plot($("#flot-bar-chart"), [res], barOptions);


    });




   }
// Termina validacion de resultado

//         $("#pruebasjquery").html(res);

   });


}
chosechido();
 });


// busqueda de telefonos

$("#buscatelefonobtn").click(function(){



  if($("#buscatelinput").val() == "" || $("#buscatelinput").val().length != 10)
   {
     setTimeout(function() {
             toastr.options = {
                 closeButton: true,
                 progressBar: true,
                 showMethod: 'slideDown',
                 timeOut: 4000
             };
             toastr.error('Es necesario ingresar un número de teléfono a 10 digitos', 'Escribe teléfono');

         }, 0);

   }
  // si tiene valor el input realiza la busqueda de datos
  else{

  // busqueda de datos generales y llena vista datos generales
  var telcliente = $("#buscatelinput").val();
  var route = "/buscatelefono/"+telcliente;
  $.get(route, function(res){

  $("#clientetablebody").empty();

   if(res.length == 0)
   {

     //$('#buscatelefonomodal').modal('toggle');
    // $('#buscatelefonomodal').modal('show');
    // $('#myModal').modal('hide');

    setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.error('No se encontró ningún resultado con ese teléfono', 'Teléfono no encontrado');

            }, 0);

   }
   else{

     $("#buscatelefonomodal").toggle();
     $("#buscatelefonomodal").show();

    for (var i = 0; i < res.length; i++) {

    $("#clientetablebody").append('<tr class="gradeX" onclick="iracliente(\''+res[i].customerid+'\');"><strong><td>'+res[i].customerid+'</td><td>'+res[i].nombreCliente+'</td></strong></tr>');

    }

    setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Da click en el cliente a buscar', 'Teléfono encontrado');

            }, 0);
}

   });
 }
 });






// cambio en combo de tipo de interacciones borra el valor vacio

$("#tipoInte").change(function() {

  //$("#tipoInte option[value='']").remove();

            });

// cambio en combo de codigo
$("#dispositions").change(function() {

  //  borra el valor vacio

  //$("#dispositions option[value='']").remove();
  var dispid = $("#dispositions").val();
  var route3 = "/liberadiv/"+dispid;
  $.get(route3, function(res){

    if(res.compromiso == 1)
    {
      $("#compromiso").show();
      $("#divmonto").hide();
      $("#divmonto").show();
      $('#monto').removeAttr('disabled');
    }
    else
    {
      $("#compromiso").hide();
      $('#monto').attr('disabled','disabled');
    }

      });

            });


 //  OBSERVE TAB CHANGE
 jQuery("#tab-3").on("shown.bs.tab", function() {
   alert("vivo");
  var data = jQuery(this).data();
  if (data.chart !== undefined) {
    chart.validateSize();
  }
 });

 });


 // termina documenta ready

 // funciones extra

 // guardar formulario de nueva interaccion
 function guardainteraccion(){

$("#formagregainteraccion").validate().settings.ignore = ":disabled";

   if(   $("#formagregainteraccion").valid() == false )
   { return $("#formagregainteraccion").valid();}

   else {

    $('#fechapp').val($('#datetimepicker12').data("DateTimePicker").date().format("YYYY/MM/DD hh:mm"));

  }

 }





  function hidediv()
  {

    $("#datos").hide();
    $("#bitacora").hide();
    $("#compromiso").hide();
    $("#divmonto").hide();
    $("#graficocodificaciones").hide();
    $('#monto').attr('disabled','disabled');

  }


  function pulsar(e) {
    // averiguamos el código de la tecla pulsada (keyCode para IE y which para Firefox)
    tecla = (document.all) ? e.keyCode :e.which;
    // si la tecla no es 13 devuelve verdadero,  si es 13 devuelve false y la pulsación no se ejecuta
    return (tecla!=13);
  }

  function showdiv()
  {
    $("#datos").show();
    $("#bitacora").show();
    $("#graficocodificaciones").show();
    document.getElementById("elementobuscado").click();
  }

  function limpiamodalcarga()
  {
    $("#customeridmodal").val("");
    $("#nombreClienteModalmodal").val("");
    $("#comentario").val("");
    $("#monto").val("0");

    var select = document.getElementById('tipoInte');
    o = select.options[0];
      o.selected = true;

    var select = document.getElementById('dispositions');
    o = select.options[0];
        o.selected = true;

  }

  function chosechido()
  {

        $(".chosen-select").chosen({width: "100%"});
  }


  function cierramodal()
  {
       $("#buscatelefonomodal").toggle();
  }


  // ir a cliente al dar click en tableInteraccion

   function iracliente(id){
     $("#buscatelefonomodal").toggle();
     $("#buscatelinput").val("");
     $("#buscaclientetxt").val(id);
     $("#buscacliente").click();
   }
