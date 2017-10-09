@extends('layouts.BaseLogin')

@section("content")


  <h1 style="color:white;">Restaurar</h1>

  <form  action="/password/email" role="form" method="post">

              {{csrf_field()}}
        <div class="form-group">
            <label for="" style="color:white;">Correo:</label>
            <input type="email" class="form-control" name="email" placeholder="Tu correo electronico">
        </div>
        <br>
        <button type="submit" class="btn btn-primary block full-width m-b" onclick="
return confirm('Se te enviara un correo, con el link para la restauracion de tu contraseña')">Enviar link</button>

<button type="button" class="btn btn-primary block full-width m-b" onclick = "location='/'">Regresar</button>
  </form>
@stop
