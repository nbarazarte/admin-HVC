@extends('app')

@section('content')		

	<div class="padding-15">

		<div class="container">

		    @if (Session::has('errors'))

		        <div class="alert alert-danger alert-dismissible" role="alert">
		            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                  <ul>
		                    <!-- <strong>Oops! Something went wrong : </strong> -->
		                    <strong>Por favor complete los siguientes campos: </strong>
		                    @foreach ($errors->all() as $error)
		                         <li>{{ $error }}</li>
		                    @endforeach
		                </ul>
		        </div>

		    @endif

            @if(Session::has('message'))
            
                <div class="alert alert-success" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong><i class="fa fa-check"></i></strong> {{Session::get('message')}}
                </div>                          
        
            @endif

            @if(Session::has('error'))
            
                <div class="alert alert-danger" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong><i class="fa fa-exclamation-triangle"></i></strong> {{Session::get('error')}}
                </div>                          
        
            @endif              		    

		</div>

		<div class="login-box">

			<!--
			<div class="alert alert-danger noradius">Email not found!</div>
			<div class="alert alert-success noradius">Email sent!</div>
			-->

			<!-- password form -->
			 {!! Form::open(['route' => 'recuperar', 'class' => 'sky-form boxed', '']) !!}
				<header><i class="fa fa-users"></i> Recuperar clave</header>
				
				<fieldset>	
				
					<label class="label">Correo Electrónico</label>
					<label class="input">
						<i class="icon-append fa fa-envelope"></i>
						<input id="email" name="email" type="email">
						<span class="tooltip tooltip-top-right">Ingrese su dirección de correo electrónico</span>
					</label>
					<a href="{{ route('login')}}">Volver al inicio</a>

				</fieldset>

				<footer>
					<button type="submit" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-refresh"></i> Recuperar clave</button>
				</footer>
			{!! Form::close() !!}
			<!-- /password form -->

			<div class="alert alert-default noradius">
				La nueva clave de acceso le será enviada a su dirección de correo de iLernus, pulse el botón de reiniciar clave.
			</div>

		</div>

	</div>

@endsection		