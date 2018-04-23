@extends('app')

@section('content')

@foreach ($reservaciones as $reservacion)

@endforeach

	<!-- WRAPPER -->
	<div id="wrapper">

		<div class="padding-20">

			@include('reservaciones.invoice')

		</div>
	</div>	

	<script type="text/javascript">
		window.print();
	</script>
	
@endsection