
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

<!-- especificos-->

<script src="js/jsespecificos/admintool/newcompany.js"></script>

<!-- Chosen -->
<script src="js/plugins/chosen/chosen.jquery.js"></script>
<link href="css/plugins/chosen/chosen.css" rel="stylesheet">

<!-- Data Tables-->
<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

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
                    <h1>Datos de compañ&iacute;a</h1>
                    <fieldset class="form-group">
                        <div class="row">
                          <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nombre/Raz&oacute;n social *</label>
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
                                    <label>Tel&eacute;fono *</label>
                                    <input id="telefono" name="telefono" type="telefono" class="form-control required" value="{{ old('telefono') }}" data-match="#password" required>
                                </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group">
                                  <label>Estatus *</label>

                                  <select id="status" name="status" class="form-control required" value="{{ old('status') }}" required>

                                    <option value=1 selected>Activo</option>
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



<div class="row  border-bottom white-bg dashboard-header">
<div class="row">
<h2>Editar compañ&iacute;a <small> Aqu&iacute; se puede ver o editar las compañ&iacute;as ya existentes. </small></h2>

</div>
</div>

<div class="wrapper wrapper-content">
 <div class="ibox float-e-margins">
  <div class="ibox-title">
      <h5>Ver o editar compañ&iacute;a</h5>
      <div class="ibox-tools">
          <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
          </a>
      </div>
  </div>

 <div class="ibox-content inspinia-timeline" id="paranuevocodigo">

   <table class="table table-striped table-bordered table-hover dataTables-example" >
   <thead>
   <tr>
     <th>Nombre</th>
   </tr>
   </thead>
   <tbody id="tablacompañias">
     <?php foreach ($compañias as $compañia): ?>
        <tr id="fila<?=$compañia->id ?>" class="gradeX" onclick="openmodal(<?=$compañia->id ?>)"><strong>
          <td><?=$compañia->nombre ?></td>
        </strong></tr>
     <?php endforeach ?>
     </tbody>
     <tfoot>
     <tr>
       <th>Nombre</th>
     </tr>
     </tfoot>
     </table>

</div>
</div>
</div>


<!--modal para edicion -->

<div class="modal inmodal" id="modaledita" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">

                <button type="button" class="close" onclick="cerrarmodal()" ><span aria-hidden="true">&times;</span><span class="sr-only" >Close</span></button>
                <h4 class="modal-title">Editar compañ&iacute;a</h4>
            </div>
            <div class="modal-body">
              <form id="formmodal" action="/companyedit" class="wizard-big"method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="hdnid" id="hdnid" value="">
                  <h1>Datos de compañ&iacute;a</h1>
                  <fieldset class="form-group">
                      <div class="row">
                        <div class="row">
                          <div class="col-lg-6">
                              <div class="form-group">
                                  <label>Nombre/Raz&oacute;n social *</label>
                                  <input id="nombremodal" name="nombremodal" type="text" class="form-control required" value="{{ old('nombre') }}" required>
                              </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="form-group">
                                  <label>Email encargado*</label>
                                  <input id="emailmodal" name="emailmodal" type="email" class="form-control required email" value="{{ old('email') }}" required>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6">
                              <div class="form-group">
                                  <label>Domiclio *</label>
                                  <input id="domiciliomodal" name="domiciliomodal" type="domicilio" class="form-control required" value="{{ old('domicilio') }}" required>
                              </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="form-group">
                                  <label>Tel&eacute;fono *</label>
                                  <input id="telefonomodal" name="telefonomodal" type="telefono" class="form-control required" value="{{ old('telefono') }}" data-match="#password" required>
                              </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group">
                                <label>Estatus *</label>

                                <select id="statusmodal" name="statusmodal" class="form-control required" value="{{ old('status') }}" required>

                                  <option value=1 selected >Activo</option>
                                  <option value=2 >Inactivo</option>

                                </select>

                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                                <label>Logo *</label>
                                <input id="logomodal" name="logomodal" type="file" class="form-control required" value="{{ old('logo') }}">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <center>
                           <img id="logoempresa" alt="image" class="img-circle" src="">
                         </center>
                        </div>

                  </div>
                  <div class="hr-line-dashed"></div>
                            <center>
                                       <div class="form-group">
                                           <div class="col-sm-12">
                                               <button class="btn btn-primary" type="submit" onclick="validar()">Guardar cambios</button>
                                           </div>
                                       </div>
                           </center>
                  </fieldset>
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white"  id="closeguarda" name="closeguarda" onclick="cerrarmodal() ">Close</button>
                <div class="progress" id="progress">
                  <div class="progress-bar progress-bar-striped active" role="progressbar"
                  aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                  </div>

            </div>

        </div>
    </div>
  </div>







@endsection
