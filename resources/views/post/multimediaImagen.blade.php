{!! Form::open(['route' => 'editarMu', 'id' => 'imagen-form', '', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal validate', 'data-success' => 'Se ha cambiado la imágen de perfil con éxito','data-toastr-position' => 'top-right', 'onsubmit' => 'location.reload()']) !!} 
												
{!! Form::input('hidden', 'id', $post->idpost, ['id' => 'id', 'class'=> 'form-control required','maxlength'=> '10', 'readonly' ]) !!}  
<fieldset>

{!! Form::input('hidden', 'str_tipo', $post->str_tipo, ['id' => 'str_tipo', 'class'=> 'form-control ','maxlength'=> '10', 'readonly' ]) !!}  

	<div class="form-group">
		<label class="col-md-3 control-label" for="name">Imágen</label>
		<div class="col-md-8">

			{!! Form::file('blb_img1',['id' => 'blb_img1','data-btn-text' =>'Buscar Foto', 'class' => 'custom-file-upload required']) !!}
			<small class="text-muted block">Tamaño máximo: 1Mb (jpg/png)</small>

		</div>
	</div>

</fieldset>

<div class="row">
	<div class="col-md-9 col-md-offset-3">

		{!! Form::submit('CAMBIAR MULTIMEDIA', ['class' => 'btn btn-3d btn-teal btn-xlg btn-block margin-top-30']) !!}
		
	</div>
</div>

{!! Form::close() !!}