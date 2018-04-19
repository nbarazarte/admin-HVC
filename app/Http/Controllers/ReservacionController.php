<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Reservaciones;
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
        Session::flash('message','¡La reservación ha sido creada con éxito!');
        return Redirect::to('/Buscar-Reservación'); 
        
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
                
            'contact-idHabitacion' => 'required|max:255',
            'contact-llegada' => 'required|max:255',
            'contact-salida' => 'required|max:255',  
            'contact-email' => 'required|max:255',
            'contact-name' => 'required|max:255',
            'contact-phone' => 'required|max:255',
            'contact-precioHabitacion' => 'required|max:255',     
            'contact-ninos' => 'required|max:255',
            'contact-adultos' => 'required|max:255',
            'cant-dias' => 'required|max:255',
            'contact-totalPagar' => 'required|max:255',  

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


        return Reservaciones::create([

            'lng_idpersona' => $data['contact-id'],
            'lng_idtipohab' => $data['contact-idHabitacion'],
            'dmt_fecha_entrada' => $data['contact-llegada'],
            'dmt_fecha_salida' => $data['contact-salida'],
            'str_codigo' => \Auth::user()->id.$this->generarCodigo(100),
            'str_email' => $data['contact-email'],
            'str_nombre' => $data['contact-name'],
            'str_telefono' => $data['contact-phone'],
            'dbl_precio' => $data['contact-precioHabitacion'],
            'int_ninos' => $data['contact-ninos'],
            'int_adultos' => $data['contact-adultos'],
            'int_dias' => $data['cant-dias'],
            'str_mensaje' => $data['contact-message'],
            'dbl_total_pagar' => $data['contact-totalPagar'],
            'str_tipo_reserva' => 'Hotel', 

        ]);
  
    }


    public function generarCodigo($longitud) {
        $key = '';

        $date=date_create();
        //echo date_timestamp_get($date);  
        $pattern = date_timestamp_get($date).'1234567890abcdefghijklmnopqrstuvwxyz';
        $max = strlen($pattern)-1;
        for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};

        return $key;
    } 

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function buscarReservacion()
    {

        $reservaciones = DB::table('tbl_reservaciones as r')
                ->join('users as u', 'u.id', '=', 'r.lng_idpersona')
                ->join('cat_habitaciones as h', 'h.id', '=', 'r.lng_idtipohab')
                ->join('cat_paises as p', 'p.id', '=', 'u.lng_idpais')
                ->select('r.*', 'r.id as idreservacion','u.*','h.*','p.blb_img as bandera','p.str_paises')
                ->orderBy('r.dmt_fecha_entrada','asc')
                ->get();

            //dd($reservacions);die();
        
        return \View::make('reservaciones.buscarReservacion', compact('reservaciones'));
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
    
        $reservaciones = DB::table('tbl_reservaciones as r')
            ->join('users as u', 'u.id', '=', 'r.lng_idpersona')
            ->join('cat_habitaciones as h', 'h.id', '=', 'r.lng_idtipohab')
            ->join('cat_paises as p', 'p.id', '=', 'u.lng_idpais')
            ->where('r.id', '=', $id)
            ->select('r.str_estatus_pago','str_email','str_nombre','r.str_telefono','dbl_precio','dbl_total_pagar','int_ninos','int_adultos','int_dias','str_mensaje','dmt_fecha_entrada','dmt_fecha_salida','str_tipo_reserva', 'u.name','u.email','u.str_telefono as phone','u.str_ci_pasaporte','u.str_genero','h.*','p.blb_img as bandera','p.str_paises')
            ->orderBy('r.dmt_fecha_entrada','asc')
            ->get();                   

        //dd($reservaciones);

        return \View::make('reservaciones.reservacion', compact('reservaciones'));
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
