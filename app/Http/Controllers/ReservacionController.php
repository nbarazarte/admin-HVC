<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Reservacion;
use App\Categoria;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use PHPMailer;
use DB;
use Validator;
use Illuminate\Support\Facades\Auth;

class ReservacionController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function buscarDisponibilidad(Request $request)
    {
        
        //dd($request);die();

        $habitacion = DB::table('cat_habitaciones')->select('id','str_precio')->where('str_habitacion', $_POST['contact-habitacion'] )->get();

        foreach ($habitacion[0] as $key => $value) {
           
            $hab[$key] = $value;  
        }    

        $precio_habitacion = $hab['str_precio'];

        $id_habitacion = $hab['id'];
        $entrada = substr($_POST['entrada-salida'], 0, 10 );
        $salida = substr($_POST['entrada-salida'], 12, 20 );
        $entrar = "Ocupada";
        $condicion = 'false';

        $filtro1 = DB::select("SELECT dmt_fecha_entrada, dmt_fecha_salida, minfe, maxfs
                                FROM tbl_reservaciones r
                                left JOIN (SELECT * FROM reservaciones) as rs ON rs.maxfs >= dmt_fecha_salida and rs.lng_idtipohab = ".$id_habitacion."
                                WHERE 
                                (
                                    (   
                                        ('".$entrada."' BETWEEN dmt_fecha_entrada and dmt_fecha_salida) 
                                        
                                        and 
                                        
                                        ('".$salida."' BETWEEN dmt_fecha_entrada and dmt_fecha_salida)
                                    )
                                or 
                                    (   (dmt_fecha_entrada BETWEEN '".$entrada."' and '".$salida."') 
                                        
                                        or

                                        (dmt_fecha_salida BETWEEN '".$entrada."' and '".$salida."')
                                    )
                                or 
                                    (
                                        (dmt_fecha_entrada = '".$entrada."') and (dmt_fecha_salida = '".$salida."')
                                    )
                                ) 
                                and r.lng_idtipohab = ".$id_habitacion." order by dmt_fecha_entrada"

                            );

        if( count($filtro1) == 0){

            $entrar = "Disponible";//mando a reservar directo
 
        }else{
            
            for ($i=0; $i < count($filtro1); $i++) 
            { 

                foreach ($filtro1[$i] as $key => $value) {

                    $datos[$key] = $value;
                } 

                if(($entrada <= $datos['minfe']) and ($salida <= $datos['minfe'])){

                    $entrar = "Disponible";//1 mando a reservar directo     
                }

                if(($entrada >= $datos['maxfs']) and ($salida >= $datos['maxfs'])){

                    $entrar = "Disponible";//2 mando a reservar directo     
                }

                if(($entrada == $datos['dmt_fecha_entrada']) and ($salida == $datos['dmt_fecha_salida'])){

                   $condicion = 'false';
                }

                if (count($filtro1) == 2) {
                    
                    if(($entrada > $datos['dmt_fecha_entrada']) and ($entrada == $datos['dmt_fecha_salida']) ) {

                        $condicion = 'true';
                    }

                }

                if (count($filtro1) > 2) {
                    
                    if(($entrada > $datos['dmt_fecha_entrada']) and ($entrada == $datos['dmt_fecha_salida']) ) {

                        $condicion = 'true';
                        
                    }else{

                        $condicion = 'false';
                    }
                }                

                if ($condicion == 'true') {

                    if(($entrada < $datos['dmt_fecha_entrada']) and ($salida == $datos['dmt_fecha_entrada']) ) {

                        $entrar = 'Disponible';//3 mando a reservar directo
                    }
                }

                if (count($filtro1) == 1) {
                                        
                    if (($entrada == $datos['dmt_fecha_salida']) or ($salida == $datos['dmt_fecha_entrada'])) {
                        
                        $entrar = 'Disponible';
                    }
                }
            }
        }
                           
        //echo $entrar."<br>"; echo $entrada. "--". $salida. "<br>"; dd($filtro1); die();

        $fecha_entrada = date("d/m/Y", strtotime($entrada));
        $fecha_salida = date("d/m/Y", strtotime($salida));

        if($entrar != 'Disponible'){

            Session::flash('message','No hay disponibilidad de habitaciones entre el: '.$fecha_entrada." y ".$fecha_salida);

            return redirect()->back();//realizar pago
            
            //return Redirect::to('/Contáctanos');
        }

        
        $total_pagar = $_POST['cant-dias'] * $precio_habitacion;

        //lo asigno a lo que viene por post del formulario:
        array_push($_POST, $_POST['contact-idHabitacion']=$id_habitacion,$_POST['contact-precioHabitacion']=$precio_habitacion, $_POST['contact-totalPagar']=$total_pagar);        

        $datos = $_POST;

        Session::pull('datosReserva', array(compact('datos')));//borra
        Session::push('datosReserva', array(compact('datos')));//asigna

        //dd(Session::get('datosReserva'));die();

        return Redirect::to('/Crear-Reservación');  

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function crearReservacion()
    {

        //dd(Session::get('test'));

        $datos = Session::get('datosReserva');

        //dd($datos[0][0]['datos']);die();

        if(!empty($datos)) {

            return view('reservaciones.crearReservacion',compact('datos'));

        }else{

            return view('index');

        }


    }

  /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCrearReservacion(Request $request)
    {

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
        $this->create($request->all());

        //return redirect($this->redirectPath()); 
        Session::flash('message','¡La reservación ha sido creado con éxito!');
        return Redirect::to('/Crear-Reservación'); 
        
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
                
            'str_tipo' => 'required|max:255',
            'lng_idautor' => 'required|max:255',
            'str_titulo' => 'required|max:255',
            'str_Reservacion_resumen' => 'required', 
            'str_Reservacion' => 'required',      

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

        $titulo = str_replace(" ","-",$data['str_titulo']);   
           
        if($data['str_tipo'] == 'simple'){

            //echo Auth::user()->id;
            //die();

            $reservacion = Reservacion::create([

            'lng_idadmin' =>  Auth::user()->id,    
            'str_tipo' =>  $data['str_tipo'],
            'lng_idautor' =>  $data['lng_idautor'],
            'str_titulo' => $titulo,
            'str_Reservacion_resumen' => $data['str_Reservacion_resumen'],
            'str_Reservacion' => $data['str_Reservacion'],
            'str_estatus' => 'inactivo',
            ]);

        }else if($data['str_tipo'] == 'imagen'){ 

            $img1 = base64_encode(file_get_contents($data['blb_img1']));      

            $reservacion = Reservacion::create([

            'lng_idadmin' =>  Auth::user()->id,
            'str_tipo' =>  $data['str_tipo'],
            'lng_idautor' =>  $data['lng_idautor'],
            'str_titulo' => $titulo,
            'str_Reservacion_resumen' => $data['str_Reservacion_resumen'],
            'str_Reservacion' => $data['str_Reservacion'],
            'blb_img1' => $img1,
            'str_estatus' => 'inactivo',
            ]); 

        }else if($data['str_tipo'] == 'carrusel-imagen'){

            $img1 = base64_encode(file_get_contents($data['blb_img1']));
            $img2 = base64_encode(file_get_contents($data['blb_img2']));

            if(empty($data['blb_img3'])){

                $img3 = $data['blb_img3'];
            }else{
                $img3 = base64_encode(file_get_contents($data['blb_img3']));
            } 

            $reservacion = Reservacion::create([

            'lng_idadmin' =>  Auth::user()->id,
            'str_tipo' =>  $data['str_tipo'],
            'lng_idautor' =>  $data['lng_idautor'],
            'str_titulo' => $titulo,
            'str_Reservacion_resumen' => $data['str_Reservacion_resumen'],
            'str_Reservacion' => $data['str_Reservacion'],
            'blb_img1' => $img1,
            'blb_img2' => $img2,
            'blb_img3' => $img3,
            'str_estatus' => 'inactivo',
            ]); 

        }else if($data['str_tipo'] == 'video'){

            $reservacion = Reservacion::create([

            'lng_idadmin' =>  Auth::user()->id, 
            'str_tipo' =>  $data['str_tipo'],
            'lng_idautor' =>  $data['lng_idautor'],
            'str_titulo' => $titulo,
            'str_Reservacion_resumen' => $data['str_Reservacion_resumen'],
            'str_Reservacion' => $data['str_Reservacion'],
            'str_video' => $data['str_video'],
            'str_estatus' => 'inactivo',
            ]); 

        }else if($data['str_tipo'] == 'audio'){

            $reservacion = Reservacion::create([

            'lng_idadmin' =>  Auth::user()->id,    
            'str_tipo' =>  $data['str_tipo'],
            'lng_idautor' =>  $data['lng_idautor'],
            'str_titulo' => $titulo,
            'str_Reservacion_resumen' => $data['str_Reservacion_resumen'],
            'str_Reservacion' => $data['str_Reservacion'],
            'str_audio' => $data['str_audio'],
            'str_estatus' => 'inactivo',
            ]); 

        }

        $lastInsertedId = $reservacion->id;


        if(!empty($data['str_categoria'])){

            //dd($data['str_categoria']);
            //die();

            $categorias = array_values($data['str_categoria']);
            
            $total_categorias = count($categorias);
            
            for ($i = 0; $i <= $total_categorias - 1; $i++)
            {
                $categoriasReservacion = Categoria::create([
                    'lng_idReservacion' => $lastInsertedId,
                    'str_categoria' => $categorias[$i],
                ]);
            }

            return $categoriasReservacion;

        }else{

            return $reservacion;

        }


  
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function buscarReservacion()
    {

        $reservaciones = DB::table('tbl_reservaciones as p')
                ->join('tbl_autores as au', 'au.id', '=', 'p.lng_idautor')
                ->join('tbl_admin as adm', 'adm.id', '=', 'p.lng_idadmin')
                ->where('p.bol_eliminado', '=' ,0)
                ->select('p.id as idReservacion','p.str_estatus','adm.name as usuario','adm.blb_img as img_usuario','p.str_titulo', 'p.str_Reservacion', 'p.str_Reservacion_resumen', 'p.str_tipo', 'p.str_video','p.str_audio', 'p.blb_img1', 'p.blb_img2', 'p.blb_img3', 'p.created_at as fecha', 'au.id', 'au.str_nombre as autor', 'au.str_genero', 'au.str_profesion', 'au.str_cv', 'au.blb_img')
                ->orderBy('p.id','asc')
                ->get();



            //dd($Reservacions);die();
        
        return \View::make('reservacion.buscarReservacion', compact('reservacions'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function estatusReservacion($id, $estatus)
    {
    
        $estatusReservacion = DB::update('update tbl_Reservaciones set str_estatus = "'.$estatus.'", lng_idadmin = '.Auth::user()->id.' where id = '.$id.' and bol_eliminado = 0');
         
        return $estatusReservacion;
    }

    public function verReservacion($id)
    {
    
        $reservaciones = DB::table('tbl_Reservacion as p')
        ->join('tbl_autores as a', 'p.lng_idautor', '=', 'a.id')
        ->where('p.id', '=', $id)
        ->Where(function ($query) {
            $query->where('p.bol_eliminado', '=', 0);
        })

        ->select( 'p.id as idReservacion','p.str_estatus','p.str_tipo', 'p.created_at as fecha','p.str_titulo', 'p.str_Reservacion', 'p.str_Reservacion_resumen','p.str_video', 'p.str_audio', 'p.blb_img1', 'p.blb_img2', 'p.blb_img3', 'a.str_nombre as autor')

        ->orderBy('p.id', 'desc')
        ->get(); 
              
        $autores = DB::table('tbl_autores')
            ->orderBy('str_nombre', 'asc')
            ->where('bol_eliminado', '=', 0)
            ->select('str_nombre','id')
            ->lists('str_nombre','id');

        $tipoReservacion = DB::table('cat_datos_maestros')
            ->where('str_tipo', 'Reservacion')
            ->where('bol_eliminado', '=', 0)
            ->orderBy('id', 'asc')
            ->lists('str_descripcion');

        $tipoEstatus = DB::table('cat_datos_maestros')
            ->where('str_tipo', 'estatus_Reservacion')
            ->where('bol_eliminado', '=', 0)
            ->orderBy('id', 'asc')
            ->lists('str_descripcion');


        $todasEtiquetas = DB::table('cat_datos_maestros')
            ->where('str_tipo', '=' ,'etiqueta')
            ->Where(function ($query) {
                $query->where('bol_eliminado', '=', 0);
            })              
            ->orderBy('str_descripcion')
            ->select('str_descripcion','id')
            ->lists('str_descripcion','id');


        $etiquetas = DB::table('tbl_categorias_Reservacion as cat')
        ->where('cat.lng_idReservacion', '=', $id)
        ->orderBy('str_categoria')
        ->select('str_categoria')
        ->lists('str_categoria');          

        //dd($todasEtiquetas);

        return \View::make('reservaciones.Reservacion', compact('reservaciones','categorias','autores','tipoReservacion','todasEtiquetas','etiquetas','tipoEstatus'));
    }

    public function editarReservacion(Request $request)
    {
        
        /*$validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }*/

        $request["str_titulo"] = str_replace(" ","-",$request->str_titulo);
        $Reservacion = Reservacion::find($request->id);
        $Reservacion->fill($request->all());
        $Reservacion->save();

        Session::flash('message','¡Se han editado los datos del reservación con éxito!');
        return Redirect::to('/Ver-Reservación-'.$request->id); 

    }

    public function editarMultimedia(Request $request)
    {
        
        $blb_img1 = base64_encode(file_get_contents($request->blb_img1));
        $publicacion = DB::update("update tbl_reservaciones set str_tipo = '".$request->str_tipo."', blb_img1 = '".$blb_img1."' where id = ".$request->id);

        Session::flash('message','¡Se ha cambiado la imágen del Reservacion con éxito!');
        return Redirect::to('/Ver-Reservación-'.$request->id); 

    }

    public function editarMultimedia2(Request $request)
    {
        
        $blb_img1 = base64_encode(file_get_contents($request->blb_img1));
        $blb_img2 = base64_encode(file_get_contents($request->blb_img2));
        $blb_img3 = base64_encode(file_get_contents($request->blb_img3));

        $publicacion = DB::update("update tbl_reservaciones set str_tipo = '".$request->str_tipo."', blb_img1 = '".$blb_img1."', blb_img2 = '".$blb_img2."', blb_img3 = '".$blb_img3."' where id = ".$request->id);

        Session::flash('message','¡Se ha cambiado la imágen del Reservacion con éxito!');
        return Redirect::to('/Ver-Reservacion-'.$request->id); 

    }

    public function editarMultimedia3(Request $request)
    {
        
        $Reservacion = Reservacion::find($request->id);
        $Reservacion->fill($request->all());
        $Reservacion->save();

        Session::flash('message','¡Se ha cambiado el contenido multimedia con éxito!');
        return Redirect::to('/Ver-Reservación-'.$request->id); 

    }

    public function editarMultimedia4(Request $request)
    {
        
        /*$validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }*/

        $Reservacion = Reservacion::find($request->id);
        $Reservacion->fill($request->all());
        $Reservacion->save();

        Session::flash('message','¡Se ha quitado el contenido multimedia con éxito!');
        return Redirect::to('/Ver-Reservación-'.$request->id); 

    }

    public function editarEtiquetas(Request $request)
    {
        
        $categoriasReservacionActuales = DB::table('tbl_categorias_Reservacion')
            ->where('lng_idReservacion', '=', $request->id)
            ->delete();

        //dd($request);die();

        $categorias = array_values($request->str_categoria);
        
        $total_categorias = count($categorias);
        
        for ($i = 0; $i <= $total_categorias - 1; $i++)
        {
            $categoriasReservacion = Categoria::create([
                'lng_idReservacion' => $request->id,
                'str_categoria' => $categorias[$i],
            ]);
        }

     

        Session::flash('message','¡Se han editado las etiquetas con éxito!');
        return Redirect::to('/Ver-Reservación-'.$request->id); 

    }


    public function eliminarReservacion(Request $request)
    {
        
        $Reservacion = DB::update('update tbl_reservaciones set bol_eliminado = 1 where id = '.$request->id.' and bol_eliminado = 0');

        Session::flash('message','¡Se ha eliminado el reservación con éxito!');
        return Redirect::to('/Buscar-Reservación'); 

    }







}
