
$(document).ready(function(){

 carganotificaciones();
  var tid = setInterval(carganotificaciones, 350000);

});



function carganotificaciones() {
  // do some stuff...
  // no need to recall the function (it's an interval, it'll loop forever)

  var routealert = "/alertascompromisos";
  $.get(routealert, function(countalert){

  var cuentaalertasint = 0;

  $("#alertadrop").empty();
  $("#cuentacompromisos").empty();

  for (var i = 0; i < countalert.length; i++) {

  $("#alertadrop").append('<li><div> Tienes: <strong>'+countalert[i].cuantos+' </strong> '+countalert[i].nombre+' para hoy por revisar</div></li><li class="divider"></li>')
  cuentaalertasint = cuentaalertasint + countalert[i].cuantos;
  }

  $("#alertadrop").append('<div class="text-center link-block"><a href="/controlcompromisos"><strong>Ir a bandeja de compromisos </strong><i class="fa fa-arrow-right"></i></a></div></li>')

  $("#cuentacompromisos").append(cuentaalertasint);



});


}
function abortTimer() { // to be called when you want to stop the timer
  clearInterval(tid);
}
