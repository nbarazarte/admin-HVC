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
					<strong>Resumen de Cursos</strong> <!-- panel title -->
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

					$porcentaje_negocios = ($negocios * 100) / $totalCursos;

					$porcentaje_desarrollo = ($desarrollo * 100) / $totalCursos;

					$porcentaje_tecnologia = ($tecnologia * 100) / $totalCursos;

					$porcentaje_productividad = ($productividad * 100) / $totalCursos;

				?>

				<ul class="easypiecharts list-unstyled">
					<li class="clearfix">
						<span class="stat-number">{{ $negocios }}</span>
						<span class="stat-title"><strong>Negocios</strong></span>

						<span class="easyPieChart" data-percent="{{ $porcentaje_negocios }}" data-easing="easeOutBounce" data-barColor="#35459C" data-trackColor="#dddddd" data-scaleColor="#dddddd" data-size="60" data-lineWidth="4">
							<span class="percent"></span>
						</span> 
					</li>
					<li class="clearfix">
						<span class="stat-number">{{ $tecnologia }}</span>
						<span class="stat-title"><strong>Tecnología</strong></span>

						<span class="easyPieChart" data-percent="{{ $porcentaje_tecnologia }}" data-easing="easeOutBounce" data-barColor="#F47741" data-trackColor="#dddddd" data-scaleColor="#dddddd" data-size="60" data-lineWidth="4">
							<span class="percent"></span>
						</span> 
					</li>
					<li class="clearfix">
						<span class="stat-number">{{ $desarrollo }}</span>
						<span class="stat-title"><strong>Desarrollo</strong></span>

						<span class="easyPieChart" data-percent="{{ $porcentaje_desarrollo }}" data-easing="easeOutBounce" data-barColor="#41B649" data-trackColor="#dddddd" data-scaleColor="#dddddd" data-size="60" data-lineWidth="4">
							<span class="percent"></span>
						</span> 
					</li>
					<li class="clearfix">
						<span class="stat-number">{{ $productividad }}</span>
						<span class="stat-title"><strong>Productividad</strong></span>

						<span class="easyPieChart" data-percent="{{ $porcentaje_productividad }}" data-easing="easeOutBounce" data-barColor="#7952A1" data-trackColor="#dddddd" data-scaleColor="#dddddd" data-size="60" data-lineWidth="4">
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

					<div class="box-title"><!-- add .noborder class if box-body is removed -->
						<h4><a href="#">{!! $totalCursos !!} Cursos</a></h4>
						<!--<small class="block">654 New fedbacks today</small>-->
						<i class="fa fa fa-book"></i>
					</div>

					<div class="box-body text-center">
						<span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
							331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327,331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
						</span>
					</div>

				</div>
				<!-- /BOX -->

			</div>

			<!-- Profit Box -->
			<div class="col-md-6 col-sm-6">

				<!-- BOX -->
				<div class="box warning"><!-- default, danger, warning, info, success -->

					<div class="box-title"><!-- add .noborder class if box-body is removed -->
						<h4>{!! $totalInstructores !!}  Instructores</h4>
						<!--<small class="block">1,2 M Profit for this month</small>-->
						<i class="fa fa-graduation-cap"></i>
					</div>

					<div class="box-body text-center">
						<span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
							331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327,331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
						</span>
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
							<strong>CURSOS RECIENTES</strong> <!-- panel title -->
						</span>
					</div>

					<!-- panel content -->
					<div class="panel-body">

						<ul class="list-unstyled list-hover slimscroll height-300" data-slimscroll-visible="true">
							
						@foreach ($cursos as $curso) 
							
							<li>
								
								<span class="label" style="background-color: {{ $curso->str_color }}">{{ $curso->str_categoria }}</span>

								{!! str_replace("-"," ",$curso->str_curso) !!}
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
							<strong>NUEVOS INSTRUCTORES</strong> <!-- panel title -->
						</span>
					</div>

					<!-- panel content -->
					<div class="panel-body">

						<ul class="list-unstyled list-hover slimscroll height-300" data-slimscroll-visible="true">

						@foreach ($instructores as $instructor) 
							
							<li>
								
								<img src="data:image/jpeg;base64,{{ $instructor->blb_img }}" alt="{!! $instructor->str_nombre !!}" title="{!! $instructor->str_nombre !!}" height="34">

								<b>{{ $instructor->str_nombre }}</b> : {{ $instructor->str_profesion }} 
							</li>

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