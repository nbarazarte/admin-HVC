@extends('app')

@section('content')

@include('menu')

	@foreach ($reservaciones as $reservacion)

	@endforeach

			<!-- 
				MIDDLE 
			-->
			<section id="middle">

				<!-- page title -->
				<header id="page-header">
					<h1>Ver Reservación </h1>
					<ol class="breadcrumb">
						<li><a href="{{ route('home')}}">Dashboard</a></li>
						<li><a href="{{ route('buscarReservacion')}}">Buscar Reservación </a></li>
						<li class="active">Ver Reservación </li>
					</ol>
				</header>

				<!-- /page title -->

				<div id="content" class="padding-20">

					<div class="panel panel-default">
						<div class="panel-body">

							<div class="row">

								<div class="col-md-6 col-sm-6 text-left">

									<h4><strong>Datos del</strong> Cliente</h4>
									<ul class="list-unstyled">
										<li><strong>Nombre y Apellido:</strong> {{ $reservacion->name }}</li>
										<li><strong>País:</strong> {{ $reservacion->str_paises }} <img src="data:image/jpeg;base64,{{ $reservacion->bandera }}" alt="{!! $reservacion->str_paises !!}" title="{!! $reservacion->str_paises !!}" height="14" width="30"></li>
										<li><strong>Cédula/Pasaporte:</strong> {{ $reservacion->str_ci_pasaporte }}</li>
										<li><strong>Sexo:</strong> {{ $reservacion->str_genero }}</li>
										<li><strong>Teléfono:</strong> {{ $reservacion->phone }}</li>
										<li><strong>Correo Electrónico:</strong> {{ $reservacion->email }}</li>
									</ul>

								</div>

								<div class="col-md-6 col-sm-6 text-right">

									<h4><strong>Datos de</strong> la Habitación</h4>
									<ul class="list-unstyled">
										<li><strong>Tipo de Habitación:</strong> {{ $reservacion->str_habitacion }}</li>
										<li><strong>Fecha de Entrada:</strong> 													
											<?php
												$date1 = new DateTime($reservacion->dmt_fecha_entrada);
		                                            $fecha_entrada = $date1->format('d-m-Y');
		                                        ?>
											{{ $fecha_entrada }}
										</li>
										<li><strong>Fecha de Salida:</strong>
											<?php
												$date2 = new DateTime($reservacion->dmt_fecha_salida);
		                                            $dmt_fecha_salida = $date2->format('d-m-Y');
		                                        ?>
											{{ $dmt_fecha_salida }}
										</li>
										<li><strong>Estatus del Pago:</strong>
											@if($reservacion->str_estatus_pago == null)

												<span class="label label-warning">Pendiente</span>
											
											@else

												<span class="label label-success">{{ $reservacion->str_estatus_pago }}</span>

											@endif

										</li>
									</ul>

								</div>

							</div>

							<div class="table-responsive">
								<table class="table table-condensed nomargin">
									<thead>
										<tr>
											<th>Adulto</th>
											<th>Cédula/Pasaporte</th>
											<th>Correo</th>
											<th>Telefono</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<div><strong>{{ $reservacion->str_nombre }}</strong></div>
											</td>
											<td></td>
											<td>{{ $reservacion->str_email }}</td>
											<td>{{ $reservacion->str_telefono }}</td>
										</tr>


									</tbody>
								</table>
							</div>

							<hr class="nomargin-top" />

							<div class="row">

								<div class="col-sm-6 text-left">
									<h4><strong>Datos</strong> Adicionales</h4>

									<p class="nomargin nopadding">
										<strong>Mensaje:</strong> 
										{{ $reservacion->str_mensaje }}
									</p><br><!-- no P margin for printing - use <br> instead -->



								</div>

								<div class="col-sm-6 text-right">

									<ul class="list-unstyled">
										<li><strong>Precio de la Habitación:</strong> {{ number_format($reservacion->dbl_precio , 2, ',', '.')   }}</li>
										<li><strong>Cantidad de días:</strong> {{ $reservacion->int_dias }}</li>
										<li><strong>Total a pagar:</strong> {{ number_format($reservacion->dbl_total_pagar , 2, ',', '.')   }} </li>
									</ul>     

								
								</div>

							</div>

						</div>
					</div>

					<div class="panel panel-default text-right">
						<div class="panel-body">
							<a class="btn btn-success" href="page-invoice-print.html" target="_blank"><i class="fa fa-print"></i> Imprimir</a>
						</div>
					</div>

				</div>
			</section>
			<!-- /MIDDLE -->

<script type="text/javascript">

	function todasEtiquetas() {

		var categoria = document.getElementsByName("categoria");

		if(categoria[0].checked == true){

		    var x = document.getElementsByName("str_categoria");
		    var i;
		    for (i = 0; i < x.length; i++) {
		        if (x[i].type == "checkbox") {
		            x[i].checked = true;
		        }
		    }

		}else{

		    var x = document.getElementsByName("str_categoria");
		    var i;
		    for (i = 0; i < x.length; i++) {
		        if (x[i].type == "checkbox") {
		            x[i].checked = false;
		        }
		    }

		}
	}

	function showfieldTipo(name){

	    var x = document.getElementsByName("str_tipo");
	    var i;
	    for (i = 0; i < x.length; i++) {
	        x[i].value = name;
	    }

		if(name=='simple'){
	  	
	  			document.getElementById('simple').style.display='inline';
	  		document.getElementById('imagen').style.display='none';
	  		document.getElementById('carrusel-imagen').style.display='none';
	  		document.getElementById('audio').style.display='none';
	  		document.getElementById('video').style.display='none';
	  		document.getElementById('defecto').style.display='none';

	  	}else if (name=='imagen'){ 

	  		document.getElementById('simple').style.display='none';
	  			document.getElementById('imagen').style.display='inline';
	  		document.getElementById('carrusel-imagen').style.display='none';
	  		document.getElementById('audio').style.display='none';
	  		document.getElementById('video').style.display='none';
	  		document.getElementById('defecto').style.display='none';		

		}else if (name=='carrusel-imagen'){ 

	  		document.getElementById('simple').style.display='none';
	  		document.getElementById('imagen').style.display='none';
	  			document.getElementById('carrusel-imagen').style.display='inline';
	  		document.getElementById('audio').style.display='none';
	  		document.getElementById('video').style.display='none';
	  		document.getElementById('defecto').style.display='none';  		

		}else if (name=='video'){ 

	  		document.getElementById('simple').style.display='none';
	  		document.getElementById('imagen').style.display='none';
	  		document.getElementById('carrusel-imagen').style.display='none';
	  		document.getElementById('audio').style.display='none';
	  			document.getElementById('video').style.display='inline';
	  		document.getElementById('defecto').style.display='none';

		}else if (name=='audio'){ 

	  		document.getElementById('simple').style.display='none';
	  		document.getElementById('imagen').style.display='none';
	  		document.getElementById('carrusel-imagen').style.display='none';
	  			document.getElementById('audio').style.display='inline';
	  		document.getElementById('video').style.display='none';
	  		document.getElementById('defecto').style.display='none';

		}

	}


	function showfield(name){

		if(name=='youtube'){
	  	
	  		document.getElementById('div1').innerHTML='<textarea id="str_video" name="str_video" class="form-control required" placeholder="Ejemplo: <iframe class=embed-responsive-item width=560 height=315 src=http://www.youtube.com/embed/W7Las-MJnJo></iframe>" rows="4" cols="350"></textarea><span class="tooltip tooltip-top-right">Ingrese el link de video</span>';

	  	}else if (name=='vimeo'){ 

	  		document.getElementById('div1').innerHTML='<textarea id="str_video" name="str_video" class="form-control required" placeholder="Ejemplo: <iframe class=embed-responsive-item src=http://player.vimeo.com/video/8408210 width=800 height=450></iframe>" rows="4" cols="350"></textarea><span class="tooltip tooltip-top-right">Ingrese el link de video</span>';

		}

	}

</script>
@endsection