<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','str_nombre','str_apellido','str_genero','str_cedula','str_telefono','blb_img','str_departamento','password','email','bol_eliminado','str_rol','str_estatus'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token','blb_img'];    
    
    public function setPasswordAttribute($valor){
        
        if(!empty($valor)){
            $this->attributes['password'] = \Hash::make($valor);
        }
    }
        
    public function setBlbimgAttribute($valor){
                
        if(!empty($valor)){          
            $this->attributes['blb_img'] = base64_encode(file_get_contents($valor));                                
        }    
    }    
}
