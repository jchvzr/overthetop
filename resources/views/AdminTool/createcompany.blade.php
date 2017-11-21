
@extends('layouts.principal')

@section('title', 'Main page')

@section('content')


<!-- Steps -->
<script src="/js/plugins/staps/jquery.steps.min.js"></script>
<link href="/css/plugins/steps/jquery.steps.css" rel="stylesheet">
<!-- Jquery Validate -->
<script src="/js/plugins/validate/jquery.validate.min.js"></script>
<!-- Script especifico de la pagina -->
<script src="/js/jsespecificos/admintool/createUserView.js"> </script>


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
                <h5>Formulario para creacion de compañia</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <h2>
                    Llena los datos de la compañia
                </h2>
                <p>
                    Es necesario llenar todos los que llevan (*).
                </p>

                <form id="form" action="/companystore" class="wizard-big"method="post" accept-charset="UTF-8" enctype="multipart/form-data">

                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <h1>Datos de compañia</h1>
                    <fieldset class="form-group">
                        <div class="row">
                          <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nombre/Razon social *</label>
                                    <input id="nombre" name="nombre" type="text" class="form-control required" value="{{ old('nombre') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Email encargado*</label>
                                    <input id="email" name="email" type="email" class="form-control required email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Domiclio *</label>
                                    <input id="domicilio" name="domicilio" type="domicilio" class="form-control required" value="{{ old('domicilio') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Telefono *</label>
                                    <input id="telefono" name="telefono" type="telefono" class="form-control required" value="{{ old('telefono') }}" data-match="#password" required>
                                </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group">
                                  <label>Estatus *</label>

                                  <select id="status" name="status" class="form-control required" value="{{ old('status') }}" required>

                                    <option value=1 >Activo</option>
                                    <option value=2 >Inactivo</option>

                                  </select>

                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                  <label>Logo *</label>
                                  <input id="logo" name="logo" type="file" class="form-control required" value="{{ old('logo') }}" required>
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
