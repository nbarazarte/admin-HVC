{!! Form::open(['route' => 'editarMu4', 'id' => 'imagen-form', '', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal validate', 'data-success' => 'Se ha cambiado la imágen de perfil con éxito','data-toastr-position' => 'top-right', 'onsubmit' => 'location.reload()']) !!} 

{!! Form::input('hidden', 'id', $post->idpost, ['id' => 'id', 'class'=> 'form-control required','maxlength'=> '10', 'readonly' ]) !!}  
<fieldset>

{!! Form::input('hidden', 'str_tipo', $post->str_tipo, ['id' => 'str_tipo', 'class'=> 'form-control required','maxlength'=> '10', 'readonly' ]) !!}  

</fieldset>

<div class="row">
<div class="col-md-12">

{!! Form::submit('CAMBIAR MULTIMEDIA', ['class' => 'btn btn-3d btn-teal btn-xlg btn-block margin-top-30']) !!}

</div>
</div>

{!! Form::close() !!}	