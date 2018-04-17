@extends('app')

@section('content')

@include('menu')

	@foreach ($posts as $post)

	@endforeach

	@if($post->str_tipo == 'simple')

		<style type="text/css">

			#simple {display: inline;}
			#imagen {display: none;}
			#carrusel-imagen {display: none;}
			#audio {display: none;}
			#video {display: none;}

		</style>		

	@endif

	@if($post->str_tipo == 'imagen')

		<style type="text/css">

			#simple {display: none;}
			#imagen {display: inline;}
			#carrusel-imagen {display: none;}
			#audio {display: none;}
			#video {display: none;}

		</style>		

	@endif

	@if($post->str_tipo == 'carrusel-imagen')

		<style type="text/css">

			#simple {display: none;}
			#imagen {display: none;}
			#carrusel-imagen {display: inline;}
			#audio {display: none;}
			#video {display: none;}

		</style>		

	@endif

	@if($post->str_tipo == 'audio')

		<style type="text/css">

			#simple {display: none;}
			#imagen {display: none;}
			#carrusel-imagen {display: none;}
			#audio {display: inline;}
			#video {display: none;}

		</style>		

	@endif

	@if($post->str_tipo == 'video')

		<style type="text/css">

			#simple {display: none;}
			#imagen {display: none;}
			#carrusel-imagen {display: none;}
			#audio {display: none;}
			#video {display: inline;}

		</style>		

	@endif	




			<!-- 
				MIDDLE 
			-->
			<section id="middle">

				<!-- page title -->
				<header id="page-header">
					<h1>Ver Post de iLernus</h1>
					<ol class="breadcrumb">
						<li><a href="{{ route('home')}}">Dashboard</a></li>
						<li><a href="{{ route('buscarPost')}}">Buscar Post de iLernus</a></li>
						<li class="active">Ver Post de iLernus</li>
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


							<!-- COL 2 -->
							<div class="col-md-12">

								<div class="tabs white nomargin-top">
									<ul class="nav nav-tabs tabs-primary">
										<li class="active">
											<a href="#consultar" data-toggle="tab"><i class="fa fa-address-card-o" aria-hidden="true"></i>Ver</a>
										</li>
										<li>
											<a href="#editar" data-toggle="tab"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar Post</a>
										</li>

										<li>
											<a href="#editarEtiquetas" data-toggle="tab"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar Etiquetas</a>
										</li>

										<li>
											<a href="#editarMultimedia" data-toggle="tab"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar Multimedia</a>
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
												<h4>Datos del Post</h4>

													<section class="panel">

														<div class="panel-body noradius padding-10">

															  @if ($post->str_tipo == 'simple')
															  	<center>
																  	<figure class="margin-bottom-10"><!-- image -->
																  		<i class="fa fa-newspaper-o" aria-hidden="true"></i>
																  	</figure>
															  	</center>						  	
															  @elseif ($post->str_tipo == 'audio')
															  	<center>
																  	{!! html_entity_decode($post->str_audio) !!} 
															  	</center>
															  @elseif ($post->str_tipo == 'video')
															  	<center>
																	{!! html_entity_decode($post->str_video) !!}
															  	</center>
															  @elseif ($post->str_tipo == 'carrusel-imagen')
															  	<center>
																  	<figure class="margin-bottom-10"><!-- image -->

																  		<div class="row">
																  			<div class="col-md-4">
																  				<img class="img-responsive" src="data:image/jpeg;base64,{{ $post->blb_img1 }}" alt="" title="" width="410">
																  			</div>
																  			<div class="col-md-4">
																  				<img class="img-responsive" src="data:image/jpeg;base64,{{ $post->blb_img2 }}" alt="" title="" width="410">
																  			</div>

																  			@if(!empty($post->blb_img3))

																  			<div class="col-md-4">
																  				<img class="img-responsive" src="data:image/jpeg;base64,{{ $post->blb_img3 }}" alt="" title="" width="410">
																  			</div>

																  			@endif
																  		</div>	

																  	</figure>
															  	</center>
															  @elseif ($post->str_tipo == 'imagen')
															  	<center>
																  	<figure class="margin-bottom-10"><!-- image -->
																  		
																  		<img src="data:image/jpeg;base64,{{ $post->blb_img1 }}" alt="" title="" width="410">
																  	</figure>
															  	</center>
															  @endif

														
															
															

														</div>
													</section>

												<fieldset>

													<div class="form-group">
														<label class="col-md-3 control-label" for="">Estatus</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ str_replace("-"," ",$post->str_estatus)}}">
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="">Título</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ str_replace("-"," ",$post->str_titulo)}}">
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="">Tipo</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ $post->str_tipo }}">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label" for="">Autor</label>
														<div class="col-md-8">
															<input type="text" readonly="yes" class="form-control" id="" value="{{ $post->autor }}">
														</div>
													</div>


													<div class="form-group">
														<label class="col-md-3 control-label" for="">Post (resumen)</label>
														<div class="col-md-8">
															
															{!! html_entity_decode($post->str_post_resumen) !!}

														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="">Post</label>
														<div class="col-md-8">
															{!! html_entity_decode($post->str_post) !!}
														</div>
													</div>	

												</fieldset>

											</div>

										</div>										

										<!-- Editar -->
										<div id="editar" class="tab-pane">

											{!! Form::open(['route' => 'editarPost', 'id' => 'demo-form', '', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal ', 'data-success' => 'Se han editado los datos personales con éxito','data-toastr-position' => 'top-right', 'onsubmit' => 'location.reload()']) !!} 												
												<h4>Datos del Post</h4>

												{!! Form::input('hidden', 'id', $post->idpost, ['id' => 'id', 'class'=> 'form-control required','maxlength'=> '10', 'readonly' ]) !!}  

												<fieldset>

													<div class="form-group">
														<label class="col-md-3 control-label" for="str_profesion">Estatus</label>
														<div class="col-md-8">
															<select name="str_estatus" class="form-control pointer required">
																<option value="">--- Seleccione ---</option>

																@foreach ($tipoEstatus as $value)
																				
																<option value="{{$value}}" <?php if ($value == $post->str_estatus) {?> selected <?php }?> >{{$value}}</option>

																@endforeach

															</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="str_nombre">Título</label>
														<div class="col-md-8">
															{!! Form::input('text', 'str_titulo', str_replace("-"," ",$post->str_titulo), ['id' => 'str_nombre', 'class'=> 'form-control required','maxlength'=> '255']) !!} 
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="str_profesion">Autor</label>
														<div class="col-md-8">
															<select name="lng_idautor" class="form-control pointer required">
																<option value="">--- Seleccione ---</option>

																@foreach ($autores as $clave => $value)
																				
																<option value="{{$clave}}" <?php if ($value == $post->autor) {?> selected <?php }?> >{{$value}}</option>

																@endforeach

															</select>
														</div>
													</div>


													<div class="form-group">
														<label class="col-md-3 control-label" for="">Post (resumen)</label>
														<div class="col-md-8">
															
															
															<textarea name="str_post_resumen" class="summernote form-control required" data-height="200" data-lang="en-US">
																{!! html_entity_decode($post->str_post_resumen) !!}
															</textarea>

														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="">Post</label>
														<div class="col-md-8">
															<textarea name="str_post" class="summernote form-control required" data-height="200" data-lang="en-US">
																{!! html_entity_decode($post->str_post) !!}
															</textarea>
														</div>
													</div>	
																														
												</fieldset>

												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														{!! Form::submit('MODIFICAR POST', ['class' => 'btn btn-3d btn-teal btn-xlg btn-block margin-top-30']) !!}
													</div>
												</div>												

												{!! Form::close() !!}

										</div>

										<div id="editarEtiquetas" class="tab-pane">

											{!! Form::open(['route' => 'editarEtiquetas', 'id' => 'demo-form', '', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal ', 'data-success' => 'Se han editado las etiquetas con éxito','data-toastr-position' => 'top-right', 'onsubmit' => 'location.reload()']) !!} 												
												

												{!! Form::input('hidden', 'id', $post->idpost, ['id' => 'id', 'class'=> 'form-control required','maxlength'=> '10', 'readonly' ]) !!}  										

											<div class="row">

												<fieldset>

													<div class="col-md-1 col-sm-1"></div>

													<div class="col-md-10 col-sm-10">
														<label>Etiquetas</label>
														
														<input class="pull-right" type="checkbox" name="categoria" value="" onclick="todasEtiquetas()">
														<label class="pull-right"> Seleccionar todas &nbsp;</label>

														<div class="row">

														<?php
															$x = 0;
														?>
														@foreach($todasEtiquetas as $clave => $valor)
										
															<div class="col-md-4">

															<?php $flag = 'false'; ?>   
															@foreach($etiquetas as $tag)

																@if($valor == $tag)

																	{!! Form::checkbox("str_categoria[]", $valor,'checked') !!}
													                                                            
													                <?php $flag = 'true'; ?>

			                                                	@endif

			                                                @endforeach

 															@if($flag == 'false')
								                                                            
								                            	{!! Form::checkbox("str_categoria[]", $valor) !!}
	           		                                                                          		           		                                                                          	
	                                                        @endif  

			                                                    {!! Form::label('str_categoria', $valor) !!}           

															</div>

															<?php $x++; ?>

														@endforeach

														</div>

													</div>

													<div class="col-md-1 col-sm-1"></div>

												</fieldset>

											</div>

												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														{!! Form::submit('MODIFICAR ETIQUETAS', ['class' => 'btn btn-3d btn-teal btn-xlg btn-block margin-top-30']) !!}
													</div>
												</div>	

											{!! Form::close() !!}

										</div>

										<div id="editarMultimedia" class="tab-pane">

												<fieldset>
													<div class="form-group">
														<label class="col-md-3 control-label" for="name">Tipo</label>
														<div class="col-md-8">
															<select name="tipo" class="form-control pointer required" onchange="showfieldTipo(this.options[this.selectedIndex].value)">
																
																@foreach ($tipopost as $value)
																				
																<option value="{{$value}}" <?php if ($value == $post->str_tipo) {?> selected <?php }?> >{{$value}}</option>

																@endforeach
															</select>
														</div>
													</div>
												</fieldset>	

												<hr>

												<div id="simple">
													
													@include('post.multimediaSimple')

												</div>

												<div id="imagen">
													
													@include('post.multimediaImagen')

												</div>

												<div id="carrusel-imagen">
													
													@include('post.multimediaCarruselImagen')
	
												</div>

												<div id="audio">

													@include('post.multimediaAudio')

												</div>

												<div id="video">
													
													@include('post.multimediaVideo')

												</div>

										</div>

										<div id="eliminar" class="tab-pane">


												{!! Form::open(['route' => 'eliminarPost', 'id' => 'clave-form', '', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal ', 'data-success' => 'Se ha eliminado el post con éxito','data-toastr-position' => 'top-right', 'onsubmit' => '']) !!} 	
												<h4>Eliminar Post</h4>
												{!! Form::input('hidden', 'id', $post->idpost, ['id' => 'id', 'class'=> 'form-control required','maxlength'=> '10', 'readonly' ]) !!}  


												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														{!! Form::submit('ELIMINAR POST', ['class' => 'btn btn-3d btn-teal btn-xlg btn-block margin-top-30']) !!}
													</div>
												</div>

												{!! Form::close() !!}											


										</div>

									</div>
								</div>

							</div><!-- /COL 2 -->



						</div>

					</div>

				</div>
			</section>
			<!-- /MIDDLE -->

<script type="text/javascript">

	function todasEtiquetas() {

		var categoria = document.getElementsByName("categoria");

		if(categoria[0].checked == true){

		    var x = document.getElementsByName("str_categoria");
		    var i;
		    for (i = 0; i < x.length; i++) {
		        if (x[i].type == "checkbox") {
		            x[i].checked = true;
		        }
		    }

		}else{

		    var x = document.getElementsByName("str_categoria");
		    var i;
		    for (i = 0; i < x.length; i++) {
		        if (x[i].type == "checkbox") {
		            x[i].checked = false;
		        }
		    }

		}
	}

	function showfieldTipo(name){

	    var x = document.getElementsByName("str_tipo");
	    var i;
	    for (i = 0; i < x.length; i++) {
	        x[i].value = name;
	    }

		if(name=='simple'){
	  	
	  			document.getElementById('simple').style.display='inline';
	  		document.getElementById('imagen').style.display='none';
	  		document.getElementById('carrusel-imagen').style.display='none';
	  		document.getElementById('audio').style.display='none';
	  		document.getElementById('video').style.display='none';
	  		document.getElementById('defecto').style.display='none';

	  	}else if (name=='imagen'){ 

	  		document.getElementById('simple').style.display='none';
	  			document.getElementById('imagen').style.display='inline';
	  		document.getElementById('carrusel-imagen').style.display='none';
	  		document.getElementById('audio').style.display='none';
	  		document.getElementById('video').style.display='none';
	  		document.getElementById('defecto').style.display='none';		

		}else if (name=='carrusel-imagen'){ 

	  		document.getElementById('simple').style.display='none';
	  		document.getElementById('imagen').style.display='none';
	  			document.getElementById('carrusel-imagen').style.display='inline';
	  		document.getElementById('audio').style.display='none';
	  		document.getElementById('video').style.display='none';
	  		document.getElementById('defecto').style.display='none';  		

		}else if (name=='video'){ 

	  		document.getElementById('simple').style.display='none';
	  		document.getElementById('imagen').style.display='none';
	  		document.getElementById('carrusel-imagen').style.display='none';
	  		document.getElementById('audio').style.display='none';
	  			document.getElementById('video').style.display='inline';
	  		document.getElementById('defecto').style.display='none';

		}else if (name=='audio'){ 

	  		document.getElementById('simple').style.display='none';
	  		document.getElementById('imagen').style.display='none';
	  		document.getElementById('carrusel-imagen').style.display='none';
	  			document.getElementById('audio').style.display='inline';
	  		document.getElementById('video').style.display='none';
	  		document.getElementById('defecto').style.display='none';

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