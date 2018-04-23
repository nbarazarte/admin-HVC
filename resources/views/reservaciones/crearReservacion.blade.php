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
						<li><a href="{{ route('buscarCuentaCli')}}">Buscar Clientes</a></li>
						<li><a href="{{ route('cuentaCli', $persona['contact-id'] )}}">Ver Cliente</a></li>
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
														<div class='col-md-12 col-sm-12'>
															<label><strong>Datos de los Acompañantes</strong></label>

															<table id="myTable" class="table">
															  	<tr>
																	<th>Nombre y Apellido</th>
																	<th>Cédula y Pasaporte</th>
																	<th>Adulto/Niño</th>
																	<th>País</th>
																	<th><input class="btn btn-info" type="button" onclick="myFunction()" name="" value="Añadir"></th>
																</tr>

															</table>
														</div>													
													</div>
												</div>




<script>
    function myFunction() {
        var table = document.getElementById("myTable");
        var row = table.insertRow(1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);

        cell1.innerHTML = '<input style="width: 100%; height: 45px; padding: 0 15px; letter-spacing: .4px; border: none; box-sizing: border-box;font: 14px/20px \'Open Sans\', sans-serif; z-index: 2;position: relative;"  name="acompanante-name[]" type="text" placeholder="Name and Surname" id="acompanante-name" value="" required/>';
        cell2.innerHTML = '<input style="width: 100%; height: 45px; padding: 0 15px; letter-spacing: .4px; border: none; box-sizing: border-box;font: 14px/20px \'Open Sans\', sans-serif; z-index: 2;position: relative;" name="acompanante-cedula[]" type="number" placeholder="ID/Passport" id="acompanante-cedula" value="" required/>';
        cell3.innerHTML= '<select name="acompanante-tipo[]" id="acompanante-tipo" style="width: 100%; height: 45px; padding: 0 15px; letter-spacing: .4px; border: none; box-sizing: border-box;font: 14px/20px \'Open Sans\', sans-serif; z-index: 2;position: relative;" required><option value="">Seleccione</option>@foreach ($tipoPersona as $tipo)<option value="{{ $tipo->id}}">{{ $tipo->str_descripcion }}</option>@endforeach</select>';
        cell4.innerHTML= '<select name="acompanante-pais[]" id="acompanante-pais" style="width: 100%; height: 45px; padding: 0 15px; letter-spacing: .4px; border: none; box-sizing: border-box;font: 14px/20px \'Open Sans\', sans-serif; z-index: 2;position: relative;" required><option value="">Seleccione</option> @foreach ($paises as $pais)<option value="{{ $pais->id}}">{{ $pais->str_paises}}</option>@endforeach</select>';
        cell5.innerHTML= '<input class="btn btn-danger" type="button" onclick="deleteRow(this)" name="" value="Quitar">';                        
    }

    function deleteRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("myTable").deleteRow(i);
    }                   
</script> 



					
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

@endsection