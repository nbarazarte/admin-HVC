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

		</div>

		<div class="login-box">

			<!-- login form -->
			 {!! Form::open(['route' => 'login', 'class' => 'sky-form boxed', '']) !!}
				<header><i class="fa fa-users"></i> Bienvenidos a iAdmin</header>

				<!--
				<div class="alert alert-danger noborder text-center weight-400 nomargin noradius">
					Invalid Email or Password!
				</div>

				<div class="alert alert-warning noborder text-center weight-400 nomargin noradius">
					Account Inactive!
				</div>

				<div class="alert alert-default noborder text-center weight-400 nomargin noradius">
					<strong>Too many failures!</strong> <br />
					Please wait: <span class="inlineCountdown" data-seconds="180"></span>
				</div>
				-->

				<fieldset>	
				
					<section>
						<label class="label">Correo Electrónico</label>
						<label class="input">
							<i class="icon-append fa fa-envelope"></i>
							<input id="email" name="email" type="email">
							<span class="tooltip tooltip-top-right">Ingrese su dirección de correo electrónico</span>
						</label>
					</section>
					
					<section>
						<label class="label">Clave</label>
						<label class="input">
							<i class="icon-append fa fa-lock"></i>
							<input id="password" name="password" type="password">
							<b class="tooltip tooltip-top-right">Ingrese su clave</b>
						</label>
						<label class="checkbox"><input type="checkbox" id="remember" name="remember" checked><i></i>Mantener sessión</label>
					</section>

				</fieldset>

				<footer>
					{!! Form::submit('Entrar',['class' => 'btn btn-primary pull-right']) !!}
					<div class="forgot-password pull-left">
						<a href="{{ route('recuperar')}}">¿Olvidó su clave?</a> 
						
					</div>
				</footer>
			 {!! Form::close() !!}
			<!-- /login form -->

		</div>

	</div>

@endsection