{!! Form::open(['route' => 'editarMu3', 'id' => 'imagen-form', '', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal validate', 'data-success' => 'Se ha cambiado la imágen de perfil con éxito','data-toastr-position' => 'top-right', 'onsubmit' => 'location.reload()']) !!} 

{!! Form::input('hidden', 'id', $post->idpost, ['id' => 'id', 'class'=> 'form-control required','maxlength'=> '10', 'readonly' ]) !!}  
<fieldset>

{!! Form::input('hidden', 'str_tipo', $post->str_tipo, ['id' => 'str_tipo', 'class'=> 'form-control required','maxlength'=> '10', 'readonly' ]) !!}  

<div class="form-group">
	<label class="col-md-3 control-label" for="name"><i class="fa fa-video-camera" aria-hidden="true"></i> Link de Video</label>
	<div class="col-md-8">

		<select class="form-control required" onchange="showfield(this.options[this.selectedIndex].value)"> 
			<option value="">Seleccione</option> 
			<option value="youtube">YouTube</option>
			<option value="vimeo">Vimeo</option>
		</select>

		<span class="tooltip tooltip-top-right">seleccione el tipo de video</span>
	</div>
</div>


<div id="div1"></div>











		






</fieldset>

<div class="row">
	<div class="col-md-12">

		{!! Form::submit('CAMBIAR MULTIMEDIA', ['class' => 'btn btn-3d btn-teal btn-xlg btn-block margin-top-30']) !!}
		
	</div>
</div>

{!! Form::close() !!}