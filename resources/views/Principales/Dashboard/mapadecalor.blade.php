@extends('layouts.principal2')

@section('content')
<form action="/mapadecalor" method="post" role="form">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="col-lg-12">
    <h1 class="page-header text-center" style="font-weight: bold; text-shadow: 1px 1px #222; color:#0070B0;font-family: 'LeagueGothic';word-spacing: 5px; letter-spacing: 2px; border-bottom: none">Mapa de calor de Riesgos</h1>
  </div>
  <div class="row">
    <div class="col-md-4">
      <h2><label for="">Area:</label></h2>
      <select class="form-control input-lg" class="form-control" name="areas" id="areas">
        <option selected value="0">Sin filtro</option>
        <?php foreach ($area as $areas): ?>
          <option value="<?=$areas['id']?>"><?=$areas['nombre']?></option>
        <?php endforeach ?>
      </select>
    </div>
        <div class="col-md-4">
          <h2><label for="">Procesos:</label></h2>
          <select class="form-control input-lg" name="procesos" id="procesos">
            <option selected value="0">Sin filtro</option>
            <?php foreach ($proceso as $procesos): ?>
              <option value="<?=$procesos->id?>"><?=$procesos->proceso?></option>
            <?php endforeach ?>
          </select>
        </div>
    <div class="col-md-4">
      <h2><label for="">Tipo de riesgos:</label></h2>
      <select class="form-control input-lg" class="form-control" name="tipos" id="tipos">
        <option selected value="0">Sin filtro</option>
        <?php foreach ($Abcriesgo as $Abcriesgos): ?>
          <option value="<?=$Abcriesgos['id']?>"><?=$Abcriesgos['nombre']?></option>
        <?php endforeach ?>
      </select>
    </div>
  </div>
<br>
  <div class="col-md-4">
    <button type="submit" class="btnobjetivo" id="" style="font-family: Arial;" >Filtrar</button>
  </div>

</form>

<div class="panel-body">
    <div class="dataTable_wrapper">
          <table align="center" style="overflow-x:auto;" class="table table-striped table-hover" id="tablacalor">
            <thead style='color:#FFF'>
              <tr>
                <th>  <div class="th-inner sortable both"><font size=6 color="#000"> </font></div></th>
                <th>  <div class="th-inner sortable both"><font size=6 color="#000">  Inherente  </font></div></th>
                <th>  <div class="th-inner sortable both"><font size=6 color="#000"> </font></div></th>
                <th>  <div class="th-inner sortable both"><font size=6 color="#000">  Residual  </font></div></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                  <td align="right" WIDTH="10" HEIGHT="10">
                    <label style=" transform:translate(25px, 150px) rotate(270deg);"for="">severidad</label>
                  </td>
                  <td><table  align="center" border=1 id="tabladecalor">
                  <tr>
                    <td id="amarillo"><center><?=$riskmap_31?></center></td>
                    <td id="rojoclaro"><center><?=$riskmap_32?></center></td>
                    <td id="rojo"><center><?=$riskmap_33?></center></td>
                  </tr>
                  <tr>
                    <td id="verdeclaro"><center><?=$riskmap_21?></center></td>
                    <td id="amarillo"><center><?=$riskmap_22?></center></td>
                    <td id="rojoclaro"><center><?=$riskmap_23?></center></td>
                  </tr>
                  <tr>
                    <td id="verde"><center><?=$riskmap_11?></center></td>
                    <td id="verdeclaro"><center><?=$riskmap_12?></center></td>
                    <td id="amarillo"><center><?=$riskmap_13?></center></td>
                  </tr>

                </table><label for="">Probabilidad</label></td>
                <td align="right" WIDTH="10" HEIGHT="10" >
                  <label style=" transform:translate(25px, 150px) rotate(270deg);"for="">severidad</label>
                </td>
              <td>
                <table  align="center" border=1 id="tabladecalor2">
                  <tr>
                    <td id="amarillo"><center><?=$riskmap2_31?></center></td>
                    <td id="rojoclaro"><center><?=$riskmap2_32?></center></td>
                    <td id="rojo"><center><?=$riskmap2_33?></center></td>
                  </tr>
                  <tr>
                    <td id="verdeclaro"><center><?=$riskmap2_21?></center></td>
                    <td id="amarillo"><center><?=$riskmap2_22?></center></td>
                    <td id="rojoclaro"><center><?=$riskmap2_23?></center></td>
                  </tr>
                  <tr>
                    <td id="verde"><center><?=$riskmap2_11?></center></td>
                    <td id="verdeclaro"><center><?=$riskmap2_12?></center></td>
                    <td id="amarillo"><center><?=$riskmap2_13?></center></td>
                  </tr>
                </table>
                <label for="">Probabilidad</label>
              </td>
              </tr>
            </tbody>
          </table>
  </div>
</div>







<!-- Tabla -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-red">
            <div class="panel-heading">
                Riesgos
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <div class="dataTable_wrapper">
                  <form>
                      Buscar <input id="searchTerm" type="text" onkeyup="doSearch()" />
                  </form>
                  <br>
                    <table width="100%" class="table table-responsive table-striped table-bordered table-hover" id="datos">
                        <thead style='background-color: #868889; color:#FFF'>
                            <tr>
                                <th><div class="th-inner sortable both">Proceso</div></th>
                                <th><div class="th-inner sortable both">Actividad</div></th>
                                <th><div class="th-inner sortable both">Area</div></th>
                                <th><div class="th-inner sortable both">Tipo riesgo</div></th>
                                <th><div class="th-inner sortable both">descripcion_modo_falla</div></th>
                                <th><div class="th-inner sortable both">Severidad</div></th>
                                <th><div class="th-inner sortable both">probabilidad</div></th>
                                <th><div class="th-inner sortable both">controles</div></th>
                                <th><div class="th-inner sortable both">Severidad2</div></th>
                                <th><div class="th-inner sortable both">probabilidad2</div></th>
                                <th><div class="th-inner sortable both">riesgo inherente</div></th>
                                <th><div class="th-inner sortable both">riesgo residual</div></th>
                                <th><div class="th-inner sortable both">Editar</div></th>
                            </tr>
                        </thead>
                        <!-- aqui va la consulta a la base de datos para traer las filas se hace desde el controlador-->
                        <tbody id = "myTable">
                            <?php foreach ($Analisisriesgo as $Analisisriesgos): ?>
                                <tr>
                                    <td><?=$Analisisriesgos->nombreproceso?></td>
                                    <td><?=$Analisisriesgos->actividad?></td>
                                    <td><?=$Analisisriesgos->nomarea?></td>
                                    <td><?=$Analisisriesgos->abcriesgo?></td>
                                    <td><?=$Analisisriesgos->descripcion_modo_falla?></td>
                                    <td><?=$Analisisriesgos->Severidad?></td>
                                    <td><?=$Analisisriesgos->probabilidad?></td>
                                    <td><?=$Analisisriesgos->controles?></td>
                                    <td><?=$Analisisriesgos->Severidad2?></td>
                                    <td><?=$Analisisriesgos->probabilidad?></td>
                                    <td><?=$Analisisriesgos->riesgo_inherente?></td>
                                    <td><?=$Analisisriesgos->riesgo_residual?></td>
                                    <td><button type="button" class="btnobjetivo" value = "<?=$Analisisriesgos->id?>" data-toggle="modal" data-target="#modaledit" onclick="Editar(this);"><i class="glyphicon glyphicon-pencil"></i> Editar  </button></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 text-center">
                  <ul class="pagination pagination-lg pager" id="myPager"></ul>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal para editar -->

<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" style="background-color:gray">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h3 class="modal-title">ACTUALIZAR RIESGO</h3>
            </div>
            <div class="modal-body">
              <form id="fileinfo" method="post">

              <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
              <input type="hidden" id="id">

                <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6">
                  <h3><label for="tipo" class="control-label" >Actividad:</label></h3>
                  <input class="form-control input-lg" id="eactividad" type="Text" placeholder="Que actividad se realiza" name="eactividad">
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                  <h3><label for="tipo" class="control-label" >Riesgo:</label></h3>
                  <select class="form-control input-lg" name="eriesgo_id" id="eriesgo_id">
                      <?php foreach ($Abcriesgo as $Abcriesgos): ?>
                          <option value="<?=$Abcriesgos['id']?>"><?=$Abcriesgos['nombre']?></option>
                      <?php endforeach ?>
                  </select>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                  <h3><label for="Usuario" class="control-label" >Modo de falla:</label></h3>
                  <input class="form-control input-lg" id="edescripcion_modo_falla" type="Text" placeholder="Descripcion de la falla" name="edescripcion_modo_falla">
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3">
                  <h3><label for="Usuario" class="control-label" >Severidad inherente:</label></h3>
                  <select class="form-control input-lg" name="eSeveridad" id="eSeveridad">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3">
                  <h3><label for="Usuario" class="control-label" >Probabilidad inherente:</label></h3>
                  <select class="form-control input-lg" name="eprobabilidad" id="eprobabilidad">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12">
                  <h3><label for="Usuario" class="control-label" >Controles:</label></h3>
                  <input class="form-control input-lg" id="econtroles" type="Text" placeholder="Controles" name="econtroles">
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3">
                  <h3><label for="Usuario" class="control-label" >Severidad residual:</label></h3>
                  <select class="form-control input-lg" name="eSeveridad2" id="eSeveridad2">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3">
                  <h3><label for="Usuario" class="control-label" >Probabilidad residual:</label></h3>
                  <select class="form-control input-lg" name="eprobabilidad2" id="eprobabilidad2">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                  <h3><label for="tipo" class="control-label" >Area:</label></h3>
                  <select class="form-control input-lg" name="eid_area" id="eid_area" required>
                    <?php foreach ($area as $areas): ?>
                        <option value="<?=$areas['id']?>"><?=$areas['nombre']?></option>
                    <?php endforeach ?>
                  </select>
                </div>


              </div>

              <div class="modal-footer">
              <a class="btn btn-primary" id="actualizar" style="font-family: Arial;">Guardar Cambios</a>
                  <button type="button" class="btn btn-default" data-dismiss="modal" id="btnCloseUpload">Cerrar</button>
              </div>
            </form>
        </div>
      </div>
  </div>
</div>


<script type="text/javascript">

//Funcion para el edit

function Editar(btn){
  var route = "/analisisrisk/"+btn.value+"/edit";

  $.get(route, function(res){
    $("#id").val(res.id);
    $("#eactividad").val(res.actividad);
    $('#eriesgo_id option[value="' + res.riesgo_id + '"]').attr("selected", "selected");
    $("#edescripcion_modo_falla").val(res.descripcion_modo_falla);
    $('#eSeveridad option[value="' + res.Severidad + '"]').attr("selected", "selected");
    $('#eprobabilidad option[value="' + res.probabilidad + '"]').attr("selected", "selected");
    $("#econtroles").val(res.controles);
    $('#eSeveridad2 option[value="' + res.Severidad2 + '"]').attr("selected", "selected");
    $('#eprobabilidad2 option[value="' + res.probabilidad2 + '"]').attr("selected", "selected");
    $('#eid_area option[value="' + res.id_area + '"]').attr("selected", "selected");


  });

}



//Funciones para la tabla
$.fn.pageMe = function(opts){
    var $this = this,
        defaults = {
            perPage: 7,
            showPrevNext: false,
            hidePageNumbers: false
        },
        settings = $.extend(defaults, opts);

    var listElement = $this;
    var perPage = settings.perPage;
    var children = listElement.children();
    var pager = $('.pager');

    if (typeof settings.childSelector!="undefined") {
        children = listElement.find(settings.childSelector);
    }

    if (typeof settings.pagerSelector!="undefined") {
        pager = $(settings.pagerSelector);
    }

    var numItems = children.size();
    var numPages = Math.ceil(numItems/perPage);

    pager.data("curr",0);

    if (settings.showPrevNext){
        $('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
    }

    var curr = 0;
    while(numPages > curr && (settings.hidePageNumbers==false)){
        $('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
        curr++;
    }

    if (settings.showPrevNext){
        $('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
    }

    pager.find('.page_link:first').addClass('active');
    pager.find('.prev_link').hide();
    if (numPages<=1) {
        pager.find('.next_link').hide();
    }
      pager.children().eq(1).addClass("active");

    children.hide();
    children.slice(0, perPage).show();

    pager.find('li .page_link').click(function(){
        var clickedPage = $(this).html().valueOf()-1;
        goTo(clickedPage,perPage);
        return false;
    });
    pager.find('li .prev_link').click(function(){
        previous();
        return false;
    });
    pager.find('li .next_link').click(function(){
        next();
        return false;
    });

    function previous(){
        var goToPage = parseInt(pager.data("curr")) - 1;
        goTo(goToPage);
    }

    function next(){
        goToPage = parseInt(pager.data("curr")) + 1;
        goTo(goToPage);
    }

    function goTo(page){
        var startAt = page * perPage,
            endOn = startAt + perPage;

        children.css('display','none').slice(startAt, endOn).show();

        if (page>=1) {
            pager.find('.prev_link').show();
        }
        else {
            pager.find('.prev_link').hide();
        }

        if (page<(numPages-1)) {
            pager.find('.next_link').show();
        }
        else {
            pager.find('.next_link').hide();
        }

        pager.data("curr",page);
      	pager.children().removeClass("active");
        pager.children().eq(page+1).addClass("active");

    }
};

$(document).ready(function(){

  $('#myTable').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:10});

  $("#actualizar").click(function(){
    var value = $("#id").val();
    var route = "/analisisrisk/edit/"+value+"";
    var token = $("#token").val();
    var fd = new FormData(document.getElementById("fileinfo"));

    $.ajax({
      url: route,
      headers: {'X-CSRF_TOKEN': token},
      type: 'post',
      data: fd,
      processData: false,  // tell jQuery not to process the data
      contentType: false,
      success: function(){
        alert("Cambios guardados correctamente");
        location.reload();
      }
    });
  });

});

function doSearch()
{
  var tableReg = document.getElementById('datos');
  var searchText = document.getElementById('searchTerm').value.toLowerCase();
  var cellsOfRow="";
  var found=false;
  var compareWith="";

  // Recorremos todas las filas con contenido de la tabla
  for (var i = 1; i < tableReg.rows.length; i++)
  {
    cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
    found = false;
    // Recorremos todas las celdas
    for (var j = 0; j < cellsOfRow.length-1 && !found; j++)
    {
      compareWith = cellsOfRow[j].innerHTML.toLowerCase();
      // Buscamos el texto en el contenido de la celda
      if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1))
      {
        found = true;
      }
    }
    if(found)
    {
      tableReg.rows[i].style.display = '';
    } else {
      // si no ha encontrado ninguna coincidencia, esconde la
      // fila de la tabla
      tableReg.rows[i].style.display = 'none';
    }
  }
}



</script>


@stop
