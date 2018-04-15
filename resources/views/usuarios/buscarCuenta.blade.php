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
					<h1>Buscar Cuenta</h1>
					<ol class="breadcrumb">
					 <li><a href="{{ route('home')}}">Dashboard</a></li>
					  <li class="active">Buscar Cuenta</li>
					</ol>


					
				</header>
				<!-- /page title -->


				<div id="content" class="padding-20">

                    			@if(Session::has('message'))
					            
									<div class="alert alert-success" role="alert">
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									  <span aria-hidden="true">&times;</span></button>
									  <strong><i class="fa fa-check"></i></strong> {{Session::get('message')}}
									</div> 							
							
								@endif
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
								<strong>LISTADO DE USUARIOS</strong> <!-- panel title -->
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
										<th>Cédula</th>
										<th>Usuario</th>
										<th>Nombre</th>
										<th>Género</th>
										<th>Departamento</th>
										<th>Teléfono</th>
										<th>Correo</th>
										<th>Rol</th>
										<th>Activo</th>
									</tr>
								</thead>

								<tbody>

									@foreach ($usuarios as $usuario)

										<tr class="odd gradeX"  <?php if (Auth::user()->name == $usuario->name) {?> style="background-color: #DBDBDB" <?php }?>  >

												<td>

													<a href="{{ route('cuenta',[$usuario->id]) }}" type="button" class="btn btn-warning">
														
														<i class="fa fa-search" aria-hidden="true"></i>

													</a>

												</td>


												<td>
													
						                            @if ($usuario->blb_img != "")
													  	<center>
														  	<figure class="margin-bottom-10"><!-- image -->						                            
						                            			<img src="data:image/jpeg;base64,{{ $usuario->blb_img }}" alt="{!! $usuario->str_nombre !!}" title="{!! $usuario->str_nombre !!}" height="34">
						                            		</figure>
						                            	</center>	
													@else

													  @if ($usuario->str_sexo == 'Masculino')
													  	<img src="{{ asset('smarty/assets/images/user_masculino.png') }}" alt="" height="34">						  	
													  @elseif ($usuario->str_sexo == 'Femenino')
													  	<img src="{{ asset('smarty/assets/images/user_femenino.png') }}" alt="" height="34">
													  @endif

													@endif

												</td>
												
												<td>
														{{ $usuario->str_cedula }}
												</td>
												<td>
														{{ $usuario->name }}
												</td>
												<td>
													 	{{ ucfirst($usuario->str_nombre) }} {{ ucfirst($usuario->str_apellido) }}
												</td>
												<td class="center">

														{{ $usuario->str_genero }}
												</td>
												<td>
													 	{{ $usuario->str_departamento }}
												</td>
												<td>
													 	{{ $usuario->str_telefono }}
												</td>
												<td>
													 	{{ $usuario->email }}
												</td>												
												<td>

													@if ($usuario->str_rol == "Administrador")

												 		<span class="label label-primary">{{ $usuario->str_rol }}</span>

													@else

														<span class="label label-info">{{ $usuario->str_rol }}</span>

													@endif

												</td>																																	
												<td class="center">

													@if (Auth::user()->str_rol == "Administrador")


														@if (Auth::user()->id == $usuario->id)

															<span class="label label-success">{{ $usuario->str_estatus }}</span>

														@else
												
															<label class="switch switch-success switch-round">


																@if ($usuario->str_estatus == "Activo")
																	
																	<input type="checkbox" checked="" onchange="estatusUsuario({{ $usuario->id }},'Inactivo')">
																	
																@elseif ($usuario->str_estatus == "Inactivo")
																	
																	<input type="checkbox" onchange="estatusUsuario({{ $usuario->id }},'Activo')">
																	
																@endif

																<span class="switch-label" data-on="SI" data-off="NO"></span>


															</label>

															<div id="estatus"></div>

														@endif

													@else


														@if ($usuario->str_estatus == "Inactivo")

													 		<span class="label label-danger">{{ $usuario->str_estatus }}</span>

														@else

															<span class="label label-success">{{ $usuario->str_estatus }}</span>

														@endif
													


													@endif

													

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