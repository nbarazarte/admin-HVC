<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Instructor;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use PHPMailer;
use DB;
use Validator;
use Illuminate\Support\Facades\Auth;

class InstructoresIlernusController extends Controller
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

        return \View::make('instructores.crearCuenta', compact('generos'));
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
        Session::flash('message','¡El instructor ha sido creado con éxito!');
        return Redirect::to('/Crear-Instructor-iLernus'); 
        
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
            'str_profesion' => 'required|max:255',        
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
        

        if(!empty($data['blb_img'])){

            return Instructor::create([

                'lng_idadmin' =>  Auth::user()->id,
                'str_nombre' => $data['str_nombre'],
                'str_sexo' => $data['str_sexo'],
                'str_profesion' => $data['str_profesion'],
                'str_cv' => $data['str_cv'],
                'blb_img' => $data['blb_img'],
                //'blb_img' => base64_encode(file_get_contents($data['blb_img'])),

            ]);

        }else{

            return Instructor::create([

                'lng_idadmin' =>  Auth::user()->id,
                'str_nombre' => $data['str_nombre'],
                'str_sexo' => $data['str_sexo'],
                'str_profesion' => $data['str_profesion'],
                'str_cv' => $data['str_cv'],

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

        $instructores = DB::table('tbl_instructores as ins')
                ->join('tbl_admin as admin', 'ins.lng_idadmin', '=', 'admin.id')
                ->where('ins.bol_eliminado', '=' ,0)
                ->select('ins.id','ins.str_nombre','ins.str_sexo','ins.str_profesion','admin.name as usuario','ins.blb_img')
                ->orderBy('ins.str_nombre','asc')
                ->get();

                //dd($instructores);die();
        
        return \View::make('instructores.buscarCuenta', compact('instructores'));
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
    
        $instructores = DB::table('tbl_instructores')
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
              

        //dd($generos);die();
        return \View::make('instructores.cuenta', compact('instructores','generos'));
    }

    public function editarCuenta(Request $request)
    {
        
        /*$validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }*/

        $instructor = Instructor::find($request->id);
        $instructor->fill($request->all());
        $instructor->save();

        Session::flash('message','¡Se han editado los datos del Instructor con éxito!');
        return Redirect::to('/Ver-Instructor-iLernus-'.$request->id); 

    }

    public function editarImagen(Request $request)
    {
        
        $instructor = Instructor::find($request->id);
        $instructor->fill($request->all());
        $instructor->save();

        Session::flash('message','¡Se ha cambiado la imágen de perfil con éxito!');
        return Redirect::to('/Ver-Instructor-iLernus-'.$request->id); 

    }

    public function eliminarImagen(Request $request)
    {
        
        $imagen = DB::update('update tbl_instructores set blb_img = null where id = '.$request->id.' and bol_eliminado = 0');    

        Session::flash('message','¡Se ha eliminado la imágen de perfil con éxito!');
        return Redirect::to('/Ver-Instructor-iLernus-'.$request->id); 

    }

    public function eliminarCuenta(Request $request)
    {
        
        $cuenta = DB::update('update tbl_instructores set bol_eliminado = 1 where id = '.$request->id.' and bol_eliminado = 0');

        Session::flash('message','¡Se ha eliminado la cuenta con éxito!');
        return Redirect::to('/Buscar-Instructor-iLernus'); 

    }




}
