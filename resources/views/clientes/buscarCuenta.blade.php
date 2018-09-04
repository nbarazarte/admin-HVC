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
					<h1>Buscar Clientes</h1>
					<ol class="breadcrumb">
					 <li><a href="{{ route('home')}}">Dashboard</a></li>
					  <li class="active">Buscar Clientes</li>
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
								<strong>LISTADO DE CLIENTES DE HVC</strong> <!-- panel title -->
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
								<thead style="text-align: center;">
									<tr>
										<th>Ver</th>
										<th>Imágen</th>
										<th>Nombre</th>
										<th>Género</th>
										<th>Cédula/Pasaporte</th>
										<th>País</th>
									</tr>
								</thead>

								<tbody style="font-size: 12px; text-align: center; cursor: pointer;">

									@foreach ($clientes as $cliente)

										<tr class="odd gradeX">

												<td>

													<a href="{{ route('cuentaCli',[$cliente->id]) }}" type="button" class="btn btn-warning">
														
														<i class="fa fa-search" aria-hidden="true"></i>

													</a>

												</td>

												<td>

						                            @if ($cliente->blb_img != "")
													  	<center>
														  	<figure class="margin-bottom-10"><!-- image -->						                            
						                            			<img src="data:image/jpeg;base64,{{ $cliente->blb_img }}" alt="{!! $cliente->name !!}" title="{!! $cliente->name !!}" height="34">
						                            		</figure>
						                            	</center>
													@else

													  @if ($cliente->str_genero == 'Masculino')
													  	<center>
														  	<figure class="margin-bottom-10"><!-- image -->
														  		<img src="{{ asset('smarty/assets/images/user_masculino.png') }}" alt="" height="34">
														  	</figure>
													  	</center>						  	
													  @elseif ($cliente->str_genero == 'Femenino')
													  	<center>
														  	<figure class="margin-bottom-10"><!-- image -->
														  		<img src="{{ asset('smarty/assets/images/user_femenino.png') }}" alt="" height="34">
														  	</figure>
													  	</center>
													  @endif

													 @endif	

												</td>												

												<td>
													 	{{ ucwords(strtolower($cliente->name)) }} 
												</td>
												<td>

														{{ $cliente->str_genero }}

												</td>
												<td>
													 	{{ $cliente->str_ci_pasaporte }}
												</td>											

												<td>
												  	<center>
													  	<figure class="margin-bottom-10"><!-- image -->						                            
					                            			<img src="data:image/jpeg;base64,{{ $cliente->bandera }}" alt="{!! $cliente->str_paises !!}" title="{!! $cliente->str_paises !!}" height="24" width="40">
					                            		</figure>
					                            	</center>	

													{{ $cliente->str_paises }}
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