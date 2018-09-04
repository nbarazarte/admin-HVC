@extends('app')

@section('content')

@include('menu')


<div id="pagina"></div>

			<!-- 
				MIDDLE 
			-->
			<section id="middle">
				<!-- page title -->
				<header id="page-header">
					<h1>Buscar Reservaciones</h1>
					<ol class="breadcrumb">
					 <li><a href="{{ route('home')}}">Dashboard</a></li>
					  <li class="active">Buscar Reservaciones</li>
					</ol>

				</header>
				<!-- /page title -->

				<div id="content" class="padding-20">

					<!-- 
						PANEL CLASSES:
							panel-default
							panel-danger
							panel-warning
							panel-info
							panel-success

						INFO: 	panel collapse - stored on user localStorage (handled by app.js _panels() function).
								All pannels should have an unique ID or the panel collapse status will not be stored!
					-->
					<div id="panel-1" class="panel panel-default">
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>LISTADO DE RESERVACIONES </strong> <!-- panel title -->
							</span>

							<!-- right options -->
							<ul class="options pull-right list-inline">
								<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Minimizar" data-placement="bottom"></a></li>
								<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Pantalla Completa" data-placement="bottom"><i class="fa fa-expand"></i></a></li>

							</ul>
							<!-- /right options -->

						</div>

						<!-- panel content -->
						<div class="panel-body">

							<table class="table table-striped table-bordered table-hover" id="datatable_sample">
								<thead style="text-align: center;">
									<tr>
										<th>Ver</th>
										<th>Cliente</th>
										<th>CI/Pasaporte</th>
										<th>País</th>
										<th>Habitación</th>
										<th>Entrada</th>
										<th>Salida</th>
										<th>Días</th>
										<th>Reservación</th>
										<th>Pago</th>
									</tr>
								</thead>

								<tbody style="font-size: 12px; text-align: center; cursor: pointer;">

									@foreach ($reservaciones as $reservacion)

										<tr class="odd gradeX">

												<td>

													<a href="{{ route('verReservacion',[$reservacion->idreservacion]) }}" type="button" class="btn btn-warning">
														
														<i class="fa fa-search" aria-hidden="true"></i>

													</a>

												</td>

												<td>
														{{ ucwords(strtolower($reservacion->str_nombre)) }}
												</td>

												<td>
														{{ $reservacion->str_ci_pasaporte }}
												</td>

												<td>

												  	<center>
													  	<figure class="margin-bottom-10"><!-- image -->						                            
					                            			<img src="data:image/jpeg;base64,{{ $reservacion->bandera }}" alt="{!! $reservacion->str_paises !!}" title="{!! $reservacion->str_paises !!}" height="24" width="40">
					                            		</figure>
					                            	</center>	

													{{ $reservacion->str_paises }}
												</td>

												<td>
													 	{{ ucfirst($reservacion->str_habitacion) }}
												</td>

												<td>
													<?php

			                                            $date1 = new DateTime($reservacion->dmt_fecha_entrada);
			                                            $fecha_entrada = $date1->format('d-m-Y');
			                                        ?>
														{{ $fecha_entrada }}
												</td>

												<td>
													<?php

			                                            $date2 = new DateTime($reservacion->dmt_fecha_salida);
			                                            $fecha_salida = $date2->format('d-m-Y');
			                                        ?>
														{{ $fecha_salida }}
												</td>											

												<td>
													 {{ $reservacion->int_dias }}
												</td>

												<td>

													@if($reservacion->str_tipo_reserva == 'Web')

														<span class="label label-info">{{ $reservacion->str_tipo_reserva }}</span></h4>

													@else

														<span class="label label-danger">{{ $reservacion->str_tipo_reserva }}</span></h4>

													@endif													

												</td>
												
												<td>

													@if($reservacion->str_estatus_pago == null)

														<span class="label label-warning">Pendiente</span>
													
													@else

														<span class="label label-success">{{ $reservacion->str_estatus_pago }}</span>

													@endif

												</td>

										</tr>

									@endforeach

								</tbody>
							</table>

						</div>
						<!-- /panel content -->

					</div>
					<!-- /PANEL -->

				</div>
			</section>
			<!-- /MIDDLE -->

@endsection