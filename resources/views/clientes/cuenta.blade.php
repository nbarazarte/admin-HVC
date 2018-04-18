@extends('app')

@section('content')

@include('menu')

		@foreach ($clientes as $cliente)

		@endforeach
			<!-- 
				MIDDLE 
			-->
			<section id="middle">

				<!-- page title -->
				<header id="page-header">
					<h1>Ver Cliente </h1>
					<ol class="breadcrumb">
						<li><a href="{{ route('home')}}">Dashboard</a></li>
						<li><a href="{{ route('buscarCuentaCli')}}">Buscar Cliente </a></li>
						<li class="active">Ver Cliente </li>
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

					<div class="panel-heading">
						<span class="title elipsis">
							<strong>Datos de Cliente</strong> <!-- panel title -->
						</span>

						<!-- right options -->
						<ul class="options pull-right list-inline">
							<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Minimizar" data-placement="bottom"></a></li>
							<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Pantalla Completa" data-placement="bottom"><i class="fa fa-expand"></i></a></li>

						</ul>
						<!-- /right options -->

					</div>					

					<div class="panel-body"> <!--<div class="page-profile">-->

						<div class="row">

							<!-- COL 1 -->
							<div class="col-md-4 col-lg-3">
								<section class="panel">
									<div class="panel-body noradius padding-10">

			                            @if ($cliente->blb_img != "")
			                            	<center>
				                            	<figure class="margin-bottom-10"><!-- image -->
				                            		<img src="data:image/jpeg;base64,{{ $cliente->blb_img }}" alt="{!! $cliente->name !!}" title="{!! $cliente->name !!}" height="130">
				                            	</figure>
			                            	</center>
										@else

										  @if ($cliente->str_genero == 'Masculino')
										  	<center>
											  	<figure class="margin-bottom-10"><!-- image -->
											  		<img src="{{ asset('smarty/assets/images/user_masculino.png') }}" alt="" height="130">
											  	</figure>
										  	</center>						  	
										  @elseif ($cliente->str_genero == 'Femenino')
										  	<center>
											  	<figure class="margin-bottom-10"><!-- image -->
											  		<img src="{{ asset('smarty/assets/images/user_femenino.png') }}" alt="" height="130">
											  	</figure>
										  	</center>
										  @endif

										 @endif

										<hr class="half-margins" />
										
										<!-- About -->
										<h3 class="text-black">
											
											<small class="text-gray size-14"> {{ ucfirst($cliente->name) }}</small>
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
														<label class="col-md-3 control-label" for="">Nombre</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ ucfirst($cliente->name) }}">
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="">Género</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ $cliente->str_genero }}">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="">Cédula/Pasaporte</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ $cliente->str_ci_pasaporte }}">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="">Correo Electrónico</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ $cliente->email }}">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="">N° de Teléfono</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ $cliente->str_telefono }}">
														</div>
													</div>																										
													<div class="form-group">
														<label class="col-md-3 control-label" for="">País</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ $cliente->str_paises }}">
														</div>
													</div>

												</fieldset>

											</div>

										</div>										

										<!-- Editar -->
										<div id="editar" class="tab-pane">

											{!! Form::open(['route' => 'editarCuentaCli', 'id' => 'demo-form', '', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal ', 'data-success' => 'Se han editado los datos personales con éxito','data-toastr-position' => 'top-right', 'onsubmit' => 'location.reload()']) !!} 												
												<h4>Datos Personales</h4>

												{!! Form::input('hidden', 'id', $cliente->id, ['id' => 'id', 'class'=> 'form-control required','maxlength'=> '10', 'readonly' ]) !!}  

												<fieldset>

													<div class="form-group">
														<label class="col-md-3 control-label" for="str_nombre">Nombre</label>
														<div class="col-md-8">
															{!! Form::input('text', 'name', ucfirst($cliente->name), ['id' => 'name', 'class'=> 'form-control required','maxlength'=> '60']) !!} 
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="name">Género</label>
														<div class="col-md-8">
															<select name="str_genero" class="form-control pointer required">
																<option value="">--- Seleccione ---</option>

																@foreach ($generos as $value)
																				
																<option value="{{$value}}" <?php if ($value == $cliente->str_genero) {?> selected <?php }?> >{{$value}}</option>

																@endforeach

															</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="str_ci_pasaporte">Cédula/Pasaporte</label>
														<div class="col-md-8">
															{!! Form::input('text', 'str_ci_pasaporte', ucfirst($cliente->str_ci_pasaporte), ['id' => 'str_ci_pasaporte', 'class'=> 'form-control required','maxlength'=> '60']) !!} 
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="">Correo Electrónico</label>
														<div class="col-md-8">
															{!! Form::input('email', 'email', $cliente->email, ['id' => 'email', 'class'=> 'form-control required','maxlength'=> '60']) !!} 
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="">N° de Teléfono</label>
														<div class="col-md-8">
															{!! Form::input('text', 'str_telefono', $cliente->str_telefono, ['id' => 'str_telefono', 'class'=> 'form-control masked','maxlength'=> '18','data-format' => '(9999) 999-9999', 'data-placeholder' => '0', 'placeholder' => 'Ej.: (0414) 555-4433']) !!}
														</div>
													</div>	
													<div class="form-group">
														<label class="col-md-3 control-label" for="name">País</label>
														<div class="col-md-8">
															<select name="lng_idpais" class="form-control pointer required">
																<option value="">--- Seleccione ---</option>

																@foreach ($paises as $pais)
																				
																<option value="{{$pais->id}}" <?php if ($pais->id == $cliente->lng_idpais) {?> selected <?php }?> >{{$pais->str_paises}}</option>

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
												{!! Form::open(['route' => 'editarImagenCli', 'id' => 'imagen-form', '', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal validate', 'data-success' => 'Se ha cambiado la imágen de perfil con éxito','data-toastr-position' => 'top-right', 'onsubmit' => 'location.reload()']) !!} 
												<h4>Imágen de Perfil</h4>
												{!! Form::input('hidden', 'id', $cliente->id, ['id' => 'id', 'class'=> 'form-control required','maxlength'=> '10', 'readonly' ]) !!}  
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

										</div>

										<div id="eliminar" class="tab-pane">

												{!! Form::open(['route' => 'eliminarImagenCli', 'id' => 'clave-form', '', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal validate', 'data-success' => 'Se ha enviado la nueva clave al instructor con éxito','data-toastr-position' => 'top-right', 'onsubmit' => 'location.reload();']) !!} 	
												<h4>Imágen de Perfil</h4>
												{!! Form::input('hidden', 'id', $cliente->id, ['id' => 'id', 'class'=> 'form-control required','maxlength'=> '10', 'readonly' ]) !!}  


												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														{!! Form::submit('ELIMINAR IMÁGEN', ['class' => 'btn btn-3d btn-teal btn-xlg btn-block margin-top-30']) !!}
													</div>
												</div>

												{!! Form::close() !!}

											<hr class="invisible half-margins" />

												{!! Form::open(['route' => 'eliminarCuentaCli', 'id' => 'clave-form', '', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal ', 'data-success' => 'Se ha eliminado con éxito a la persona','data-toastr-position' => 'top-right', 'onsubmit' => '']) !!} 	
												<h4>Eliminar Cuenta</h4>
												{!! Form::input('hidden', 'id', $cliente->id, ['id' => 'id', 'class'=> 'form-control required','maxlength'=> '10', 'readonly' ]) !!}  


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



</div>
</div>
</div>

				<div id="content" class="padding-20">

					<div class="row">

						<div class="col-md-12">

							<div class="panel panel-default">

								<div class="panel-heading">
									<span class="title elipsis">
										<strong>Buscar Disponibilidad</strong> <!-- panel title -->
									</span>

									<!-- right options -->
									<ul class="options pull-right list-inline">
										<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Minimizar" data-placement="bottom"></a></li>
										<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Pantalla Completa" data-placement="bottom"><i class="fa fa-expand"></i></a></li>

									</ul>
									<!-- /right options -->

								</div>

								<div class="panel-body">

								{!! Form::open(['route' => 'buscarDisponibilidad', 'id' => 'demo-form', '', 'enctype'=>'multipart/form-data', 'class' => 'sky-form boxed ', 'data-success' => 'Se ha creado la reservación con éxito','data-toastr-position' => 'top-right', 'onsubmit' => 'diferencia()']) !!} 										

											<fieldset>
												
												<!-- required [php action request] -->
												<input type="hidden" name="action" value="contact_send" />

												<div class="row">
													<div class="form-group">

												        <div class='col-sm-6'>
														<label>Fecha de Entrada - Fecha de Salida*</label>

															<input type="text" name="entrada-salida" class="form-control rangepicker validate" value="{{ date('Y-m-d') }} - {{ date('Y-m-d') }}" data-format="yyyy-mm-dd" data-from="{{ date('YYYY-m-d') }}" data-to="{{ date('YYYY-m-d') }}" required>

															<input type="hidden" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">

												        </div>

														<div class='col-md-6 col-sm-6'>

															<label>Tipo de Habitación *</label>
															<label class="input margin-bottom-10">
															
																<select name="contact-habitacion" class="form-control pointer required" required>
																	<option value="">--- Seleccione ---</option>

																	@foreach ($habitaciones as $value)
																					
																	<option value="{{$value}}">{{$value}}</option>

																	@endforeach

																</select>

															</label>
															
													    </div>												        

													</div>
												</div>

												<div class="row">

													<div class="form-group">

														<div class="col-md-11 col-sm-11">

															<input type="hidden" id="cant-dias" name="cant-dias" value="">

															<input type="hidden" id="contact-llegada" name="contact-llegada" value="">
															<input type="hidden" id="contact-salida" name="contact-salida" value="">

															<input type="hidden" id="contact-name" name="contact-name" value="{{ $cliente->name }}">
															<input type="hidden" id="contact-email" name="contact-email" value="{{ $cliente->email }}">
															<input type="hidden" id="contact-phone" name="contact-phone" value="{{ $cliente->str_telefono }}">
															<input type="hidden" id="contact-id" name="contact-id" value="{{ $cliente->id }}">

														
															{!! Form::submit('BUSCAR DISPONIBILIDAD', ['class' => 'btn btn-3d btn-teal btn-xlg btn-block margin-top-30']) !!}																								
														</div>
													</div>
												</div>



											</fieldset>



										{!! Form::close() !!}

								</div>

							</div>
							<!-- /----- -->

						</div>


					</div>

				</div>

			<script>

	            function diferencia(){

	                var llegada = $("#daterangepicker_start").val();
	                var salida = $("#daterangepicker_end").val();
	                var date1 = new Date(llegada);
	                var date2 = new Date(salida);
	                var timeDiff = Math.abs(date2.getTime() - date1.getTime());
	                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 

	                if(diffDays == 0){

	                    var diffDays = 1;

	                }

	                $("#cant-dias").val(diffDays);

                $("#contact-llegada").val(llegada);
                $("#contact-salida").val(salida);	                

	            }

        	</script>

			</section>
			<!-- /MIDDLE -->

@endsection