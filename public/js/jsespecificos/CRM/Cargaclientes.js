function subir() {
  event.preventDefault();

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
      alert("Los registros se subieron con excito favor de pasar al siguiente paso");
      location.reload();
    }
  });

}

function subirpro() {
  event.preventDefault();

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
      alert("Campaña cargada y lista");
      location.reload();
    }
  });

}

$(document).ready(function(){


});
