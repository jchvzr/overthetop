function subir() {

  event.preventDefault();

  jsShowWindowLoad('Cargando Base');

  var route = "/subirclientes";
  var token = $("#token").val();
  var fd = new FormData(document.getElementById("fileinfo"));
  var progressBar = document.getElementById("progress");

  $.ajax({
    url: route,
    headers: {'X-CSRF_TOKEN': token},
    type: 'post',
    data: fd,
    processData: false,  // tell jQuery not to process the data
    contentType: false,
    xhr: function() {
      var xhr = $.ajaxSettings.xhr();
      xhr.upload.onprogress = function(e) {
        progressBar.max = e.total;
        progressBar.value = e.loaded;
          console.log(Math.floor(e.loaded / e.total *100) + '%');
      };
      return xhr;
    },
    success: function(){
      jsRemoveWindowLoad();
      alert("Los registros se subieron con exito favor de pasar al siguiente paso");
      location.reload();
    },
    error: function(){
      setTimeout(function() {
              toastr.options = {
                  closeButton: true,
                  progressBar: true,
                  showMethod: 'slideDown',
                  timeOut: 4000
              };
              toastr.error('No se guardo cambio', 'Error de conexion');

          }, 1300);
      jsRemoveWindowLoad()
    }
  });

}

function subirpro() {
  event.preventDefault();

   jsShowWindowLoad('Procesando Base');

  var route = "/depurarclientes";
  var token = $("#token").val();
  var fd = new FormData(document.getElementById("fileinfopro"));
  console.log(route);
  $.ajax({
    url: route,
    headers: {'X-CSRF_TOKEN': token},
    type: 'post',
    data: fd,
    processData: false,  // tell jQuery not to process the data
    contentType: false,
    success: function(){
      jsRemoveWindowLoad();
      alert("Campaña cargada y lista");
      location.reload();
    },
       error: function(){
         setTimeout(function() {
                 toastr.options = {
                     closeButton: true,
                     progressBar: true,
                     showMethod: 'slideDown',
                     timeOut: 4000
                 };
                 toastr.error('No se cargo base', 'Error de conexion');

             }, 1300);
          jsRemoveWindowLoad()
        }
  });

}

$(document).ready(function(){


});



function jsRemoveWindowLoad() {
    // eliminamos el div que bloquea pantalla
    $("#WindowLoad").remove();


}

function jsShowWindowLoad(mensaje) {
    //eliminamos si existe un div ya bloqueando
    jsRemoveWindowLoad();

    //si no enviamos mensaje se pondra este por defecto
    if (mensaje === undefined) mensaje = "Procesando la información<br>Espere por favor";

    //centrar imagen gif
    height = 20;//El div del titulo, para que se vea mas arriba (H)
    var ancho = 0;
    var alto = 0;

    //obtenemos el ancho y alto de la ventana de nuestro navegador, compatible con todos los navegadores
    if (window.innerWidth == undefined) ancho = window.screen.width;
    else ancho = window.innerWidth;
    if (window.innerHeight == undefined) alto = window.screen.height;
    else alto = window.innerHeight;

    //operación necesaria para centrar el div que muestra el mensaje
    var heightdivsito = alto/9 - parseInt(height)/9;//Se utiliza en el margen superior, para centrar

   //imagen que aparece mientras nuestro div es mostrado y da apariencia de cargando
    imgCentro = "<div style='text-align:center;height:" + alto + "px;'><div  style='color:#000;margin-top:" + heightdivsito + "px; font-size:20px;font-weight:bold'>" + mensaje + "</div></br>"+
    "<div id='rendimientocampcargando' class='cargando'><div>.</div><div>.</div><div>.</div><div>A</div><div>R</div><div>E</div><div>P</div><div>S</div><div>E</div></div></br><img  src='img/load.gif'></div>";

        //creamos el div que bloquea grande------------------------------------------
        div = document.createElement("div");
        div.id = "WindowLoad"
        div.style.width = ancho + "px";
        div.style.height = alto + "px";
        $("body").append(div);

        //creamos un input text para que el foco se plasme en este y el usuario no pueda escribir en nada de atras
        input = document.createElement("input");
        input.id = "focusInput";
        input.type = "text"

        //asignamos el div que bloquea
        $("#WindowLoad").append(input);

        //asignamos el foco y ocultamos el input text
        $("#focusInput").focus();
        $("#focusInput").hide();

        //centramos el div del texto
        $("#WindowLoad").html(imgCentro);

}
