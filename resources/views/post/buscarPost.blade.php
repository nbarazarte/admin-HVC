@extends('app')

@section('content')

@include('menu')


<div id="pagina"></div>

			<!-- 
				MIDDLE 
			-->
			<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1>Buscar Posts de iLernus</h1>
					<ol class="breadcrumb">
					 <li><a href="{{ route('home')}}">Dashboard</a></li>
					  <li class="active">Buscar Posts de iLernus</li>
					</ol>


					
				</header>
				<!-- /page title -->


				<div id="content" class="padding-20">


					<!-- 
						PANEL CLASSES:
							panel-default
							panel-danger
							panel-warning
							panel-info
							panel-success

						INFO: 	panel collapse - stored on user localStorage (handled by app.js _panels() function).
								All pannels should have an unique ID or the panel collapse status will not be stored!
					-->
					<div id="panel-1" class="panel panel-default">
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>LISTADO DE posts DE ILERNUS</strong> <!-- panel title -->
							</span>

							<!-- right options -->
							<ul class="options pull-right list-inline">
								<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Minimizar" data-placement="bottom"></a></li>
								<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Pantalla Completa" data-placement="bottom"><i class="fa fa-expand"></i></a></li>

							</ul>
							<!-- /right options -->

						</div>

						<!-- panel content -->
						<div class="panel-body">

							<table class="table table-striped table-bordered table-hover" id="datatable_sample">
								<thead>
									<tr>
										<th>Ver</th>
										<th>Imágen</th>
										<th>Título</th>
										<th>Tipo</th>
										<th>Autor</th>
										<th>Fecha</th>
										<th>Estatus</th>
										<th>Usuario</th>
									</tr>
								</thead>

								<tbody>

									@foreach ($posts as $post)

										<tr class="odd gradeX">

												<td>

													<a href="{{ route('verPost',[$post->idpost]) }}" type="button" class="btn btn-warning">
														
														<i class="fa fa-search" aria-hidden="true"></i>

													</a>

												</td>

												<td>

													  @if (( $post->str_tipo == 'imagen') || ($post->str_tipo == 'carrusel-imagen' ))
													  	<center>
														  	<figure class="margin-bottom-10"><!-- image -->
													  			<img src="data:image/jpeg;base64,{{ $post->blb_img1 }}" alt="" title="" height="34">
													  		</figure>
													  	</center>					  	
													  @elseif ($post->str_tipo == 'audio')
													  	<center>
														  	<figure class="margin-bottom-10"><!-- image -->
													  			<i class="fa fa-soundcloud" aria-hidden="true"></i>
													  		</figure>
													  	</center>
													  @elseif ($post->str_tipo == 'video')
														<div class="margin-bottom-20">
															<div class="embed-responsive embed-responsive-16by9">
																{!! html_entity_decode($post->str_video) !!}
															</div>
														</div>	
													  @elseif ($post->str_tipo == 'simple')
													  	<center>
														  	<figure class="margin-bottom-10"><!-- image -->
													  			<i class="fa fa-newspaper-o" aria-hidden="true"></i>
													  		</figure>
													  	</center>
													  @endif






												</td>												

												<td>
													 	{{ str_replace("-"," ",$post->str_titulo) }}
												</td>

												<td>

														{{ ucfirst($post->str_tipo) }}

												</td>

												<td>

														<div class="row">
															<div class="col-md-4">
															  	<center>
																  	<figure class="margin-bottom-10"><!-- image -->
																		<img src="data:image/jpeg;base64,{{ $post->blb_img }}" alt="" title="" height="34">
																	</figure>
																</center>
															</div>
															<div class="col-md-8">{{ $post->autor }}</div>
														</div>


													 	
												</td>											

												<td>
													 	{{ $post->fecha }}
												</td>

												<td> 
														{{ $post->str_estatus }}
												</td>
												
												<td> 
														<div class="row">
															<div class="col-md-4">
															  	<center>
																  	<figure class="margin-bottom-10"><!-- image -->
																		<img src="data:image/jpeg;base64,{{ $post->img_usuario }}" alt="" title="" height="34">
																	</figure>
																</center>
															</div>
															<div class="col-md-8">{{ $post->usuario }}</div>
														</div>

												</td>

										</tr>

									@endforeach

								</tbody>
							</table>

						</div>
						<!-- /panel content -->

					</div>
					<!-- /PANEL -->

				</div>
			</section>
			<!-- /MIDDLE -->

@endsection