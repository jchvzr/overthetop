
$(document).ready(function(){
  $(".chosen-select").chosen({width: "100%"});

  $("#eligeusuario").change(function() {

    $("#id_usuario").val();
    $("#usuario").val();
    $("#email").val();



    $("#eligeusuario option[value='']").remove();
    var id = $("#eligeusuario").val();
    var route = "/muestraeditusuario/"+id;
    $.get(route, function(res){
      $('#id_usuario').val($('#eligeusuario').val());
      $("#usuario").val(res.usuario);
      $("#email").val(res.email);
      $('#perfilSeguridad option[value="' + res.id_usuariosPerfil + '"]').attr("selected", "selected");
      $('#puesto option[value="' + res.id_usuariosPuesto + '"]').attr("selected", "selected");

    });
  });

  });



  function validar() {

    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form[name='form']").validate({
      // Specify validation rules
      rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
        usuario: "required",
        confirm: {equalTo: "#password"},
        perfilSeguridad: "required",
        puesto: "required"
      },
      // Specify validation error messages
      messages: {
        usuario: "Es necesario ingresar nombre de usuario",
        confirm: "Debe hacer match con password",
        perfilSeguridad: "required",
        puesto: "required",

      },
      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function(form) {
        form.submit();
      }
    });


  }
