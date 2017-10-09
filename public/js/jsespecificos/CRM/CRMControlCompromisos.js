$(document).ready(function(){


var elem_3 = Array.prototype.slice.call(document.querySelectorAll('.js-switch_3'));

elem_3.forEach(function(html) {
  var switchery_3 = new Switchery(html, { color: '#1AB394' });
});

});



function cambio(btn){

var chk = "#" +btn;
var div = "#review" +btn;

$(chk).attr("disabled", true);

  var route = "/compromisoscambiostatus/"+btn;

  $.get(route, function(rev){

   $(div).empty();
     if (rev == 1)
      {
      $(div).append('<strong>Revisado</strong>');
      }
     else {
      $(div).append('<strong>Pendiente de revision</strong>');
     }

carganotificaciones()

$(chk).removeAttr("disabled");

});
}
