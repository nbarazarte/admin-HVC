@extends('app')

@section('content')

@include('menu')

		@foreach ($usuarios as $usuario)

		@endforeach
			<!-- 
				MIDDLE 
			-->
			<section id="middle">

				<!-- page title -->
				<header id="page-header">
					<h1>Ver Cuenta</h1>
					<ol class="breadcrumb">
						<li><a href="{{ route('home')}}">Dashboard</a></li>
						<li><a href="{{ route('buscarCuenta')}}">Buscar Cuenta</a></li>
						<li class="active">Ver Cuenta</li>
					</ol>
				</header>

				<!-- /page title -->

				<div id="content" class="padding-20">

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

					<div class="page-profile">

						<div class="row">

							<!-- COL 1 -->
							<div class="col-md-4 col-lg-3">
								<section class="panel">
									<div class="panel-body noradius padding-10">

			                            @if ($usuario->blb_img != "")
			                            	<center>
				                            	<figure class="margin-bottom-10"><!-- image -->
				                            		<img src="data:image/jpeg;base64,{{ $usuario->blb_img }}" alt="{!! $usuario->str_nombre !!} {!! $usuario->str_apellido !!}" title="{!! $usuario->str_nombre !!} {!! $usuario->str_apellido !!}" height="130">
				                            	</figure>
			                            	</center>
										@else

										  @if ($usuario->str_genero == 'Masculino')
										  	<center>
											  	<figure class="margin-bottom-10"><!-- image -->
											  		<img src="{{ asset('smarty/assets/images/user_masculino.png') }}" alt="" height="130">
											  	</figure>
										  	</center>						  	
										  @elseif ($usuario->str_genero == 'Femenino')
										  	<center>
											  	<figure class="margin-bottom-10"><!-- image -->
											  		<img src="{{ asset('smarty/assets/images/usuario_femenino.png') }}" alt="" height="130">
											  	</figure>
										  	</center>
										  @endif

										 @endif

										<hr class="half-margins" />
										
										<!-- About -->
										<h3 class="text-black">
											{{ $usuario->name }}<br>
											<small class="text-gray size-14"> {{ ucfirst($usuario->str_nombre) }} {{ ucfirst($usuario->str_apellido) }} </small>
										</h3>

										<!-- /About -->

										<hr class="half-margins" />

										<!-- Social -->
										<h6>Redes Sociales</h6>
										<a href="#" class="btn ico-only btn-facebook btn-xs" title="Facebook"><i class="fa fa-facebook"></i></a>
										<a href="#" class="btn ico-only btn-twitter btn-xs" title="Twitter"><i class="fa fa-twitter"></i></a>
										<a href="#" class="btn ico-only btn-instagram btn-xs" title="Instagram"><i class="fa fa-instagram"></i></a>
										<a href="#" class="btn ico-only btn-linkedin btn-xs" title="Linked In"><i class="fa fa-linkedin"></i></a>
										<a href="#" class="btn ico-only btn-skype btn-xs" title="Skype"><i class="fa fa-skype"></i></a>
										<!-- /Social -->

									</div>
								</section>
							</div><!-- /COL 1 -->

							<!-- COL 2 -->
							<div class="col-md-8 col-lg-6">

								<div class="tabs white nomargin-top">
									<ul class="nav nav-tabs tabs-primary">
										<li class="active">
											<a href="#consultar" data-toggle="tab"><i class="fa fa-address-card-o" aria-hidden="true"></i>Ver</a>
										</li>
										<li>
											<a href="#editar" data-toggle="tab"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
										</li>
										<li>
											<a href="#eliminar" data-toggle="tab"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>
										</li>										
									</ul>

									<div class="tab-content">

										<!-- Overview -->

										<!-- Consultar -->
										<div id="consultar" class="tab-pane active">

											<div class="form-horizontal">
												<h4>Datos Personales</h4>
												<fieldset>
													<div class="form-group">
														<label class="col-md-3 control-label" for="">Usuario</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ $usuario->name }}">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="">Cédula</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ $usuario->str_cedula }}">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="">Nombre</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ ucfirst($usuario->str_nombre) }}">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="">Apellido</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ ucfirst($usuario->str_apellido) }}">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="">Género</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ $usuario->str_genero }}">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="">Departamento</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ $usuario->str_departamento }}">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="">Teléfono</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ $usuario->str_telefono }}">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="">Correo Electrónico</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ $usuario->email }}">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="">Rol</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ $usuario->str_rol }}">
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="">Estatus</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ $usuario->str_estatus }}">
														</div>
													</div>

												</fieldset>

											</div>

										</div>										

										<!-- Editar -->
										<div id="editar" class="tab-pane">

											{!! Form::open(['route' => 'editarCuenta', 'id' => 'demo-form', '', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal validate', 'data-success' => 'Se han editado los datos personales con éxito','data-toastr-position' => 'top-right', 'onsubmit' => 'location.reload()']) !!} 												
												<h4>Datos Personales</h4>

												{!! Form::input('hidden', 'id', $usuario->id, ['id' => 'id', 'class'=> 'form-control required','maxlength'=> '10', 'readonly' ]) !!}  

												<fieldset>
													<div class="form-group">
														<label class="col-md-3 control-label" for="name">Usuario</label>
														<div class="col-md-8">
															{!! Form::input('text', 'name', $usuario->name, ['id' => 'name', 'class'=> 'form-control required','maxlength'=> '10']) !!}  
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="str_cedula">Cédula</label>
														<div class="col-md-8">
															{!! Form::input('text', 'str_cedula', $usuario->str_cedula, ['id' => 'str_cedula', 'class'=> 'form-control masked required','maxlength'=> '8','data-format' => '99999999', 'data-placeholder' => 'X', 'placeholder' => 'Ej.:05888777']) !!}
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="str_nombre">Nombre</label>
														<div class="col-md-8">
															{!! Form::input('text', 'str_nombre', ucfirst($usuario->str_nombre), ['id' => 'str_nombre', 'class'=> 'form-control required','maxlength'=> '10']) !!} 
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="str_apellido">Apellido</label>
														<div class="col-md-8">
															{!! Form::input('text', 'str_apellido', ucfirst($usuario->str_apellido), ['id' => 'str_apellido', 'class'=> 'form-control required','maxlength'=> '10']) !!} 
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="name">Género</label>
														<div class="col-md-8">
															<select name="str_genero" class="form-control pointer required">
																<option value="">--- Seleccione ---</option>

																@foreach ($generos as $value)
																				
																<option value="{{$value}}" <?php if ($value == $usuario->str_genero) {?> selected <?php }?> >{{$value}}</option>

																@endforeach

															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="str_departamento">Departamento</label>
														<div class="col-md-8">
															<select name="str_departamento" class="form-control pointer required">
																<option value="">--- Seleccione ---</option>

																@foreach ($gerencias as $value)
																				
																<option value="{{$value}}" <?php if ($value == $usuario->str_departamento) {?> selected <?php }?> >{{$value}}</option>

																@endforeach

															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="str_telefono">Teléfono</label>
														<div class="col-md-8">
															{!! Form::input('text', 'str_telefono', $usuario->str_telefono, ['id' => 'str_telefono', 'class'=> 'form-control masked required','maxlength'=> '18','data-format' => '(9999) 999-9999', 'data-placeholder' => '0', 'placeholder' => 'Ej.: (0414) 555-4433']) !!}
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="email">Correo Electrónico</label>
														<div class="col-md-8">
															{!! Form::input('email', 'email', $usuario->email, ['id' => 'email', 'class'=> 'form-control required','maxlength'=> '30']) !!} 
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="str_rol">Rol</label>
														<div class="col-md-8">
															<select name="str_rol" class="form-control pointer required">
																<option value="">--- Seleccione ---</option>

																@foreach ($roles as $value)
																				
																<option value="{{$value}}" <?php if ($value == $usuario->str_rol) {?> selected <?php }?> >{{$value}}</option>

																@endforeach

															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="str_rol">Estatus</label>
														<div class="col-md-8">
															<select name="str_estatus" class="form-control pointer required">
																<option value="">--- Seleccione ---</option>

																@foreach ($estatus as $value)
																				
																<option value="{{$value}}" <?php if ($value == $usuario->str_estatus) {?> selected <?php }?> >{{$value}}</option>

																@endforeach

															</select>
														</div>
													</div>																												
												</fieldset>

												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														{!! Form::submit('MODIFICAR DATOS PERSONALES', ['class' => 'btn btn-3d btn-teal btn-xlg btn-block margin-top-30']) !!}
													</div>
												</div>												

												{!! Form::close() !!}

												<hr />
												{!! Form::open(['route' => 'editarImagen', 'id' => 'imagen-form', '', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal validate', 'data-success' => 'Se ha cambiado la imágen de perfil con éxito','data-toastr-position' => 'top-right', 'onsubmit' => 'location.reload()']) !!} 
												<h4>Imágen de Perfil</h4>
												{!! Form::input('hidden', 'id', $usuario->id, ['id' => 'id', 'class'=> 'form-control required','maxlength'=> '10', 'readonly' ]) !!}  
												<fieldset>

													<div class="form-group">
														<div class="sky-form">
															<label>
																<small class="text-muted">(Opcional)</small>
															</label>

															{!! Form::file('blb_img',['id' => 'blb_img','data-btn-text' =>'Buscar Foto', 'class' => 'custom-file-upload required']) !!}

															<small class="text-muted block">Tamaño máximo: 1Mb (jpg/png)</small>
														
														</div>
													</div>


												</fieldset>

												<div class="row">
													<div class="col-md-9 col-md-offset-3">

														{!! Form::submit('CAMBIAR IMÁGEN', ['class' => 'btn btn-3d btn-teal btn-xlg btn-block margin-top-30']) !!}
														
													</div>
												</div>

												{!! Form::close() !!}												

												<hr />

												{!! Form::open(['route' => 'recuperar', 'id' => 'clave-form', '', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal validate', 'data-success' => 'Se ha enviado la nueva clave al usuario con éxito','data-toastr-position' => 'top-right', 'onsubmit' => 'location.reload();']) !!} 	
												<h4>Reenviar Clave</h4>
												{!! Form::input('hidden', 'id', $usuario->id, ['id' => 'id', 'class'=> 'form-control required','maxlength'=> '10', 'readonly' ]) !!}  
												<fieldset class="mb-xl">
													<div class="form-group">
														<label class="col-md-3 control-label" for="profileNewPassword">Correo Electrónico</label>
														<div class="col-md-8">
															{!! Form::input('email', 'email', $usuario->email, ['id' => 'email', 'class'=> 'form-control required','maxlength'=> '30', 'readonly']) !!} 
														</div>
													</div>
												</fieldset>

												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														{!! Form::submit('REENVIAR CLAVE', ['class' => 'btn btn-3d btn-teal btn-xlg btn-block margin-top-30']) !!}
													</div>
												</div>

												{!! Form::close() !!}

										</div>

										<div id="eliminar" class="tab-pane">

												{!! Form::open(['route' => 'eliminarImagen', 'id' => 'clave-form', '', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal validate', 'data-success' => 'Se ha eliminado la imágen con éxito','data-toastr-position' => 'top-right', 'onsubmit' => 'location.reload();']) !!} 	
												<h4>Imágen de Perfil</h4>
												{!! Form::input('hidden', 'id', $usuario->id, ['id' => 'id', 'class'=> 'form-control required','maxlength'=> '10', 'readonly' ]) !!}  


												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														{!! Form::submit('ELIMINAR IMÁGEN', ['class' => 'btn btn-3d btn-teal btn-xlg btn-block margin-top-30']) !!}
													</div>
												</div>

												{!! Form::close() !!}

											<hr class="invisible half-margins" />

												{!! Form::open(['route' => 'eliminarCuenta', 'id' => 'clave-form', '', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal ', 'data-success' => 'Se ha eliminado con éxito a la persona','data-toastr-position' => 'top-right', 'onsubmit' => '']) !!} 	
												<h4>Eliminar Cuenta</h4>
												{!! Form::input('hidden', 'id', $usuario->id, ['id' => 'id', 'class'=> 'form-control required','maxlength'=> '10', 'readonly' ]) !!}  


												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														{!! Form::submit('ELIMINAR CUENTA', ['class' => 'btn btn-3d btn-teal btn-xlg btn-block margin-top-30']) !!}
													</div>
												</div>

												{!! Form::close() !!}											


										</div>

									</div>
								</div>

							</div><!-- /COL 2 -->

							<!-- COL 3 -->
							<div class="col-md-12 col-lg-3">

								<!-- projects -->
								<section class="panel panel-default">
									<header class="panel-heading">
										<h2 class="panel-title elipsis">
											<i class="fa fa-rss"></i> Projects
										</h2>
									</header>

									<div class="panel-body noradius padding-10">

										<ul class="bullet-list list-unstyled">
											<li class="red">
												<h3>Epona HTML5 Template</h3>
												<span class="text-gray size-12">Lorem ipsum dolor sit amet, consectetuer adipiscing </span>
											</li>
											<li class="green">
												<h3>Atropos Template</h3>
												<span class="text-gray size-12">Lorem ipsum dolor sit amet, consectetuer adipiscing </span>
											</li>
											<li class="blue">
												<h3>isisone Template</h3>
												<span class="text-gray size-12">Lorem ipsum dolor sit amet, consectetuer adipiscing </span>
											</li>
											<li class="orange">
												<h3>Deusone Template</h3>
												<span class="text-gray size-12">Lorem ipsum dolor sit amet, consectetuer adipiscing </span>
											</li>
										</ul>

									</div>
									
								</section>
								<!-- /projects -->



							</div><!-- /COL 3 -->

						</div>

					</div>

				</div>
			</section>
			<!-- /MIDDLE -->

@endsection