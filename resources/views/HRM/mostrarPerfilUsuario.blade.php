
@extends('layouts.principal')

@section('title', 'Main page')

@section('content')

<!-- Steps -->
<script src="/js/plugins/staps/jquery.steps.min.js"></script>
<link href="css/plugins/steps/jquery.steps.css" rel="stylesheet">
<!-- Jquery Validate -->
<script src="js/plugins/validate/jquery.validate.min.js"></script>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Formulario para creaci&oacute;n de perfil de recursos humanos</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>

                </div>
            </div>
            <div class="ibox-content">
                <h2>
                    Llena los datos del usuario
                </h2>
                <p>
                    Es necesario llenar todos los que llevan (*).
                </p>

                <form id="form" action="#" class="wizard-big">
                 <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                  <input type="hidden" id="id_usuario" name="id_usuario" value="">
                    <h1>Datos generales</h1>
                    <fieldset class="form-group">
                      <div class="row">
                        <center>
                          <div class="col-lg-3"></div>
                           <div class="col-lg-6">
                            <div class="form-group">
                              <label>Elige usuario *</label>
                              <select id="eligeusuario" name="eligeusuario" class="form-control required">
                                <option value="" ></option>
                               <?php foreach ($usuarios as $user): ?>
                                <option value=<?=$user->id ?> ><?=$user->email ?></option>
                               <?php endforeach ?>
                              </select>
                            </div>
                          </div>
                      </center>
                      </div>
                        <div class="row">
                          <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nombre *</label>
                                    <input id="nombre" name="nombre" type="text" class="form-control required" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Apellido paterno *</label>
                                    <input id="apellidoPaterno" name="apellidoPaterno" type="text" class="form-control required" disabled="disabled">
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Apellido Materno *</label>
                                    <input id="apellidoMaterno" name="apellidoMaterno" type="text" class="form-control required" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Sexo *</label>
                                    <select id="sexo" name="sexo" class="form-control required" disabled="disabled">
                                      <option value=1 selected="selected">Masculino</option>
                                      <option value=2>Femenino</option>
                                    </select>
                                </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group">
                                  <label>fecha de nacimiento *</label>
                                  <input id="fechaNacimiento" name="fechaNacimiento" type="date" class="form-control required" disabled="disabled">
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                  <label>fecha de ingreso *</label>
                                  <input id="fechaIngreso" name="fechaIngreso" type="date" class="form-control required" disabled="disabled">
                              </div>
                            </div>
                          </div>

                    </div>
                    </fieldset>

                    <h1>Domicilio</h1>
                    <fieldset>
                        <div class="row">
                          <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Calle y n&uacute;mero *</label>
                                    <input id="domicilioCalle" name="domicilioCalle" type="text" class="form-control required" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Colonia *</label>
                                    <input id="domicilioColonia" name="domicilioColonia" type="text" class="form-control required" disabled="disabled">
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Ciudad *</label>
                                    <input id="domicilioCiudad" name="domicilioCiudad" type="text" class="form-control required" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Codigo postal *</label>
                                    <input id="domicilioCP" name="domicilioCP" type="text" class="form-control required" disabled="disabled">
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Tel&eacute;fono casa *</label>
                                    <input id="telefonoCasa" name="telefonoCasa" type="text" class="form-control required" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Tel&eacute;fono celular *</label>
                                    <input id="telefonoCelular" name="telefonoCelular" type="text" class="form-control required" disabled="disabled">
                                </div>
                            </div>
                          </div>

                        </div>
                    </fieldset>

                    <h1>Imagen</h1>
                    <fieldset>
                        <div class="text-center" style="margin-top: 120px">
                            <h2>Area de carga de imagen</h2>
                        </div>
                      </fieldset>

                      <h1>Documentos</h1>
                      <fieldset>
                        <div class="text-center" style="margin-top: 120px">
                            <h2>Area de carga de documentos</h2>
                        </div>
                      </fieldset>

                    <h1>Identificadores</h1>
                    <fieldset>
                      <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>CURP *</label>
                                <input id="curp" name="curp" type="text" class="form-control required" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>RFC *</label>
                                <input id="rfc" name="rfc" type="text" class="form-control required" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>NSS *</label>
                                <input id="nss" name="nss" type="text" class="form-control required" disabled="disabled">
                            </div>
                        </div>
                      </div>

                    </fieldset>
                </form>
            </div>
        </div>
        </div>
</div>


<script>
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



       $("#eligeusuario").change(function() {

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


         $("#eligeusuario option[value='']").remove();
            var id = $("#eligeusuario").val();
            var route = "/muestraperfildeusuario/"+id;
            $.get(route, function(res){
              $('#id_usuario').val($('#eligeusuario').val());
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



               });
       });


   });
</script>

@endsection
