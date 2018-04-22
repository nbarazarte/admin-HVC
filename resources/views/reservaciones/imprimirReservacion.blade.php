@extends('app')

@section('content')



	@foreach ($reservaciones as $reservacion)

	@endforeach



		<!-- WRAPPER -->
		<div id="wrapper">

			<div class="padding-20">

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

												<span class="label label-success">Pagado</span>

											@endif

										</li>

										<li>
											<strong>
												{{ $reservacion->str_estatus_pago }}
											</strong>
										</li>
									</ul>

								</div>

							</div>

							<div class="table-responsive">
								<table class="table table-condensed nomargin">
									<thead>
										<tr>
											<th>Acompañante</th>
											<th>Cédula/Pasaporte</th>
											<th>Adulto/Niño</th>
											<th>País</th>
											<th>Bandera</th>
										</tr>
									</thead>
									<tbody>

										@foreach ($acompanantes as $acompanante)

											<tr>
												<td>
													<div><strong>{{ $acompanante->str_nombre }}</strong></div>
												</td>
												<td>{{ $acompanante->str_ci_pasaporte }}</td>
												<td>{{ $acompanante->tipopersona }}</td>
												<td>{{ $acompanante->str_paises }}</td>
												<td><img src="data:image/jpeg;base64,{{ $acompanante->bandera }}" alt="{!! $acompanante->str_paises !!}" title="{!! $acompanante->str_paises !!}" height="14" width="30"></td>
											</tr>

										@endforeach

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

				</div>
		</div>	

		<script type="text/javascript">
			window.print();
		</script>
@endsection