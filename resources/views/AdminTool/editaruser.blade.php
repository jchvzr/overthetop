
@extends('layouts.principal')

@section('title', 'Main page')

@section('content')


<!-- Steps -->
<script src="/js/plugins/staps/jquery.steps.min.js"></script>
<link href="/css/plugins/steps/jquery.steps.css" rel="stylesheet">
<!-- Jquery Validate -->
<script src="/js/plugins/validate/jquery.validate.min.js"></script>
<!-- Script especifico de la pagina -->
<script src="/js/jsespecificos/admintool/editUserView.js"> </script>

<!-- Chosen -->
<script src="js/plugins/chosen/chosen.jquery.js"></script>
<link href="css/plugins/chosen/chosen.css" rel="stylesheet">

</br>

<center>
@if(Session::has('flash_message'))
<script>


setTimeout(function() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };
        toastr.success('{{Session::get('flash_message')}}', 'Se guardo el cambio');

    }, 0);

alert ('{{Session::get('flash_message')}}')
</script>

@endif
</center>

@if($errors->has())
    <div class="alert alert-warning" role="alert">
       @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
      @endforeach
    </div>
@endif </br>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Formulario para edicion de usuario</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <h2>
                    Selecciona un usuario
                </h2>

                  <select class="chosen-select form-control required" id="eligeusuario" name="eligeusuario" required >
                    <option ></option>
                     <?php foreach ($userview as $userv): ?>
                      <option value=<?=$userv->id ?> ><?=$userv->usuario ?></option>
                     <?php endforeach ?>
                  </select>


                <form id="form" action="/edituserstore" class="wizard-big"method="post" accept-charset="UTF-8" enctype="multipart/form-data">

                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  <input type="hidden" name="id_usuario" id="id_usuario">
                    <h1>Datos de cuenta de usuario</h1>
                    <fieldset class="form-group">
                        <div class="row">
                          <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Usuario *</label>
                                    <input id="usuario" name="usuario" type="text" class="form-control required" value="{{ old('usuario') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Email *</label>
                                    <input disabled id="email" name="email" type="email" class="form-control required email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Password *</label>
                                    <input id="password" name="password" type="password" class="form-control required" value="{{ old('password') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Confirma el password *</label>
                                    <input id="confirm" name="confirm" type="password" class="form-control required" value="{{ old('confirm') }}" data-match="#password">
                                </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group">
                                  <label>Perfil de seguridad *</label>

                                  <select id="perfilSeguridad" name="perfilSeguridad" class="form-control required" value="{{ old('perfilSeguridad') }}" required>
                                    <option ></option>
                                   <?php foreach ($perfilesSeguridad as $perfil): ?>
                                    <option value=<?=$perfil->id ?> ><?=$perfil->perfil ?></option>
                                   <?php endforeach ?>
                                  </select>

                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                  <label>Puesto *</label>
                                  <select id="puesto" name="puesto" class="form-control required" value="{{ old('puesto') }}" required>
                                    <option></option>
                                   <?php foreach ($usuariosPuesto as $puesto): ?>
                                    <option value=<?=$puesto->id ?> ><?=$puesto->puesto ?></option>
                                   <?php endforeach ?>
                                  </select>
                              </div>
                            </div>
                          </div>

                    </div>
                    <div class="hr-line-dashed"></div>
                              <center>
                                         <div class="form-group">
                                             <div class="col-sm-12">
                                                 <button class="btn btn-primary" type="submit" onclick="validar()">Guardar</button>
                                             </div>
                                         </div>
                            </center>


                    </fieldset>

                </form>
            </div>
        </div>
        </div>
</div>






@endsection
