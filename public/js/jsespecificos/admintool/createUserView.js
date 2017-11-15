
$(document).ready(function(){



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
        email: {required: true,email: true},
        password: "required",
        confirm: {equalTo: "#password"},
        perfilSeguridad: "required",
        puesto: "required"
      },
      // Specify validation error messages
      messages: {
        usuario: "Es necesario ingresar nombre de usuario",
        email: "Ingresa un email valido",
        password: "Ingresa un password",
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
