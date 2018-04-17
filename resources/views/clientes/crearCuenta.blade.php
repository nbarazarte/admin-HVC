@extends('app')

@section('content')

@include('menu')

			<!-- 
				MIDDLE 
			-->
			<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1>Crear Cliente </h1>
					<ol class="breadcrumb">
						<li><a href="{{ route('home')}}">Dashboard</a></li>
						<li class="active">Crear Cliente </li>
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
									<strong>Datos del Cliente</strong>
								</div>

								<div class="panel-body">

									{!! Form::open(['route' => 'registrarCli', 'id' => 'demo-form', '', 'enctype'=>'multipart/form-data', 'class' => 'sky-form boxed ', 'data-success' => 'Se ha creado el Cliente con éxito','data-toastr-position' => 'top-right']) !!} 										
<!-- validate -->
											<fieldset>
												
												<!-- required [php action request] -->
												<input type="hidden" name="action" value="contact_send" />



												<div class="row">
													<div class="form-group">


														<div class="col-md-6 col-sm-6">

															<label>Nombre y Apellido *</label>
	
															<label class="input">
																<i class="icon-append fa fa-user"></i>
																{!! Form::input('text', 'name', '', ['id' => 'name', 'class'=> 'form-control required','maxlength'=> '50']) !!}  
																<span class="tooltip tooltip-top-right">Ingrese el nombre del cliente</span>
															</label>
														</div>
														<div class="col-md-6 col-sm-6">
															<label>Sexo *</label>
															<label class="input margin-bottom-10">
															<i class="icon-append fa fa-venus-mars" aria-hidden="true"></i>

															<select name="str_genero" class="form-control pointer required">
																<option value="">--- Seleccione ---</option>

																	@foreach ($generos as $value)
																				
																		<option value="{{ $value }}">{{$value}}</option>

																	@endforeach

															</select>
																<span class="tooltip tooltip-top-right">seleccione el género del cliente</span>
															</label>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="form-group">
														<div class="col-md-6 col-sm-6">

															<label>Cédula/Pasaporte *</label>
	
															<label class="input">
																<i class="icon-append fa fa-pencil-square-o"></i>
																{!! Form::input('text', 'str_ci_pasaporte', '', ['id' => 'str_ci_pasaporte', 'class'=> 'form-control required','maxlength'=> '70']) !!}  
																<span class="tooltip tooltip-top-right">Ingrese el documento de identificación del cliente</span>
															</label>
														</div>
														<div class="col-md-6 col-sm-6">
															<label>
																Imágen del Cliente
																<small class="text-muted">(Opcional)</small>
															</label>

															{!! Form::file('blb_img',['id' => 'blb_img','data-btn-text' =>'Buscar Foto', 'class' => 'custom-file-upload']) !!}

															<small class="text-muted block">Tamaño máximo: 1Mb (jpg/png)</small>	
														</div>
													</div>
												</div>


												<div class="row">
													<div class="form-group">
														<div class="col-md-6 col-sm-6">

															<label>País *</label>
	
															<select name="str_pais" class="form-control pointer required">
																<option value="">--- Seleccione ---</option>

																	@foreach ($paises as $value)
																				
																		<option value="{{ $value }}">{{$value}}</option>

																	@endforeach

															</select>
																<span class="tooltip tooltip-top-right">seleccione el país del cliente</span>
														</div>
														<div class="col-md-6 col-sm-6">

															<label>Correo Electrónico *</label>
	
															<label class="input">
																<i class="icon-append fa fa-user"></i>
																{!! Form::input('email', 'email', '', ['id' => 'email', 'class'=> 'form-control required','maxlength'=> '50']) !!}  
																<span class="tooltip tooltip-top-right">Ingrese el correo electrónico del cliente</span>
															</label>
														</div>
													</div>
												</div>	

												<div class="row">
													<div class="col-md-6 col-sm-6">
														<label>Teléfono *</label>
														<label class="input">
															<i class="icon-append fa fa-volume-control-phone" aria-hidden="true"></i>
															{!! Form::input('text', 'str_telefono', '', ['id' => 'str_telefono', 'class'=> 'form-control masked','maxlength'=> '18','data-format' => '(9999) 999-9999', 'data-placeholder' => '0', 'placeholder' => 'Ej.: (0414) 555-4433']) !!}																
															<span class="tooltip tooltip-top-right">Ingrese el número de teléfono del cliente</span>
														</label>
													</div>
												</div>																							


											</fieldset>

											<div class="row">
												<div class="col-md-12">

													{!! Form::submit('CREAR CLIENTE', ['class' => 'btn btn-3d btn-teal btn-xlg btn-block margin-top-30']) !!}

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