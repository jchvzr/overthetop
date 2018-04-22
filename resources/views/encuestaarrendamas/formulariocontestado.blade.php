@extends('encuestaarrendamas.principalgris')

{{-- titulo de principal (pestaña navegador) --}}
@section('title','ATMOS CRM')

{{-- titulo en breadcrumb --}}

@section('breadcrumbtitle','Encuesta ARRENDA +')

{{-- direccion para breadcrumb --}}

@section('breadcrumbroute')
<ol class="breadcrumb">

</ol>
@endsection


@section('body-class','gray-bg')

@section('content')


@include('encuestaarrendamas.breadcrumbs')

<br/>


    <div class="middle-box text-center lockscreen animated fadeInDown">
        <div>
            <div class="m-b-md">
              </div>
            <h3>GRACIAS POR TU APOYO.</h3>
            <p>Tus respuestas han sido recibidas.</p>
        </div>
    </div>


@include('encuestaarrendamas.footer')

@endsection


@push('css-adicional')
  <!-- iCheck -->

    <link href="{{asset('/css/plugins/iCheck/custom.css')}}" rel="stylesheet">

@endpush


@push('script-adicional')

  <!-- iCheck -->

  <script src="/js/plugins/iCheck/icheck.min.js"></script>
      <script>

          $(document).ready(function () {

              $('.i-checks').iCheck({
                  radioClass: 'iradio_square-green',
              });

              $('input[name=p6]').on('ifChecked', function(event){

                switch ($('input[name=p6]:checked').val()) {
                  case "Portafolio de servicios":
                    $('#pregunta7').empty();
                    $('#pregunta7').append('¿Qué le gustaría que le ofreciéramos?');

                    break;
                  case "Información y asesoria":
                    $('#pregunta7').empty();
                    $('#pregunta7').append('¿Qué faltó?');

                    break;

                  case "Tiempos de respuesta":
                    $('#pregunta7').empty();
                    $('#pregunta7').append('¿Cuánto tiempo desea?');

                    break;

                  case "Precios":
                    $('#pregunta7').empty();
                    $('#pregunta7').append('¿Qué tasa? ¿Quién se la ofrece?');

                    break;
                  default:
                    alert('default')
                    break;
                }
              });
          });
      </script>

@endpush
