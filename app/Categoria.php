<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_categorias_post';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['lng_idpost', 'str_categoria', 'bol_eliminado'];


}