$(document).ready(function(){


    $("#wizard").steps();
    $("#form").steps({
        bodyTag: "fieldset",
        onStepChanging: function (event, currentIndex, newIndex)
        {
            // Always allow going backward even if the current step contains invalid fields!
            if (currentIndex > newIndex)
            {
                return true;
            }

            // Forbid suppressing "Warning" step if the user is to young
            if (newIndex === 3 && Number($("#age").val()) < 18)
            {
                return false;
            }

            var form = $(this);

            // Clean up if user went backward before
            if (currentIndex < newIndex)
            {
                // To remove error styles
                $(".body:eq(" + newIndex + ") label.error", form).remove();
                $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
            }

            // Disable validation on fields that are disabled or hidden.
            form.validate().settings.ignore = ":disabled,:hidden";

            // Start validation; Prevent going forward if false
            return form.valid();
        },
        onStepChanged: function (event, currentIndex, priorIndex)
        {
            // Suppress (skip) "Warning" step if the user is old enough.
            if (currentIndex === 2 && Number($("#age").val()) >= 18)
            {
                $(this).steps("next");
            }

            // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
            if (currentIndex === 2 && priorIndex === 3)
            {
                $(this).steps("previous");
            }
        },
        onFinishing: function (event, currentIndex)
        {
            var form = $(this);

            // Disable validation on fields that are disabled.
            // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
            form.validate().settings.ignore = ":disabled";

            // Start validation; Prevent form submission if false
            return form.valid();


        },
        onFinished: function (event, currentIndex)
        {
            var form = $(this);

            // Submit form input
          //  form.submit();
        }
    }).validate({
                errorPlacement: function (error, element)
                {
                    element.before(error);
                },
                rules: {
                    confirm: {
                        equalTo: "#password"
                    }
                }
            });

mostraruserp($('#id_usuario').val())

});


function mostraruserp(id) {

 $("#id_usuario").val();
 $("#nombre").val();
 $("#apellidoPaterno").val();
 $("#apellidoMaterno").val();
 $("#domicilioCalle").val();
 $("#domicilioColonia").val();
 $("#domicilisCiudad").val();
 $("#domicilioCP").val();
 $("#telefonoCasa").val();
 $("#telefonoCelular").val();
 $("#fechaNacimiento").val();
 $('#sexo').val();
 $('#curp').val();
 $('#rfc').val();
 $('#nss').val();
 $('#fechaIngreso').val();



    var id = $("#id_usuario").val();
    var route = "/muestraperfildeusuario/"+id;
    $.get(route, function(res){
      $('#id_usuario').val();
      $("#nombre").val(res.nombre);
      $("#apellidoPaterno").val(res.apellidoPaterno);
      $("#apellidoMaterno").val(res.apellidoMaterno);
      $("#domicilioCalle").val(res.domicilioCalle);
      $("#domicilioColonia").val(res.domicilioColonia);
      $("#domicilioCiudad").val(res.domicilioCiudad);
      $("#domicilioCP").val(res.domicilioCP);
      $("#telefonoCasa").val(res.telefonoCasa);
      $("#telefonoCelular").val(res.telefonoCelular);
      $("#fechaNacimiento").val(res.fechaNacimiento);
      $('#sexo').val(res.sexo);
      $('#curp').val(res.curp);
      $('#rfc').val(res.rfc);
      $('#nss').val(res.nss);
      $('#fechaIngreso').val(res.fechaIngreso);

      $("#list").empty();
      if(res.nombreunicoimagenperfil != "")
      {
      document.getElementById("list").innerHTML = ['<img class="thumb" src="/storage/imagenesusuarios/', res.nombreunicoimagenperfil,'" title="', escape(res.nombreunicoimagenperfil), '"/>'].join('');
      }
       });

       var route = "/muestraarchivosdeusuario/"+id;
       $.get(route, function(res){


         $("#sistemaarchivo").empty();

         for (var i = 0; i < res.length; i++) {

         $("#sistemaarchivo").append('<div class="file-box"><div class="file"><a href="/storage/archivoshrm/'+res[i].nombreunico+'" target="_blank"><span class="corner"></span><div class="icon"><i class="'+res[i].icono+'"></i></div><div class="file-name">'+res[i].nombrearchivo+'<br/><small>Agregado: '+res[i].created_at+'</small></div></a></div></div>');

         }



          });



};
