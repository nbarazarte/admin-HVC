@extends('app')

@section('content')

@include('menu')

			<!-- 
				MIDDLE 
			-->
			<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1>Crear Post de Ilernus</h1>
					<ol class="breadcrumb">
						<li><a href="{{ route('home')}}">Dashboard</a></li>
						<li class="active">Crear Post de Ilernus</li>
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
										<strong>Datos del Post</strong> <!-- panel title -->
									</span>

									<!-- right options -->
									<ul class="options pull-right list-inline">
										<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Minimizar" data-placement="bottom"></a></li>
										<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Pantalla Completa" data-placement="bottom"><i class="fa fa-expand"></i></a></li>

									</ul>
									<!-- /right options -->

								</div>

								<div class="panel-body">

								{!! Form::open(['route' => 'registrarPost', 'id' => 'demo-form', '', 'enctype'=>'multipart/form-data', 'class' => 'sky-form boxed ', 'data-success' => 'Se ha creado el Post con éxito','data-toastr-position' => 'top-right']) !!} 										

											<fieldset>
												
												<!-- required [php action request] -->
												<input type="hidden" name="action" value="contact_send" />



												<div class="row">
													<div class="form-group">



														<div class="col-md-6 col-sm-6">
															<label>Tipo de Post *</label>
															<label class="input margin-bottom-10">
															

											 					<select id="str_tipo" name="str_tipo" class="form-control required" onchange="showfieldTipo(this.options[this.selectedIndex].value)">
											 						<option value="">Seleccione</option>
											 						<option value="simple">Post Simple</option>
											 						<option value="imagen">Post con sólo una imágen</option>
											 						<option value="carrusel-imagen">Post con carrusel de imágenes</option>
											 						<option value="video">Post con video</option>
											 						<option value="audio">Post con audio</option>
											 					</select>

																
															</label>
														</div>

														<div class="col-md-6 col-sm-6">
															<label>Etiquetas</label>
															
															<input class="pull-right" type="checkbox" name="categoria" value="" onclick="todasEtiquetas()">
															<label class="pull-right"> Seleccionar todas &nbsp;</label>

															<div class="row">

															@foreach($etiquetas as $clave => $valor)
											
																<div class="col-md-4">

			                                                        

																	<input class="" type="checkbox" name="str_categoria[]" value="{{ $valor }}">			                                                        
			                                                        {!! Form::label('str_categoria', $valor) !!}           

																</div>

															@endforeach

															</div>

														</div>

													</div>
												</div>

												<div class="row">
													<div class="form-group">

														<div class="col-md-6 col-sm-6">
															<label>Autor *</label>
															<label class="input margin-bottom-10">
															<i class="icon-append fa fa-user" aria-hidden="true"></i>

											 					{!! Form::select('lng_idautor', 
											                                        (['' => 'Seleccione'] + $autores), 
											                                        null, 
											                                        ['class' => 'form-control pointer required', 'id' =>'lng_idautor', 'onchange' => '']
											                                    ) 
											                    !!} 

																<span class="tooltip tooltip-top-right">seleccione el autor del Post</span>
															</label>
														</div>

														<div class="col-md-6 col-sm-6">

															<label>Título del Post *</label>
	
															<label class="input">
																<i class="icon-append fa fa-edit"></i>
																{!! Form::input('text', 'str_titulo', '', ['id' => 'str_titulo', 'class'=> 'form-control required','maxlength'=> '100']) !!}  
																<span class="tooltip tooltip-top-right">Ingrese el título del Post</span>
															</label>
														</div>

													</div>
												</div>

												<div id="div2"></div>

												<div class="row">

													<div class="form-group">

														<div class="col-md-12 col-sm-12">
															<label>
																Resumen del Post *
																<small class="text-muted"></small>
															</label>

															<textarea name="str_post_resumen" class="summernote form-control required" data-height="200" data-lang="en-US"></textarea>										
														</div>

													</div>
												</div>

												<div class="row">

													<div class="form-group">

														<div class="col-md-12 col-sm-12">
															<label>
																Post *
																<small class="text-muted"></small>
															</label>

															<textarea name="str_post" class="summernote form-control required" data-height="200" data-lang="en-US"></textarea>										
														</div>
													</div>
												</div>




												<div class="row">

													<div class="form-group">

														<div class="col-md-11 col-sm-11">
														
															{!! Form::submit('CREAR POST', ['class' => 'btn btn-3d btn-teal btn-xlg btn-block margin-top-30']) !!}																								
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


