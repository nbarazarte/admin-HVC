@extends('app')

@section('content')


    @foreach ($datos[0][0]['datos'] as $dato => $valor)

    <?php

        $persona[$dato] = $valor; 
        
    ?>    

    @endforeach

@include('menu')

			<!-- 
				MIDDLE 
			-->
			<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1>Crear Reservación</h1>
					<ol class="breadcrumb">
						<li><a href="{{ route('home')}}">Dashboard</a></li>
						<li class="active">Crear Reservación</li>
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
										<strong>Datos de la Reservación</strong> <!-- panel title -->
									</span>

									<!-- right options -->
									<ul class="options pull-right list-inline">
										<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Minimizar" data-placement="bottom"></a></li>
										<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Pantalla Completa" data-placement="bottom"><i class="fa fa-expand"></i></a></li>

									</ul>
									<!-- /right options -->

								</div>

								<div class="panel-body">

								{!! Form::open(['route' => 'registrarReservacion', 'id' => 'demo-form', '', 'enctype'=>'multipart/form-data', 'class' => 'sky-form boxed ', 'data-success' => 'Se ha creado la reservación con éxito','data-toastr-position' => 'top-right']) !!} 										

											<fieldset>
												
												<!-- required [php action request] -->
												<input type="hidden" name="action" value="contact_send" />


												<div class="row">
													<div class="form-group">

												        <div class='col-sm-6'>

															<label><strong>Tipo de Habitación:</strong></label>

															{{ $persona['contact-habitacion'] }}

															<input type="hidden" name="contact-idHabitacion" value="{{ $persona['contact-idHabitacion'] }}	">

												        </div>

														<div class='col-md-6 col-sm-6'>

															<label><strong>Precio:</strong></label>

															{{ $persona['contact-precioHabitacion'] }}

															<input type="hidden" name="contact-precioHabitacion" value="{{ $persona['contact-precioHabitacion'] }}	">

													    </div>												        

													</div>
												</div>

												<div class="row">

													<div class="form-group">

												        <div class='col-sm-6'>
														<label><strong>Fecha de Entrada:</strong></label>

					                                        <?php

					                                            $date1 = new DateTime($persona['contact-llegada']);
					                                            $fecha_entrada = $date1->format('d-m-Y');
					                                        ?>

					                                        {{ $fecha_entrada }}

															<input type="hidden" name="contact-llegada" value="{{ $persona['contact-llegada'] }}	">					                       
												        </div>

														<div class='col-md-6 col-sm-6'>

															<label><strong>Fecha de Salida:</strong></label>

					                                        <?php

					                                            $date2 = new DateTime($persona['contact-salida']);
					                                            $fecha_salida = $date2->format('d-m-Y');
					                                        ?>

					                                        {{ $fecha_salida }}	

					                                        <input type="hidden" name="contact-salida" value="{{ $persona['contact-salida'] }}	">	

													    </div>												        

													</div>
												</div>

												<div class="row">
													<div class="form-group">

												        <div class='col-sm-6'>

															<label><strong>Cantidad de días:</strong></label>

															{{ $persona['cant-dias'] }}

															<input type="hidden" name="cant-dias" value="{{ $persona['cant-dias'] }}">

												        </div>

														<div class='col-md-6 col-sm-6'>

															<label><strong>Total a pagar:</strong></label>

															{{ $persona['contact-totalPagar'] }}

															<input type="hidden" name="contact-totalPagar" value="{{ $persona['contact-totalPagar'] }}">															
													    </div>												        

													</div>
												</div>

												<div class="row">
													<div class="form-group">

												        <div class='col-sm-6'>

															<label><strong>Nombre:</strong></label>

															{{ $persona['contact-name'] }}

															<input type="hidden" name="contact-name" value="{{ $persona['contact-name'] }}">	

															<input type="hidden" name="contact-id" value="{{ $persona['contact-id'] }}">	

												        </div>

														<div class='col-md-6 col-sm-6'>
															
															<label><strong>Correo Electrónico:</strong></label>

															{{ $persona['contact-email'] }}

															<input type="hidden" name="contact-email" value="{{ $persona['contact-email'] }}">																

													    </div>												        

													</div>
												</div>

												<div class="row">
													<div class="form-group">

												        <div class='col-sm-6'>

															<label><strong>Teléfono:</strong></label>

															{{ $persona['contact-phone'] }}

															<input type="hidden" name="contact-phone" value="{{ $persona['contact-phone'] }}">	

												        </div>

														<div class='col-md-6 col-sm-6'>
																													

													    </div>												        

													</div>
												</div>																									

												<div class="row">
													<div class="form-group">

													    <div class='col-md-6 col-sm-6'>

															<label><strong>Cantidad de Adultos *</strong></label>
															<label class="input margin-bottom-10">
															
																<select name="contact-adultos" class="form-control pointer required">
																	<option value="">Seleccione</option>
																	<option value="1 Adulto">1 Adulto</option>
																	<option value="2 Adulto">2 Adultos</option>
																	<option value="3 Adulto">3 Adultos</option>
																	<option value="4 Adulto">4 Adultos</option>
																	<option value="5 Adulto">5 Adultos</option>
																	<option value="6 Adulto">6 Adultos</option>
																	<option value="7 Adulto">7 Adultos</option>
																	<option value="8 Adulto">8 Adultos</option>
																	<option value="9 Adulto">9 Adultos</option>

																</select>

															</label>

													    </div>

													    <div class='col-md-6 col-sm-6'>

															<label><strong>Cantidad de Niños *</strong></label>
															<label class="input margin-bottom-10">
															
																<select name="contact-ninos" class="form-control pointer required">			<option value="">Seleccione</option>			
																	<option value="0 Niños">0 Niños</option>
																	<option value="1 Niño">1 Niño</option>
																	<option value="2 Niños">2 Niños</option>

																</select>

															</label>

													    </div>													    

													</div>
												</div>

												<div class="row">

													<div class="form-group">

														<div class="col-md-12 col-sm-12">

															<div class="form-group">
															  <label for="comment"><strong>Mensaje:</strong></label>
															  <textarea name="contact-message" class="form-control" rows="5" id="str_mensaje"></textarea>
															</div>															
																																			
														</div>
													</div>
												</div>

												<div class="row">

													<div class="form-group">

														<div class="col-md-11 col-sm-11">
														
															{!! Form::submit('CREAR RESERVACIÓN', ['class' => 'btn btn-3d btn-teal btn-xlg btn-block margin-top-30']) !!}																								
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
			</section>
			<!-- /MIDDLE -->

<script type="text/javascript">

	function todasEtiquetas() {

		var categoria = document.getElementsByName("categoria");

		if(categoria[0].checked == true){

		    var x = document.getElementsByName("str_categoria[]");
		    var i;
		    for (i = 0; i < x.length; i++) {
		        if (x[i].type == "checkbox") {
		            x[i].checked = true;
		        }
		    }

		}else{

		    var x = document.getElementsByName("str_categoria[]");
		    var i;
		    for (i = 0; i < x.length; i++) {
		        if (x[i].type == "checkbox") {
		            x[i].checked = false;
		        }
		    }

		}
	}

	function showfieldTipo(name){

		if(name=='simple'){
	  	
	  		document.getElementById('div2').innerHTML='';

	  	}else if (name=='imagen'){ 

	  		document.getElementById('div2').innerHTML='<div class="row"><div class="form-group"><div class="col-md-12 col-sm-12"><label>Imágen del Post<small class="text-muted">(Opcional)</small></label><input type="file" id="blb_img1" name="blb_img1" data-btn-text="Buscar Foto" class="custom-file-upload required"><small class="text-muted block">Tamaño máximo: 1Mb (jpg/png) Medidas 1200 x 500</small></div></div></div>';

		}else if (name=='carrusel-imagen'){ 

	  		document.getElementById('div2').innerHTML='<div class="row"><div class="form-group"><div class="col-md-4 col-sm-4"><label>Imágen del Post N° 1<small class="text-muted">(Opcional)</small></label><input type="file" id="blb_img1" name="blb_img1" data-btn-text="Buscar Foto" class="custom-file-upload required"><small class="text-muted block">Tamaño máximo: 1Mb (jpg/png) Medidas 1200 x 500</small></div><div class="col-md-4 col-sm-4"><label>Imágen del Post N° 2<small class="text-muted">(Opcional)</small></label><input type="file" id="blb_img2" name="blb_img2" data-btn-text="Buscar Foto" class="custom-file-upload required"><small class="text-muted block">Tamaño máximo: 1Mb (jpg/png) Medidas 1200 x 500</small></div><div class="col-md-4 col-sm-4"><label>Imágen del Post N° 3<small class="text-muted">(Opcional)</small></label><input type="file" id="blb_img3" name="blb_img3" data-btn-text="Buscar Foto" class="custom-file-upload"><small class="text-muted block">Tamaño máximo: 1Mb (jpg/png) Medidas 1200 x 500</small></div></div></div>';

		}else if (name=='video'){ 

	  		document.getElementById('div2').innerHTML='<div class="row"><div class="form-group"><div class="col-md-12 col-sm-12"><label><i class="fa fa-video-camera" aria-hidden="true"></i> Link de Video</label><label class="input margin-bottom-10"> <select class="form-control required" onchange="showfield(this.options[this.selectedIndex].value)"> <option value="">Seleccione</option> <option value="youtube">YouTube</option> <option value="vimeo">Vimeo</option> </select> <div id="div1"></div><span class="tooltip tooltip-top-right">seleccione el tipo de video</span></label></div></div></div>';

		}else if (name=='audio'){ 

	  		document.getElementById('div2').innerHTML='<div class="row"><div class="form-group"><div class="col-md-12 col-sm-12"><label>Link de SoundCloud</label><label class="input"><i class="icon-append fa fa-soundcloud" aria-hidden="true"></i><textarea id="str_audio" name="str_audio" class="form-control required" placeholder="Ejemplo: <iframe width=100% height=450 scrolling=no frameborder=no src=https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/323193251&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true></iframe>" rows="4" cols="50"></textarea><span class="tooltip tooltip-top-right">Ingrese el link de SoundCloud</span></label></div></div></div>';

		}

	}


	function showfield(name){

		if(name=='youtube'){
	  	
	  		document.getElementById('div1').innerHTML='<textarea id="str_video" name="str_video" class="form-control required" placeholder="Ejemplo: <iframe class=embed-responsive-item width=560 height=315 src=http://www.youtube.com/embed/W7Las-MJnJo></iframe>" rows="4" cols="350"></textarea><span class="tooltip tooltip-top-right">Ingrese el link de video</span>';

	  	}else if (name=='vimeo'){ 

	  		document.getElementById('div1').innerHTML='<textarea id="str_video" name="str_video" class="form-control required" placeholder="Ejemplo: <iframe class=embed-responsive-item src=http://player.vimeo.com/video/8408210 width=800 height=450></iframe>" rows="4" cols="350"></textarea><span class="tooltip tooltip-top-right">Ingrese el link de video</span>';

		}

	}
</script>


@endsection


