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

			@include('reservaciones.invoice')

			<div class="panel panel-default text-right">
				<div class="panel-body">
					<a class="btn btn-success" href="{{ route('imprimirReservacion', [$reservacion->idreservacion])}}" target="_blank"><i class="fa fa-print"></i> Imprimir</a>
				</div>
			</div>

		</div>
		
	</section>
	<!-- /MIDDLE -->

@endsection