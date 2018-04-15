@extends('app')

@section('content')

@include('menu')

			<!-- 
				MIDDLE 
			-->
			<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1>Crear Instructor iLernus</h1>
					<ol class="breadcrumb">
						<li><a href="{{ route('home')}}">Dashboard</a></li>
						<li class="active">Crear Instructor iLernus</li>
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
									<strong>Datos del Instructor</strong>
								</div>

								<div class="panel-body">

								{!! Form::open(['route' => 'registrarIns', 'id' => 'demo-form', '', 'enctype'=>'multipart/form-data', 'class' => 'sky-form boxed validate', 'data-success' => 'Se ha creado el Instructor con éxito','data-toastr-position' => 'top-right']) !!} 										

											<fieldset>
												
												<!-- required [php action request] -->
												<input type="hidden" name="action" value="contact_send" />



												<div class="row">
													<div class="form-group">


														<div class="col-md-6 col-sm-6">

															<label>Nombre y Apellido *</label>
	
															<label class="input">
																<i class="icon-append fa fa-user"></i>
																{!! Form::input('text', 'str_nombre', '', ['id' => 'str_nombre', 'class'=> 'form-control required','maxlength'=> '50']) !!}  
																<span class="tooltip tooltip-top-right">Ingrese el nombre del instructor</span>
															</label>
														</div>
														<div class="col-md-6 col-sm-6">
															<label>Sexo *</label>
															<label class="input margin-bottom-10">
															<i class="icon-append fa fa-venus-mars" aria-hidden="true"></i>

															<select name="str_sexo" class="form-control pointer required">
																<option value="">--- Seleccione ---</option>

																	@foreach ($generos as $value)
																				
																		<option value="{{ $value }}">{{$value}}</option>

																	@endforeach

															</select>
																<span class="tooltip tooltip-top-right">seleccione el género del instructor</span>
															</label>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="form-group">
														<div class="col-md-6 col-sm-6">

															<label>Profesión *</label>
	
															<label class="input">
																<i class="icon-append fa fa-pencil-square-o"></i>
																{!! Form::input('text', 'str_profesion', '', ['id' => 'str_profesion', 'class'=> 'form-control required','maxlength'=> '70']) !!}  
																<span class="tooltip tooltip-top-right">Ingrese la profesión del instructor</span>
															</label>
														</div>
														<div class="col-md-6 col-sm-6">
															<label>
																Imágen del Instructor
																<small class="text-muted">(Opcional)</small>
															</label>

															{!! Form::file('blb_img',['id' => 'blb_img','data-btn-text' =>'Buscar Foto', 'class' => 'custom-file-upload']) !!}

															<small class="text-muted block">Tamaño máximo: 1Mb (jpg/png)</small>	
														</div>
													</div>
												</div>

												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>
																Curriculo *
																<small class="text-muted">(Versión larga)</small>
															</label>

															<textarea name="str_cv" class="form-control required" rows="10"></textarea>

																											
														</div>
													</div>
												</div>

											</fieldset>

											<div class="row">
												<div class="col-md-12">

													{!! Form::submit('CREAR INSTRUCTOR', ['class' => 'btn btn-3d btn-teal btn-xlg btn-block margin-top-30']) !!}

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