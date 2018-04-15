<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Personas;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use PHPMailer;
use DB;
use Validator;
use Illuminate\Support\Facades\Auth;

class EquipoIlernusController extends Controller
{
   
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //

    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function crearCuenta()
    {

        $generos = DB::table('cat_datos_maestros')
        ->where('str_tipo', 'genero')
        ->Where(function ($query) {
            $query->where('bol_eliminado', '=', 0);
        })
        ->lists('str_descripcion');

        //dd($gerencias);die(); 

        return \View::make('directores.crearCuenta', compact('generos'));
    }

  /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCrearCuenta(Request $request)
    {

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
        $this->create($request->all());

        //return redirect($this->redirectPath()); 
        Session::flash('message','¡El director ha sido creado con éxito!');
        return Redirect::to('/Crear-Equipo-iLernus'); 
        
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
                
            'str_nombre' => 'required|max:255',
            'str_sexo' => 'required|max:255',
            'str_tipo' => 'required|max:255',
            'str_cargo' => 'required|max:255',
            'str_cv_corto' => 'required',            
            'str_cv' => 'required',  
       

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        
        $orden = DB::table('tbl_equipoilernus')
                ->where('str_tipo', $data['str_tipo'])
                ->max('str_orden');
            
        //dd($orden);die();

        $str_orden = $orden + 1;

        if(!empty($data['blb_img'])){

            return Personas::create([

                'lng_idadmin' =>  Auth::user()->id,
                'str_nombre' => $data['str_nombre'],
                'str_sexo' => $data['str_sexo'],
                'str_cargo' => $data['str_cargo'],
                'str_cv_corto' => $data['str_cv_corto'],
                'str_cv' => $data['str_cv'],
                'str_tipo' => $data['str_tipo'],
                'blb_img' => $data['blb_img'],
                //'blb_img' => base64_encode(file_get_contents($data['blb_img'])),
                'str_orden' => $str_orden,

            ]);

        }else{

            return Personas::create([

                'lng_idadmin' =>  Auth::user()->id,
                'str_nombre' => $data['str_nombre'],
                'str_sexo' => $data['str_sexo'],
                'str_cargo' => $data['str_cargo'],
                'str_cv_corto' => $data['str_cv_corto'],
                'str_cv' => $data['str_cv'],
                'str_tipo' => $data['str_tipo'],
                'str_orden' => $str_orden,

            ]);            
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function buscarCuenta()
    {

        $directores = DB::table('tbl_equipoilernus as ei')
                ->join('tbl_admin as admin', 'ei.lng_idadmin', '=', 'admin.id')
                ->where('ei.bol_eliminado', '=' ,0)
                ->select('ei.id','ei.str_nombre','ei.str_sexo','ei.str_tipo','ei.str_cargo', 'ei.str_orden','admin.name as usuario','ei.blb_img')
                ->orderBy('ei.str_orden','asc')
                ->get();

                //dd($directores);die();
        
        return \View::make('directores.buscarCuenta', compact('directores'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function estatusUsuario($id, $estatus)
    {
    
        $estatusUsuario = DB::update('update tbl_admin set str_estatus = "'.$estatus.'", lng_idadmin = '.Auth::user()->id.' where id = '.$id.' and bol_eliminado = 0');
         
        return $estatusUsuario;
    }

    public function verCuenta($id)
    {
    
        $personas = DB::table('tbl_equipoilernus')
        ->where('id', $id)
        ->Where(function ($query) {
            $query->where('bol_eliminado', '=', 0);
        })
        ->get();

        $generos = DB::table('cat_datos_maestros')
        ->where('str_tipo', 'genero')
        ->Where(function ($query) {
            $query->where('bol_eliminado', '=', 0);
        })
        ->lists('str_descripcion');

        $tipopersona = DB::table('cat_datos_maestros')
        ->where('str_tipo', 'equipoilernus')
        ->Where(function ($query) {
            $query->where('bol_eliminado', '=', 0);
        })
        ->lists('str_descripcion');        

        $roles = DB::table('cat_datos_maestros')
        ->where('str_tipo', 'rol')
        ->Where(function ($query) {
            $query->where('bol_eliminado', '=', 0);
        })
        ->lists('str_descripcion');

        $gerencias = DB::table('cat_datos_maestros')
        ->where('str_tipo', 'gerencia')
        ->Where(function ($query) {
            $query->where('bol_eliminado', '=', 0);
        })
        ->lists('str_descripcion');

        $estatus = DB::table('cat_datos_maestros')
        ->where('str_tipo', 'estatus')
        ->Where(function ($query) {
            $query->where('bol_eliminado', '=', 0);
        })
        ->lists('str_descripcion');                

        //dd($generos);die();
        return \View::make('directores.cuenta', compact('personas','generos', 'roles','gerencias','estatus','tipopersona'));
    }

    public function editarCuenta(Request $request)
    {
        
        /*$validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }*/


     
        $persona = Personas::find($request->id);
        $persona->fill($request->all());
        $persona->save();

        Session::flash('message','¡Se han editado los datos personales con éxito!');
        return Redirect::to('/Ver-Equipo-iLernus-'.$request->id); 

    }

    public function editarImagen(Request $request)
    {
        
        $persona = Personas::find($request->id);
        $persona->fill($request->all());
        $persona->save();

        Session::flash('message','¡Se ha cambiado la imágen de perfil con éxito!');
        return Redirect::to('/Ver-Equipo-iLernus-'.$request->id); 

    }

    public function eliminarImagen(Request $request)
    {
        
        $imagen = DB::update('update tbl_equipoilernus set blb_img = null where id = '.$request->id.' and bol_eliminado = 0');    

        Session::flash('message','¡Se ha eliminado la imágen de la persona de ilernus con éxito!');
        return Redirect::to('/Ver-Equipo-iLernus-'.$request->id); 

    }

    public function eliminarCuenta(Request $request)
    {
        
        $cuenta = DB::update('update tbl_equipoilernus set bol_eliminado = 1 where id = '.$request->id.' and bol_eliminado = 0');

        Session::flash('message','¡Se ha eliminado la persona de ilernus con éxito!');
        return Redirect::to('/Buscar-Equipo-iLernus'); 

    }

}
