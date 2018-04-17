<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class Reservaciones extends Model
{

/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_reservaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['str_estatus_pago','str_codigo','lng_idtipohab','lng_idpersona','str_email','str_nombre','str_telefono','dbl_precio','dbl_total_pagar','int_ninos','int_adultos','int_dias','str_mensaje','dmt_fecha_entrada','dmt_fecha_salida','bol_eliminado'];


}

