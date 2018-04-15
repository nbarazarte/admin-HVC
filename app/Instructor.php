<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class Instructor extends Model
{

/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_instructores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['lng_idadmin', 'str_nombre', 'str_sexo', 'str_profesion', 'str_cv', 'blb_img', 'bol_eliminado'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['blb_img'];    
        
    public function setBlbimgAttribute($valor){
                
        if(!empty($valor)){          
            $this->attributes['blb_img'] = base64_encode(file_get_contents($valor));                                
        }    
    }    

}
