<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acompanantes extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_acompanante';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['lng_idreservacion', 'str_nombre', 'str_ci_pasaporte', 'lng_idpais', 'lng_idtipopersona', 'created_at', 'updated_at'];    

}
