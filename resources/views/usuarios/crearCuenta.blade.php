@extends('app')

@section('content')

@include('menu')

			<!-- 
				MIDDLE 
			-->
			<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1>Crear Cuenta</h1>
					<ol class="breadcrumb">
						<li><a href="{{ route('home')}}">Dashboard</a></li>
						<li class="active">Crear Cuenta</li>
					</ol>
				</header>
				<!-- /page title -->


				<div id="content" class="padding-20">

					<div class="row">

						<div class="col-md-12">

							<!-- ------ -->
							<div class="panel panel-default">

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

								<div class="panel-heading panel-heading-transparent">
									<strong>Datos del Usuario</strong>
								</div>

								<div class="panel-body">

								{!! Form::open(['route' => 'registrar', 'id' => 'demo-form', '', 'enctype'=>'multipart/form-data', 'class' => 'sky-form boxed validate', 'data-success' => 'Se ha creado la cuenta con éxito','data-toastr-position' => 'top-right']) !!} 										

											<fieldset>
												
												<!-- required [php action request] -->
												<input type="hidden" name="action" value="contact_send" />


												<div class="row">
													<div class="form-group">
														<div class="col-md-6 col-sm-6">

															<label>Usuario *</label>

															<label class="input">
																<i class="icon-append fa fa-user-secret"></i>
																{!! Form::input('text', 'name', '', ['id' => 'name', 'class'=> 'form-control required','maxlength'=> '10']) !!}  
																<span class="tooltip tooltip-top-right">Ingrese un nick de usuario</span>
															</label>

														</div>
														<div class="col-md-6 col-sm-6">
															<label>Sexo *</label>
															<label class="input margin-bottom-10">
															<i class="icon-append fa fa-venus-mars" aria-hidden="true"></i>
															<select name="str_genero" class="form-control pointer required">
																<option value="">--- Seleccione ---</option>

																	@foreach ($generos as $value)
																				
																		<option value="{{$value}}">{{$value}}</option>

																	@endforeach

															</select>
																<span class="tooltip tooltip-top-right">seleccione el género del usuario</span>
															</label>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="form-group">
														<div class="col-md-6 col-sm-6">
															<label>Nombre *</label>
	
															<label class="input">
																<i class="icon-append fa fa-user"></i>
																{!! Form::input('text', 'str_nombre', '', ['id' => 'str_nombre', 'class'=> 'form-control required','maxlength'=> '10']) !!}  
																<span class="tooltip tooltip-top-right">Ingrese el nombre del usuario</span>
															</label>

														</div>
														<div class="col-md-6 col-sm-6">
															<label>Apellido *</label>
															<label class="input">
																<i class="icon-append fa fa-user"></i>
																{!! Form::input('text', 'str_apellido', '', ['id' => 'str_apellido', 'class'=> 'form-control required','maxlength'=> '10']) !!} 
																<span class="tooltip tooltip-top-right">Ingrese el apellido del usuario</span>
															</label>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="form-group">
														<div class="col-md-6 col-sm-6">
															<label>Cédula *</label>
															<label class="input">
																<i class="icon-append fa fa-id-card-o""></i>
																{!! Form::input('text', 'str_cedula', '', ['id' => 'str_cedula', 'class'=> 'form-control masked required','maxlength'=> '8','data-format' => '99999999', 'data-placeholder' => 'X', 'placeholder' => 'Ej.:05888777']) !!}
																<span class="tooltip tooltip-top-right">Ingrese la cédula del usuario</span>
															</label>
														</div>
														<div class="col-md-6 col-sm-6">
															<label>Teléfono *</label>
															<label class="input">
																<i class="icon-append fa fa-volume-control-phone" aria-hidden="true"></i>
																{!! Form::input('text', 'str_telefono', '', ['id' => 'str_telefono', 'class'=> 'form-control masked','maxlength'=> '18','data-format' => '(9999) 999-9999', 'data-placeholder' => '0', 'placeholder' => 'Ej.: (0414) 555-4433']) !!}																
																<span class="tooltip tooltip-top-right">Ingrese la cédula del usuario</span>
															</label>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="form-group">
														<div class="col-md-6 col-sm-6">
															<label>Gerencia *</label>

															<select name="str_departamento" class="form-control pointer required">
																<option value="">--- Seleccione ---</option>

																	@foreach ($gerencias as $value)
																				
																		<option value="{{$value}}">{{$value}}</option>

																	@endforeach

															</select>

														</div>
	
														<div class="col-md-6 col-sm-6">

															<label>Correo Electrónico *</label>															
															<label class="input">
																<i class="icon-append fa fa-envelope"></i>
																{!! Form::input('email', 'email', '', ['id' => 'email', 'class'=> 'form-control required','maxlength'=> '30']) !!}  																
																<span class="tooltip tooltip-top-right">Ingrese su dirección de correo electrónico</span>
															</label>

														</div>
													</div>
												</div>												

												<div class="row">
													<div class="form-group">
														<div class="col-md-6 col-sm-6">

															<label>Rol *</label>
															<label class="input margin-bottom-10">
															<i class="icon-append fa fa-eye" aria-hidden="true"></i>
															<select name="str_rol" class="form-control pointer required">
																<option value="">--- Seleccione ---</option>

																	@foreach ($roles as $value)
																				
																		<option value="{{$value}}">{{$value}}</option>

																	@endforeach

															</select>																
																<b class="tooltip tooltip-bottom-right">Rol</b>
															</label>

														</div>
														<div class="col-md-6 col-sm-6">
															<label>Clave *</label>															
															<label class="input">
																<i class="icon-append fa fa-key" aria-hidden="true"></i>
																{!! Form::input('password', 'password', '', ['id' => 'password', 'class'=> 'form-control required','maxlength'=> '8']) !!}  
																<span class="tooltip tooltip-top-right">Ingrese la clave de usuario</span>
															</label>

														</div>
													</div>
												</div>


												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>
																Imágen de Perfil
																<small class="text-muted">(Opcional)</small>
															</label>

															{!! Form::file('blb_img',['id' => 'blb_img','data-btn-text' =>'Buscar Foto', 'class' => 'custom-file-upload']) !!}

															<small class="text-muted block">Tamaño máximo: 1Mb (jpg/png)</small>												
														</div>
													</div>
												</div>

											</fieldset>

											<div class="row">
												<div class="col-md-12">

													{!! Form::submit('CREAR CUENTA', ['class' => 'btn btn-3d btn-teal btn-xlg btn-block margin-top-30']) !!}

												</div>
											</div>

										{!! Form::close() !!}

								</div>

							</div>
							<!-- /----- -->

						</div>


					</div>

				</div>
			</section>
			<!-- /MIDDLE -->




@endsection