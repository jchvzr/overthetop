@extends('encuestaarrendamas.principal')

{{-- titulo de principal (pestaña navegador) --}}
@section('title','ATMOS CRM')

{{-- titulo en breadcrumb --}}

@section('breadcrumbtitle','Encuesta ARRENDA +')

{{-- direccion para breadcrumb --}}

@section('breadcrumbroute')
<ol class="breadcrumb">

</ol>
@endsection


@section('body-class','')

    @section('content')


@include('encuestaarrendamas.breadcrumbs')

<br/>
<div class="row">
 <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Encuesta de satisfacción <small>Agradecemos tus respuestas</small></h5>

        </div>
                    <div class="ibox-content">
<div class="text-center">
              <form role="form" method="post" action="/arrenda_mas">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="customer_id" value="{{$customerid}}">

                <div class="form-group"><label class="control-label">Nombre  </label>
                 <br>
                  <br>
                    <div class="col-sm-12 text-center">
                      <input type="text" class="form-control text-center" name="p1" id="p1" value="" placeholder="Nombre de quien contesta la encuesta" maxlength="100" required>
                      </div>
                </div>

                <br>
            <div class="hr-line-dashed"></div>

                  <div class="form-group"><label class="control-label">¿Es usted la persona que llevo a cabo principalmente el proceso de contratación de los servicios de Arrenda+?  </label>
                   <br>
                    <br>
                      <div class="col-sm-12">
                          <div class="checkbox-inline i-checks"><label> <input type="radio" name="p2" id="p2" value="si" checked=""> SI </label></div>
                          <div class="checkbox-inline i-checks"><label> <input type="radio" name="p2" id="p2" value="no"> NO </label></div>

                 </div>
                 </div>

                  <br>

                  <div class="hr-line-dashed"></div>

                  <div class="form-group"><label class="control-label">¿Cómo supo originalmente de Arrenda+?  </label>
                   <br>
                    <br>
                      <div class="col-sm-12 text-center">
                        <input type="text" class="form-control text-center" name="p3" id="p3" value="" placeholder="Escribe el medio" maxlength="100" required>
                        </div>
                  </div>

                  <br>
              <div class="hr-line-dashed"></div>

              {{-- <div class="form-group"><label class="control-label">¿Fue fácil contactar a un ejecutivo?    </label> --}}
<div class="form-group"><label class="control-label">Del 0 al 10 cómo califica su proceso de contratación de crédito/arrendamiento con Arrenda+ en las siguientes dimensiones. Califica cada una de las dimensiones moviendo el botón    </label>
              <div class="hr-line-dashed"></div>


           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label class="control-label">Fue fácil contactar a un ejecutivo</label></div>

           <div id="p4slider" class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></div>

           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label class="control-label">No fue fácil contactar a un ejecutivo</label></div>
                <input type="hidden" name="p4" id="p4" value="5">
          <br>


              {{-- <div class="form-group"><label class="control-label">¿La información inicial proporcionada fue buena?    </label> --}}
           <br>
            <br>
           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label class="control-label">La información inicial proporcionada fue buena</label></div>

           <div id="p5slider" class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></div>

           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label class="control-label">La información inicial proporcionada fue insuficiente</label></div>
                <input type="hidden" name="p5" id="p5" value="5">
          <br>



          {{-- <div class="form-group"><label class="control-label">6.- ¿La atención por parte del ejecutivo fue buena?    </label> --}}
       <br>
        <br>
       <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label class="control-label">La atención por parte del ejecutivo fue buena</label></div>

       <div id="p6slider" class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></div>

       <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label class="control-label">La atención por parte del ejecutivo fue mala</label></div>
            <input type="hidden" name="p6" id="p6" value="5">
      <br>



      {{-- <div class="form-group"><label class="control-label">¿El tiempo que tardo en la cotización fue bueno?    </label> --}}
   <br>
    <br>
   <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label class="control-label">El tiempo que tardo en recibir la cotización fue bueno</label></div>

   <div id="p7slider" class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></div>

   <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label class="control-label">El tiempo que tardo en recibir la cotización fue demasiado</label></div>
        <input type="hidden" name="p7" id="p7" value="5">
  <br>





  {{-- <div class="form-group"><label class="control-label">¿El tramite fue sencillo de realizar?    </label> --}}
<br>
<br>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label class="control-label">El tramite fue sencillo de realizar</label></div>

<div id="p8slider" class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></div>

<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label class="control-label">El tramite fue complicado de realizar</label></div>
    <input type="hidden" name="p8" id="p8" value="5">
<br>



{{-- <div class="form-group"><label class="control-label">¿El proceso completo tomó el tiempo adecuado?   </label> --}}
<br>
<br>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label class="control-label">El proceso completo tomó el tiempo adecuado</label></div>

<div id="p9slider" class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></div>

<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label class="control-label">El proceso completo tardó demasiado tiempo</label></div>
  <input type="hidden" name="p9" id="p9" value="5">
<br>
<br>
<br>

<div class="form-group"><label class="control-label">Desde el contacto inicial con el ejecutivo hasta la firma del contrato ¿Cuánto tiempo tomó su trámite? </label>
<br>
<br>
  {{-- <select class="form-control text-center" name="p10" id="p10">
    <option value="1 semana">1 semana</option>
    <option value="2 semanas">2 semanas</option>
    <option value="3 semanas">3 semanas</option>
    <option value="4 semanas">4 semanas</option>
    <option value="5 semanas">5 semanas</option>
    <option value="6 semanas">6 semanas</option>
    <option value="7 semanas">7 semanas</option>
    <option value="8 semanas">8 semanas</option>
  </select> --}}

  <div class="col-sm-12">
      <div class="checkbox-inline i-checks"><label> <input type="radio" name="p10" id="p10" value="1 semana" checked=""> 1 semana </label></div>
      <div class="checkbox-inline i-checks"><label> <input type="radio" name="p10" id="p10" value="2 semanas"> 2 semanas </label></div>
      <div class="checkbox-inline i-checks"><label> <input type="radio" name="p10" id="p10" value="3 semanas"> 3 semanas </label></div>
      <div class="checkbox-inline i-checks"><label> <input type="radio" name="p10" id="p10" value="4 semanas"> 4 semanas </label></div>
      <div class="checkbox-inline i-checks"><label> <input type="radio" name="p10" id="p10" value="5 semanas"> 5 semanas </label></div>
      <div class="checkbox-inline i-checks"><label> <input type="radio" name="p10" id="p10" value="6 semanas"> 6 semanas </label></div>
      <div class="checkbox-inline i-checks"><label> <input type="radio" name="p10" id="p10" value="7 semanas"> 7 semanas </label></div>
      <div class="checkbox-inline i-checks"><label> <input type="radio" name="p10" id="p10" value="8 semanas"> 8 semanas </label></div>
  </div>
<br>
              <div class="hr-line-dashed"></div>

<br>


{{-- <div class="form-group"><label class="control-label">¿El precio o costo fue bueno?    </label> --}}
<div class="form-group"><label class="control-label">Del 0 al 10 cómo califica las caracteristicas de su financiamiento con Arrenda+ en las siguientes dimensiones. Califica cada una de las dimensiones moviendo el botón    </label>
<div class="hr-line-dashed"></div>

<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label class="control-label">El precio/costo fue bueno</label></div>
<div id="p11slider" class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></div>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label class="control-label">El precio/costo fue malo</label></div>
  <input type="hidden" name="p11" id="p11" value="5">
<br>


{{-- <div class="form-group"><label class="control-label">¿El precio o costo fue bueno?    </label> --}}
<br><br>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label class="control-label">Los plazos ofrecidos fueron adecuados</label></div>
<div id="p12slider" class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></div>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label class="control-label">Los plazos ofrecidos no fueron adecuados</label></div>
  <input type="hidden" name="p12" id="p12" value="5">
<br>

{{-- <div class="form-group"><label class="control-label">¿El precio o costo fue bueno?    </label> --}}
<br><br>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label class="control-label">El monto otorgado fue suficiente</label></div>
<div id="p13slider" class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></div>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label class="control-label">El monto otorgado no cubrió mis necesidades</label></div>
  <input type="hidden" name="p13" id="p13" value="5">
<br>

<br><br>


<div class="form-group"><label class="control-label">¿Arrenda+ le cubre todas sus necesidades de financiamiento?  </label>
 <br>
  <br>
    <div class="col-sm-12">
        <div class="checkbox-inline i-checks"><label> <input type="radio" name="p14" id="p14" value="si" checked=""> SI </label></div>
        <div class="checkbox-inline i-checks"><label> <input type="radio" name="p14" id="p14" value="no"> NO </label></div>

</div>
</div>

<br>
    <div class="hr-line-dashed"></div>
<br>


<div class="form-group"><label class="control-label">¿Cuales de las siguientes soluciones financieras adicionales requiere usted?  </label>
 <br>
  <br>
    <div class="col-sm-12">
        <div class="checkbox-inline i-checks"><label> <input type="checkbox" name="p15_factoraje" id="p15_factoraje" value="1"> Factoraje </label></div>
        <div class="checkbox-inline i-checks"><label> <input type="checkbox" name="p15_credito_de_capital_de_trabajo" id="p15_credito_de_capital_de_trabajo" value="1"> Crédito de capital de trabajo </label></div>
        <div class="checkbox-inline i-checks"><label> <input type="checkbox" name="p15_credito_puente" id="p15_credito_puente" value="1"> Crédito puente </label></div>
        <div class="checkbox-inline i-checks"><label> <input type="checkbox" name="p15_arrendamiento_financiero" id="p15_arrendamiento_financiero" value="1"> Arrendamiento financiero </label></div>
        <div class="checkbox-inline i-checks"><label> <input type="checkbox" name="p15_otro" id="p15_otro" value="1"> Otro </label></div>
</div>
<br>

<div class="form-group" id="p15textarea"><br><label class="control-label"> ¿Cual?   </label>
 <br>
  <br>
    <div class="form-group col-sm-12">
     <textarea name="p15_cual" id="p15_cual" rows="4" class="form-control text-center col-lg-12" maxlength="255" required></textarea>
    </div>
</div>
</div>

<br>
    <div class="hr-line-dashed"></div>
<br>


<div class="form-group"><label class="control-label">¿Con que otros productos cuenta actualmente?  </label>
 <br>
  <br>
    <div class="col-sm-12">
        <div class="checkbox-inline i-checks"><label> <input type="checkbox" name="p16_factoraje" id="p16_factoraje" value="1"> Factoraje </label></div>
        <div class="checkbox-inline i-checks"><label> <input type="checkbox" name="p16_credito_de_capital_de_trabajo" id="p16_credito_de_capital_de_trabajo" value="1"> Crédito de capital de trabajo </label></div>
        <div class="checkbox-inline i-checks"><label> <input type="checkbox" name="p16_credito_puente" id="p16_credito_puente" value="1"> Crédito puente </label></div>
        <div class="checkbox-inline i-checks"><label> <input type="checkbox" name="p16_arrendamiento_financiero" id="p16_arrendamiento_financiero" value="1"> Arrendamiento financiero </label></div>
        <div class="checkbox-inline i-checks"><label> <input type="checkbox" name="p16_otro" id="p16_otro" value="1"> Otro </label></div>
</div>
<br>

<div class="form-group" id="p16textarea"><br><label class="control-label"> ¿Cual?   </label>
 <br>
  <br>
    <div class="form-group col-sm-12">
     <textarea name="p16_cual" id="p16_cual" rows="4" class="form-control text-center col-lg-12" maxlength="255" required></textarea>
    </div>
</div>
</div>


<div class="hr-line-dashed"></div>

<div class="form-group"><label class="control-label">¿Qué tan satisfecho estas con Arrenda+? Califica del 0 al 10, en donde 0 es "Nada satisfecho" y 10 es "Muy satisfecho" </label>
 <br>
  <br>
    <div class="col-sm-12">
        <div class="checkbox-inline i-checks"><label> <input type="radio" name="p17" id="p17" value="0" checked=""> 0 </label>
        <div class="checkbox-inline i-checks"><label> <input type="radio" name="p17" id="p17" value="1"> 1 </label></div>
        <div class="checkbox-inline i-checks"><label> <input type="radio" name="p17" id="p17" value="2"> 2 </label></div>
        <div class="checkbox-inline i-checks"><label> <input type="radio" name="p17" id="p17" value="3"> 3 </label></div>
        <div class="checkbox-inline i-checks"><label> <input type="radio" name="p17" id="p17" value="4"> 4 </label></div>
        <div class="checkbox-inline i-checks"><label> <input type="radio" name="p17" id="p17" value="5"> 5 </label></div>
        <div class="checkbox-inline i-checks"><label> <input type="radio" name="p17" id="p17" value="6"> 6 </label></div>
        <div class="checkbox-inline i-checks"><label> <input type="radio" name="p17" id="p17" value="7"> 7 </label></div>
        <div class="checkbox-inline i-checks"><label> <input type="radio" name="p17" id="p17" value="8"> 8 </label></div>
        <div class="checkbox-inline i-checks"><label> <input type="radio" name="p17" id="p17" value="9"> 9 </label></div>
        <div class="checkbox-inline i-checks"><label> <input type="radio" name="p17" id="p17" value="10"> 10 </label></div>
    </div>
</div>
</div>
<br>
<br>

<div class="form-group">
 <button type="submit" class="btn btn-bg btn-primary m-t-n-xs" ><strong>Guardar cuestionario</strong></button>

</div>


                </div>

              </form>

            </div>

</div>
</div>
</div>



@include('encuestaarrendamas.footer')

@endsection


@push('css-adicional')
  <!-- iCheck -->

    <link href="{{asset('/css/plugins/iCheck/custom.css')}}" rel="stylesheet">

  <!-- nouslider -->

    <link href="{{asset('/css/plugins/nouslider/nouislider.css')}}" rel="stylesheet">

@endpush


@push('script-adicional')

  <!-- iCheck -->

  <script src="{{asset('/js/plugins/iCheck/icheck.min.js')}}"></script>

  <!-- nouslider -->

  <script src="{{asset('/js/plugins/nouslider/nouislider.js')}}"></script>


  <script>

// slider pregunta 4
//
  var p4slider = document.getElementById('p4slider');

  noUiSlider.create(p4slider, {
  	start: 5,
  	step: 1,
    connect: [true, true],
  	range: {
  		'min': 0,
  		'max': 10
  	}
  });

// para manejo con keyboard slider
  var handle = p4slider.querySelector('.noUi-handle');

  handle.addEventListener('keydown', function( e ) {

  	var value = Number( p4slider.noUiSlider.get() );

  	if ( e.which === 37 ) {
  		p4slider.noUiSlider.set( value - 1 );
  	}

  	if ( e.which === 39 ) {
  		p4slider.noUiSlider.set( value + 1 );
  	}
  });

// listener de el slider para asignarle el valor al input

  var p4 = document.getElementById('p4');

  p4slider.noUiSlider.on('update', function( values, handle ) {
  	p4.value = values[handle];
  });

// listener de el input para asignarle el valor al slider no se usa por que esta oculto

  p4.addEventListener('change', function(){
  	p4slider.noUiSlider.set(this.value);
  });


// slider pregunta 5

  var p5slider = document.getElementById('p5slider');

  noUiSlider.create(p5slider, {
  	start: 5,
  	step: 1,
    connect: [true, true],
  	range: {
  		'min': 0,
  		'max': 10
  	}
  });


  var handle = p5slider.querySelector('.noUi-handle');

  handle.addEventListener('keydown', function( e ) {

  	var value = Number( p5slider.noUiSlider.get() );

  	if ( e.which === 37 ) {
  		p5slider.noUiSlider.set( value - 1 );
  	}

  	if ( e.which === 39 ) {
  		p5slider.noUiSlider.set( value + 1 );
  	}
  });

  // listener de el slider para asignarle el valor al input

    var p5 = document.getElementById('p5');

    p5slider.noUiSlider.on('update', function( values, handle ) {
    	p5.value = values[handle];
    });

  // listener de el input para asignarle el valor al slider no se usa por que esta oculto

    p5.addEventListener('change', function(){
    	p5slider.noUiSlider.set(this.value);
    });




    // slider pregunta 6

      var p6slider = document.getElementById('p6slider');

      noUiSlider.create(p6slider, {
      	start: 5,
      	step: 1,
        connect: [true, true],
      	range: {
      		'min': 0,
      		'max': 10
      	}
      });


      var handle = p6slider.querySelector('.noUi-handle');

      handle.addEventListener('keydown', function( e ) {

      	var value = Number( p6slider.noUiSlider.get() );

      	if ( e.which === 37 ) {
      		p6slider.noUiSlider.set( value - 1 );
      	}

      	if ( e.which === 39 ) {
      		p6slider.noUiSlider.set( value + 1 );
      	}
      });

      // listener de el slider para asignarle el valor al input

        var p6 = document.getElementById('p6');

        p6slider.noUiSlider.on('update', function( values, handle ) {
        	p6.value = values[handle];
        });

      // listener de el input para asignarle el valor al slider no se usa por que esta oculto

        p6.addEventListener('change', function(){
        	p6slider.noUiSlider.set(this.value);
        });



        // slider pregunta 7

          var p7slider = document.getElementById('p7slider');

          noUiSlider.create(p7slider, {
          	start: 5,
          	step: 1,
            connect: [true, true],
          	range: {
          		'min': 0,
          		'max': 10
          	}
          });


          var handle = p7slider.querySelector('.noUi-handle');

          handle.addEventListener('keydown', function( e ) {

          	var value = Number( p7slider.noUiSlider.get() );

          	if ( e.which === 37 ) {
          		p7slider.noUiSlider.set( value - 1 );
          	}

          	if ( e.which === 39 ) {
          		p7slider.noUiSlider.set( value + 1 );
          	}
          });

          // listener de el slider para asignarle el valor al input

            var p7 = document.getElementById('p7');

            p7slider.noUiSlider.on('update', function( values, handle ) {
            	p7.value = values[handle];
            });

          // listener de el input para asignarle el valor al slider no se usa por que esta oculto

            p7.addEventListener('change', function(){
            	p7slider.noUiSlider.set(this.value);
            });



          // slider pregunta 8

            var p8slider = document.getElementById('p8slider');

            noUiSlider.create(p8slider, {
            	start: 5,
            	step: 1,
              connect: [true, true],
            	range: {
            		'min': 0,
            		'max': 10
            	}
            });


            var handle = p8slider.querySelector('.noUi-handle');

            handle.addEventListener('keydown', function( e ) {

            	var value = Number( p8slider.noUiSlider.get() );

            	if ( e.which === 37 ) {
            		p8slider.noUiSlider.set( value - 1 );
            	}

            	if ( e.which === 39 ) {
            		p8slider.noUiSlider.set( value + 1 );
            	}
            });

            // listener de el slider para asignarle el valor al input

              var p8 = document.getElementById('p8');

              p8slider.noUiSlider.on('update', function( values, handle ) {
              	p8.value = values[handle];
              });

            // listener de el input para asignarle el valor al slider no se usa por que esta oculto

              p8.addEventListener('change', function(){
              	p8slider.noUiSlider.set(this.value);
              });



            // slider pregunta 9

              var p9slider = document.getElementById('p9slider');

              noUiSlider.create(p9slider, {
              	start: 5,
              	step: 1,
                connect: [true, true],
              	range: {
              		'min': 0,
              		'max': 10
              	}
              });


              var handle = p9slider.querySelector('.noUi-handle');

              handle.addEventListener('keydown', function( e ) {

              	var value = Number( p9slider.noUiSlider.get() );

              	if ( e.which === 37 ) {
              		p9slider.noUiSlider.set( value - 1 );
              	}

              	if ( e.which === 39 ) {
              		p9slider.noUiSlider.set( value + 1 );
              	}
              });

              // listener de el slider para asignarle el valor al input

                var p9 = document.getElementById('p9');

                p9slider.noUiSlider.on('update', function( values, handle ) {
                	p9.value = values[handle];
                });

              // listener de el input para asignarle el valor al slider no se usa por que esta oculto

                p9.addEventListener('change', function(){
                	p9slider.noUiSlider.set(this.value);
                });



                // slider pregunta 11

                  var p11slider = document.getElementById('p11slider');

                  noUiSlider.create(p11slider, {
                  	start: 5,
                  	step: 1,
                    connect: [true, true],
                  	range: {
                  		'min': 0,
                  		'max': 10
                  	}
                  });


                  var handle = p11slider.querySelector('.noUi-handle');

                  handle.addEventListener('keydown', function( e ) {

                  	var value = Number( p11slider.noUiSlider.get() );

                  	if ( e.which === 37 ) {
                  		p11slider.noUiSlider.set( value - 1 );
                  	}

                  	if ( e.which === 39 ) {
                  		p11slider.noUiSlider.set( value + 1 );
                  	}
                  });

                  // listener de el slider para asignarle el valor al input

                    var p11 = document.getElementById('p11');

                    p11slider.noUiSlider.on('update', function( values, handle ) {
                    	p11.value = values[handle];
                    });

                  // listener de el input para asignarle el valor al slider no se usa por que esta oculto

                    p11.addEventListener('change', function(){
                    	p11slider.noUiSlider.set(this.value);
                    });


                    // slider pregunta 12

                      var p12slider = document.getElementById('p12slider');

                      noUiSlider.create(p12slider, {
                      	start: 5,
                      	step: 1,
                        connect: [true, true],
                      	range: {
                      		'min': 0,
                      		'max': 10
                      	}
                      });


                      var handle = p12slider.querySelector('.noUi-handle');

                      handle.addEventListener('keydown', function( e ) {

                      	var value = Number( p12slider.noUiSlider.get() );

                      	if ( e.which === 37 ) {
                      		p12slider.noUiSlider.set( value - 1 );
                      	}

                      	if ( e.which === 39 ) {
                      		p12slider.noUiSlider.set( value + 1 );
                      	}
                      });

                      // listener de el slider para asignarle el valor al input

                        var p12 = document.getElementById('p12');

                        p12slider.noUiSlider.on('update', function( values, handle ) {
                        	p12.value = values[handle];
                        });

                      // listener de el input para asignarle el valor al slider no se usa por que esta oculto

                        p12.addEventListener('change', function(){
                        	p12slider.noUiSlider.set(this.value);
                        });


                        // slider pregunta 13

                          var p13slider = document.getElementById('p13slider');

                          noUiSlider.create(p13slider, {
                          	start: 5,
                          	step: 1,
                            connect: [true, true],
                          	range: {
                          		'min': 0,
                          		'max': 10
                          	}
                          });


                          var handle = p13slider.querySelector('.noUi-handle');

                          handle.addEventListener('keydown', function( e ) {

                          	var value = Number( p13slider.noUiSlider.get() );

                          	if ( e.which === 37 ) {
                          		p13slider.noUiSlider.set( value - 1 );
                          	}

                          	if ( e.which === 39 ) {
                          		p13slider.noUiSlider.set( value + 1 );
                          	}
                          });

                          // listener de el slider para asignarle el valor al input

                            var p13 = document.getElementById('p13');

                            p13slider.noUiSlider.on('update', function( values, handle ) {
                            	p13.value = values[handle];
                            });

                          // listener de el input para asignarle el valor al slider no se usa por que esta oculto

                            p13.addEventListener('change', function(){
                            	p13slider.noUiSlider.set(this.value);
                            });


  </script>

      <script>




          $(document).ready(function () {
             $('#p15textarea').hide();
             $('#p16textarea').hide();
             $('#p15_cual').attr('disabled','disabled');
             $('#p16_cual').attr('disabled','disabled');

              $('.i-checks').iCheck({
                  radioClass: 'iradio_square-green',
                  checkboxClass: 'icheckbox_square-green',
              });


              $('input[name=p15_otro]').on('ifChecked', function(event){
                    $('#p15textarea').show();
                    $('#p15_cual').removeAttr('disabled','disabled');
              });

              $('input[name=p15_otro]').on('ifUnchecked', function(event){
                    $('#p15textarea').hide();
                    $('#p15_cual').attr('disabled','disabled');
              });


              $('input[name=p16_otro]').on('ifChecked', function(event){
                    $('#p16textarea').show();
                    $('#p16_cual').removeAttr('disabled');
              });

              $('input[name=p16_otro]').on('ifUnchecked', function(event){
                    $('#p16textarea').hide();
                    $('#p16_cual').attr('disabled','disabled');
              });



          });
      </script>



@endpush
