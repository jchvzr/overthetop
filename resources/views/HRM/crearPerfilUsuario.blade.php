
@extends('layouts.principal')

@section('title', 'Main page')

@section('content')

<!-- Steps -->
<script src="/js/plugins/staps/jquery.steps.min.js"></script>
<link href="css/plugins/steps/jquery.steps.css" rel="stylesheet">
<!-- Jquery Validate -->
<script src="js/plugins/validate/jquery.validate.min.js"></script>

<!-- Chosen -->
<script src="js/plugins/chosen/chosen.jquery.js"></script>
<link href="css/plugins/chosen/chosen.css" rel="stylesheet">

<!-- jscript especifico -->
<script src="js/jsespecificos/HRM/createUserView.js"></script>

<style>
.thumb {
height: 300px;
border: 1px solid #000;
margin: 10px 5px 0 0;
}
</style>

    <!-- DROPZONE -->
        <link href="css/plugins/dropzone/basic.css" rel="stylesheet">
    <script src="js/plugins/dropzone/dropzone.js"></script>


    <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Wizard with Validation</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="#">Config option 1</a>
                                        </li>
                                        <li><a href="#">Config option 2</a>
                                        </li>
                                    </ul>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <h2>
                                    Validation Wizard Form
                                </h2>
                                <p>
                                    This example show how to use Steps with jQuery Validation plugin.
                                </p>

                                <form id="form" action="#" class="wizard-big">
                                    <h1>Account</h1>
                                    <fieldset>
                                        <h2>Account Information</h2>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label>Username *</label>
                                                    <input id="userName" name="userName" type="text" class="form-control required">
                                                </div>
                                                <div class="form-group">
                                                    <label>Password *</label>
                                                    <input id="password" name="password" type="text" class="form-control required">
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirm Password *</label>
                                                    <input id="confirm" name="confirm" type="text" class="form-control required">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="text-center">
                                                    <div style="margin-top: 20px">
                                                        <i class="fa fa-sign-in" style="font-size: 180px;color: #e5e5e5 "></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </fieldset>
                                    <h1>Profile</h1>
                                    <fieldset>
                                        <h2>Profile Information</h2>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>First name *</label>
                                                    <input id="name" name="name" type="text" class="form-control required">
                                                </div>
                                                <div class="form-group">
                                                    <label>Last name *</label>
                                                    <input id="surname" name="surname" type="text" class="form-control required">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Email *</label>
                                                    <input id="email" name="email" type="text" class="form-control required email">
                                                </div>
                                                <div class="form-group">
                                                    <label>Address *</label>
                                                    <input id="address" name="address" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <h1>Warning</h1>
                                    <fieldset>
                                        <div class="text-center" style="margin-top: 120px">
                                            <h2>You did it Man :-)</h2>
                                        </div>
                                    </fieldset>

                                    <h1>Finish</h1>
                                    <fieldset>
                                        <h2>Terms and Conditions</h2>
                                        <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms">I agree with the Terms and Conditions.</label>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                        </div>

                    </div>
                </div>











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
                <div class="row">
                  <center>
                    <div class="col-lg-3"></div>
                     <div class="col-lg-6">
                      <div class="form-group">
                        <label>Elige usuario a modificar</label>
                        <select id="eligeusuario" name="eligeusuario" class="chosen-select form-control required">
                          <option value="" ></option>
                         <?php foreach ($usuarios as $user): ?>
                          <option value=<?=$user->id ?> ><?=$user->email ?></option>
                         <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                </center>
                </div>
                <form id="form" method="post" accept-charset="UTF-8" action="/guardaperfildeusuario" class="wizard-big" enctype="multipart/form-data" >
                 <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                  <input type="hidden" id="id_usuario" name="id_usuario" value="">
                    <h1>Datos generales</h1>
                    <fieldset class="form-group">

                        <div class="row">
                          <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nombre *</label>
                                    <input id="nombre" name="nombre" type="text" class="form-control required">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Apellido paterno *</label>
                                    <input id="apellidoPaterno" name="apellidoPaterno" type="text" class="form-control required">
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Apellido Materno *</label>
                                    <input id="apellidoMaterno" name="apellidoMaterno" type="text" class="form-control required">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Sexo *</label>
                                    <select id="sexo" name="sexo" class="form-control required">
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
                                  <input id="fechaNacimiento" name="fechaNacimiento" type="date" class="form-control required">
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                  <label>fecha de ingreso *</label>
                                  <input id="fechaIngreso" name="fechaIngreso" type="date" class="form-control required">
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
                                    <input id="domicilioCalle" name="domicilioCalle" type="text" class="form-control required">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Colonia *</label>
                                    <input id="domicilioColonia" name="domicilioColonia" type="text" class="form-control required">
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Ciudad *</label>
                                    <input id="domicilioCiudad" name="domicilioCiudad" type="text" class="form-control required">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Codigo postal *</label>
                                    <input id="domicilioCP" name="domicilioCP" type="text" class="form-control required">
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Tel&eacute;fono casa *</label>
                                    <input id="telefonoCasa" name="telefonoCasa" type="text" class="form-control required">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Tel&eacute;fono celular *</label>
                                    <input id="telefonoCelular" name="telefonoCelular" type="text" class="form-control required">
                                </div>
                            </div>
                          </div>

                        </div>
                    </fieldset>

                    <h1>Foto de perfil</h1>
                    <fieldset>
                        <div class="text-center" style="margin-top: 20px">
                            <h2>Carga/cambia la foto de perfil</h2>
                            <p>
                                Es necesario terminar con el formulario una vez elegida la imagen.
                            </p>
                          <center><input type="file" id="fotoperfil" name="fotoperfil" class="form-control" accept="image/png, .jpeg, .jpg, image/gif" placeholder="Elige el archivo"> </center>
                          <br />
                          <output id="list"></output>
                        </div>
                      </fieldset>

                      <h1>Documentos</h1>
                      <fieldset>

                        <div class="text-center" style="margin-top: 0px">
                          <h2>Agregar archivos</h2>
                          <p>
                              Es necesario terminar con el formulario para cargar y ver los archivos elegidos.
                          </p>
                        <input type="file" multiple="multiple" id="usuariosarchivos" name="usuariosarchivos[]" class="form-control" accept="image/png, .jpeg, .jpg, image/gif, .doc, .pdf, .docx, .xls, .xlsx"/>
                       </br>
                       <h2>Ver archivos</h2>
                          <div class="file-manager">
                          <div class="clearfix"></div>
                          </div>
                          <div class="col-lg-12 animated fadeInRight">
                                              <div class="row">
                                                  <div class="col-lg-12" id="sistemaarchivo">



                                                  </div>
                                              </div>
                                      </div>



                        </div>
                      </fieldset>

                    <h1>Identificadores</h1>
                    <fieldset>
                      <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>CURP *</label>
                                <input id="curp" name="curp" type="text" class="form-control required">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>RFC *</label>
                                <input id="rfc" name="rfc" type="text" class="form-control required">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>NSS *</label>
                                <input id="nss" name="nss" type="text" class="form-control required">
                            </div>
                        </div>
                      </div>

                    </fieldset>
                </form>
            </div>
        </div>
        </div>
</div>



@endsection
