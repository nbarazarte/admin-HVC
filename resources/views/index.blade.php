@extends('app')

@section('content')

@include('menu')

<section id="middle">
	<div id="content" class="dashboard padding-20">

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
					<strong>Resumen del Hotel</strong> <!-- panel title -->
					<small class="size-12 weight-300 text-mutted hidden-xs">{{ date('Y')}}</small>
				</span>

				<!-- right options -->
				<ul class="options pull-right list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
				</ul>
				<!-- /right options -->

			</div>

			<!-- panel content -->
			<div class="panel-body">

				<div id="flot-sales" class="fullwidth height-250"></div>

			</div>
			<!-- /panel content -->

			<!-- panel footer -->
			<div class="panel-footer">

				<!-- 
					.md-4 is used for a responsive purpose only on col-md-4 column.
					remove .md-4 if you use on a larger column
				-->

				<?php

					if($matrimonial == 0){

						$porcentaje_matrimonial = 0;

					}else{

						$porcentaje_matrimonial = ($matrimonial * 100) / $totalReservaciones;
					}

					if ($suite == 0) {
						
						$porcentaje_suite = 0;

					}else{

						$porcentaje_suite = ($suite * 100) / $totalReservaciones;

					}

					if ($doble == 0) {
						
						$porcentaje_doble = 0;

					}else{

						$porcentaje_doble = ($doble * 100) / $totalReservaciones;

					}

					if ($familiar == 0) {
						
						$porcentaje_familiar = 0;

					}else{

						$porcentaje_familiar = ($familiar * 100) / $totalReservaciones;

					}

				?>

				<ul class="easypiecharts list-unstyled">
					<li class="clearfix">
						<span class="stat-number">{{ $matrimonial }}</span>
						<span class="stat-title"><strong>Matrimonial</strong></span>

						<span class="easyPieChart" data-percent="{{ $porcentaje_matrimonial }}" data-easing="easeOutBounce" data-barColor="#35459C" data-trackColor="#dddddd" data-scaleColor="#dddddd" data-size="60" data-lineWidth="4">
							<span class="percent"></span>
						</span> 
					</li>
					<li class="clearfix">
						<span class="stat-number">{{ $suite }}</span>
						<span class="stat-title"><strong>Suite</strong></span>

						<span class="easyPieChart" data-percent="{{ $suite }}" data-easing="easeOutBounce" data-barColor="#F47741" data-trackColor="#dddddd" data-scaleColor="#dddddd" data-size="60" data-lineWidth="4">
							<span class="percent"></span>
						</span> 
					</li>
					<li class="clearfix">
						<span class="stat-number">{{ $doble }}</span>
						<span class="stat-title"><strong>Doble</strong></span>

						<span class="easyPieChart" data-percent="{{ $porcentaje_doble }}" data-easing="easeOutBounce" data-barColor="#41B649" data-trackColor="#dddddd" data-scaleColor="#dddddd" data-size="60" data-lineWidth="4">
							<span class="percent"></span>
						</span> 
					</li>
					<li class="clearfix">
						<span class="stat-number">{{ $familiar }}</span>
						<span class="stat-title"><strong>Familiar</strong></span>

						<span class="easyPieChart" data-percent="{{ $porcentaje_familiar }}" data-easing="easeOutBounce" data-barColor="#7952A1" data-trackColor="#dddddd" data-scaleColor="#dddddd" data-size="60" data-lineWidth="4">
							<span class="percent"></span>
						</span> 
					</li>
				</ul>

			</div>
			<!-- /panel footer -->

		</div>
		<!-- /PANEL -->



		<!-- BOXES -->
		<div class="row">

			<!-- Feedback Box -->
			<div class="col-md-6 col-sm-6">

				<!-- BOX -->
				<div class="box danger"><!-- default, danger, warning, info, success -->

					@foreach ($reservacionesPaisesHoy as $resHoy)

					@endforeach

					<?php

						if (!empty($reservacionesPaisesHoy)) {
							
							$hoy = $resHoy->total;

						}else{
							
							$hoy = 0;
						}

					?>
					<div class="box-title"><!-- add .noborder class if box-body is removed -->
						<h4><a href="#">{!! $totalReservaciones !!} Reservaciones</a></h4>
						<small class="block">{{ $hoy }} Nuevas reservaciones hechas hoy</small>
						<i class="fa fa fa-bed"></i>
					</div>



				</div>
				<!-- /BOX -->

			</div>

			<!-- Profit Box -->
			<div class="col-md-6 col-sm-6">

				<!-- BOX -->
				<div class="box warning"><!-- default, danger, warning, info, success -->

					@foreach ($clientesPaisesHoy as $clientesHoy)

					@endforeach

					<?php

						if (!empty($clientesPaisesHoy)) {
							
							$hoyClientes = $clientesHoy->total;

						}else{
							
							$hoyClientes = 0;
						}

					?>					

					<div class="box-title"><!-- add .noborder class if box-body is removed -->
						<h4>{!! $totalClientes !!}  Clientes</h4>
						<small class="block">{{ $hoyClientes }} Nuevos Clientes hoy</small>
						<i class="fa fa-users"></i>
					</div>


				</div>
				<!-- /BOX -->

			</div>


		</div>
		<!-- /BOXES -->



		<div class="row">


			<div class="col-md-6">

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
				<div id="panel-3" class="panel panel-default">
					<div class="panel-heading">
						<span class="title elipsis">
							<strong>Reservaciones</strong> <!-- panel title -->

						</span>
					</div>

					<!-- panel content -->
					<div class="panel-body">

						<ul class="list-unstyled list-hover slimscroll height-300" data-slimscroll-visible="true">

							@foreach ($reservacionesPaises as $res) 

								<li>									
									<img src="data:image/jpeg;base64,{{ $res->blb_img }}" alt="{!! $res->str_paises !!}" title="{!! $res->str_paises !!}" height="34"> {{ $res->str_paises }} : <b>{{ $res->total }}</b> 
								</li>
			


							@endforeach

						</ul>

					</div>
					<!-- /panel content -->

				</div>
				<!-- /PANEL -->

			</div>

			<div class="col-md-6">

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
				<div id="panel-3" class="panel panel-default">
					<div class="panel-heading">
						<span class="title elipsis">
							<strong>CLIENTES</strong> <!-- panel title -->
						</span>
					</div>

					<!-- panel content -->
					<div class="panel-body">

						<ul class="list-unstyled list-hover slimscroll height-300" data-slimscroll-visible="true">

						@foreach ($clientes as $cliente) 
							
                            @if ($cliente->blb_img != "")
								<li>									
									<img src="data:image/jpeg;base64,{{ $cliente->blb_img }}" alt="{!! $cliente->name !!}" title="{!! $cliente->name !!}" height="34">

									<b>{{ ucwords(strtolower($cliente->name)) }}</b> : {{ $cliente->str_paises }} 
								</li>
							@else

							  @if ($cliente->str_genero == 'Masculino')
							  	<li>
									<img src="{{ asset('smarty/assets/images/user_masculino.png') }}" alt="" height="34">
									<b>{{ ucwords(strtolower($cliente->name)) }}</b> : {{ $cliente->str_paises }}				  	
								</li>
							  @elseif ($cliente->str_genero == 'Femenino')
								<li>
									<img src="{{ asset('smarty/assets/images/user_femenino.png') }}" alt="" height="34">
									<b>{{ ucwords(strtolower($cliente->name)) }}</b> : {{ $cliente->str_paises }}
								</li>
							  @endif

							 @endif	

						@endforeach

						</ul>

					</div>
					<!-- /panel content -->

				</div>
				<!-- /PANEL -->

			</div>

		</div>

	</div>
</section>
<!-- /MIDDLE -->

@endsection		