
$(document).ready(function(){


  $("#perfilSeguridad").change(function() {

    $("#perfilSeguridad option[value='']").remove();

    $("input:checkbox").each(function() {
    this.checked = false;
     });

    var idperfil = $("#perfilSeguridad").val();
    var route = "/editperfilseguridadchecks/"+idperfil;
    var route2 = "/editperfilseguridadcheckssub/"+idperfil;
   $.get(route, function(res){
     $.get(route2, function(res2){

       $("input:checkbox").each(function() {
          if(this.name == "menuizquierda[]")
          {
            for (var i = 0; i < res.length; i++) {

             if (res[i].id_menuIzquierda == this.value)
             {
               this.checked = true;
             }

            }

              //alert(this.value);

              //alert("entre al si");
           }
           else {
             for (var i = 0; i < res2.length; i++) {

              if (res2[i].id_submenuIzquierda == this.value)
              {
                this.checked = true;
              }

             }
//             alert(this.value);
//             this.checked = true;
//             alert("entre al else");
           }

           });


     });
   });





                });



  });
