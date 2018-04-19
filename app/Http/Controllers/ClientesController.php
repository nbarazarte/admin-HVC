<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cliente;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use PHPMailer;
use DB;
use Validator;
use Illuminate\Support\Facades\Auth;

class ClientesController extends Controller
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

        $paises = DB::table('cat_paises')
        ->select('id','str_paises')
        ->orderBy('str_paises')
        ->get();           

        //dd($paises);die(); 

        return \View::make('clientes.crearCuenta', compact('generos','paises'));
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
        Session::flash('message','¡El cliente ha sido creado con éxito!');
        return Redirect::to('/Buscar-Clientes'); 
        
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
                
            'name' => 'required|max:255',
            'str_ci_pasaporte' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'lng_idpais' => 'required|max:255',
            'str_genero' => 'required|max:255',
            'str_telefono' => 'required|max:255',  

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

            return Cliente::create([

                'name' => $data['name'],
                'email' => $data['email'],
                'str_telefono' => $data['str_telefono'],
                'str_ci_pasaporte' => $data['str_ci_pasaporte'],
                'lng_idpais' => $data['lng_idpais'],
                'str_genero' => $data['str_genero'],
                'blb_img' => $data['blb_img'],
                //'blb_img' => base64_encode(file_get_contents($data['blb_img'])),
            ]);

        }else{

            return Cliente::create([

                'name' => $data['name'],
                'email' => $data['email'],
                'str_telefono' => $data['str_telefono'],
                'str_ci_pasaporte' => $data['str_ci_pasaporte'],
                'lng_idpais' => $data['lng_idpais'],
                'str_genero' => $data['str_genero'],                
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

        $clientes = DB::table('users as u')
                ->join('cat_paises as p', 'p.id', '=', 'u.lng_idpais')
                ->select('u.id','name','email','str_ci_pasaporte','u.blb_img','str_genero','lng_idpais','p.str_paises','p.blb_img as bandera')
                ->where('u.bol_eliminado', '=' ,0)                
                ->orderBy('name','asc')
                ->get();

                //dd($clientes);die();
        
        return \View::make('clientes.buscarCuenta', compact('clientes'));
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
    
        $clientes = DB::table('users as u')
        ->join('cat_paises as p', 'p.id', '=', 'u.lng_idpais')
  
        ->select('u.id','name','email','str_ci_pasaporte','u.blb_img','str_genero','str_telefono','u.lng_idpais','p.str_paises')
        ->where('u.id', $id)

        ->get();

        $generos = DB::table('cat_datos_maestros')
        ->where('str_tipo', 'genero')
        ->Where(function ($query) {
            $query->where('bol_eliminado', '=', 0);
        })
        ->lists('str_descripcion');

        $paises = DB::table('cat_paises')
        ->select('id','str_paises')
        ->get();

        $habitaciones = DB::table('cat_habitaciones') ->lists('str_habitacion');  
              
        //dd($generos);die();
        return \View::make('clientes.cuenta', compact('clientes','generos','paises','habitaciones'));
    }

    public function editarCuenta(Request $request)
    {
        
        /*$validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }*/
        //dd($request->all());die();
        $cliente = Cliente::find($request->id);
        $cliente->fill($request->all());
        $cliente->save();

        Session::flash('message','¡Se han editado los datos del cliente con éxito!');
        return Redirect::to('/Ver-Cliente-'.$request->id); 

    }

    public function editarImagen(Request $request)
    {
        
        $cliente = Cliente::find($request->id);
        $cliente->fill($request->all());
        $cliente->save();

        Session::flash('message','¡Se ha cambiado la imágen de perfil con éxito!');
        return Redirect::to('/Ver-Cliente-'.$request->id); 

    }

    public function eliminarImagen(Request $request)
    {
        
        $imagen = DB::update('update users set blb_img = null where id = '.$request->id.' and bol_eliminado = 0');    

        Session::flash('message','¡Se ha eliminado la imágen de perfil con éxito!');

        return Redirect::to('/Ver-Cliente-'.$request->id); 
       
    }

    public function eliminarCuenta(Request $request)
    {
        
        $cuenta = DB::update('update users set bol_eliminado = 1 where id = '.$request->id.' and bol_eliminado = 0');

        Session::flash('message','¡Se ha eliminado el cliente con éxito!');
        return Redirect::to('/Buscar-Clientes'); 

    }







}
