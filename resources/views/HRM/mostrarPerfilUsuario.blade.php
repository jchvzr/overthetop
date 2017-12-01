
@extends('layouts.principal')

@section('title', 'Main page')

@section('content')

<!-- Steps -->
<script src="/js/plugins/staps/jquery.steps.min.js"></script>
<link href="css/plugins/steps/jquery.steps.css" rel="stylesheet">
<!-- Jquery Validate -->
<script src="js/plugins/validate/jquery.validate.min.js"></script>

<!-- jscript especifico -->
<script src="js/jsespecificos/HRM/mostrarperfil.js"></script>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Formulario de perfil de recursos humanos</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>

                </div>
            </div>
            <div class="ibox-content">
                <h2>
                    Visualiza los datos del usuario
                </h2>


                <form id="form" action="#" class="wizard-big">
                 <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                  <input type="hidden" id="id_usuario" name="id_usuario" value="<?=$datauser->id ?>">
                    <h1>Datos generales</h1>
                    <fieldset class="form-group">
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

                    <h1>Foto de perfil</h1>
                    <fieldset>
                        <div class="text-center" style="margin-top: 20px">
                            <h2>Vista de la foto de perfil</h2>

                          <!--<center><input type="file" id="fotoperfil" name="fotoperfil" class="form-control" accept="image/png, .jpeg, .jpg, image/gif" placeholder="Elige el archivo"> </center>-->
                          <br />
                          <output id="list"></output>
                        </div>
                      </fieldset>

                      <h1>Documentos</h1>
                      <fieldset>

                        <div class="text-center" style="margin-top: 0px">
                          <h2>Archivos del usuario</h2>

                      <!--  <input type="file" multiple="multiple" id="usuariosarchivos" name="usuariosarchivos[]" class="form-control" accept="image/png, .jpeg, .jpg, image/gif, .doc, .pdf, .docx, .xls, .xlsx"/> -->
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


@endsection
