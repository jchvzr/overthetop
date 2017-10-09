
@extends('layouts.principal')

@section('title', 'Main page')

@section('content')

<!-- Steps -->
<script src="/js/plugins/staps/jquery.steps.min.js"></script>
<link href="/css/plugins/steps/jquery.steps.css" rel="stylesheet">
<!-- Jquery Validate -->
<script src="/js/plugins/validate/jquery.validate.min.js"></script>
<!-- Script especifico de la pagina -->
<script src="/js/jsespecificos/admintool/editaperfilseguridad.js"></script>

</br>
@if($errors->has())
    <div class="alert alert-warning" role="alert">
       @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
      @endforeach
    </div>
@endif </br>

<div class="row">
     <div class="col-lg-12">
         <div class="ibox float-e-margins">
             <div class="ibox-title">
                 <h5>Modificar perfil de accesos <small>Y asignacion de permisos.</small></h5>
                 <div class="ibox-tools">
                     <a class="collapse-link">
                         <i class="fa fa-chevron-up"></i>
                     </a>

                 </div>
             </div>
             <div class="ibox-content">
              <form id="form" name="form" action="/perfilstoreedit" class="form-horizontal" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">



                  <div class="col-lg-12">
                    <div class="form-group">
                        <label>Perfil de seguridad *</label>

                        <select id="perfilSeguridad" name="perfilSeguridad" class="form-control required">
                          <option value="" ></option>
                         <?php foreach ($perfilesSeguridad as $perfil): ?>
                          <option value=<?=$perfil->id ?> ><?=$perfil->perfil ?></option>
                         <?php endforeach ?>
                        </select>

                    </div>
                  </div>

                     <div class="hr-line-dashed"></div>


<table class="table table-hover">
    <thead>
    <tr>
        <th><center>Menu</center></th>
        <th><center>Submenus</center></th>
    </tr>

  </thead>
  <tbody id="table">
<?php foreach ($menuIzquierdaTodo as $menu): ?>

  <tr>
      <td><center><div class="checkbox"><label> <input type="checkbox" name="menuizquierda[]"  id="menuizquierda" value="<?=$menu->id?>"> <?=$menu->opcion?> </label></div></center></td>

      <td><center> <?php if ($menu->consubmenu == 1): ?>
           <?php foreach ($submenuIzquierdaTodo as $submenu): ?>
           <?php if ($submenu->id_menuIzquierda == $menu->id): ?>
   <div class="checkbox"><label class="checkbox-inline"> <input type="checkbox" name="submenuizquierda[]"  id="submenuizquierda" value="<?=$submenu->id?>"> <?=$submenu->opcion?> </label></div>
           <?php endif; ?>
           <?php endforeach ?>
           <?php endif; ?> </span></td>
          </center>
      </tr>


<?php endforeach ?>

<tbody>
</table>
<div class="hr-line-dashed"></div>
          <center>
                     <div class="form-group">
                         <div class="col-sm-12">
                             <button class="btn btn-primary" type="submit">Guardar cambios</button>
                         </div>
                     </div>
        </center>
                 </form>
             </div>
     </div>
    </div>
  </div>


@endsection
