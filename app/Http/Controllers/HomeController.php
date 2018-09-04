<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use PHPMailer;
use DB;
use Validator;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $totalReservaciones = DB::table('tbl_reservaciones')->count();
        $totalClientes = DB::table('users')->count();

        /*$clientes = DB::table('users as u')
                ->join('cat_paises as p', 'p.id', '=', 'u.lng_idpais')
                ->select('u.id','name','email','str_ci_pasaporte','u.blb_img','str_genero','lng_idpais','p.str_paises')
                ->where('u.bol_eliminado', '=' ,0)                
                ->orderBy('name','asc')
                ->get();*/

        $clientes = DB::select('SELECT u.id, name,email,str_ci_pasaporte,u.blb_img,str_genero,lng_idpais,p.str_paises
                    from users as u
                    left join cat_paises p on p.id = u.lng_idpais
                    where u.bol_eliminado = 0
                    order by u.name asc');

        $reservacionesPaises = DB::select('SELECT COUNT(r.id) as total, p.str_paises, p.blb_img FROM tbl_reservaciones r
                    join users as u on u.id = r.lng_idpersona
                    left join cat_paises as p on p.id = u.lng_idpais
                    GROUP BY p.str_paises
                    ORDER BY p.str_paises');

        $hoy = date('Y-m-d');

        $reservacionesPaisesHoy = DB::select('SELECT COUNT(r.id) as total FROM tbl_reservaciones r
                    join users as u on u.id = r.lng_idpersona
                    left join cat_paises as p on p.id = u.lng_idpais
                    WHERE DATE(r.updated_at) = "'.$hoy.'"
                    GROUP BY p.str_paises
                    ORDER BY p.str_paises');


        $clientesPaisesHoy = DB::select('SELECT COUNT(u.id) as total FROM users u
                    
                    left join cat_paises as p on p.id = u.lng_idpais
                    WHERE DATE(u.updated_at) = "'.$hoy.'"
                    GROUP BY p.str_paises
                    ORDER BY p.str_paises');        

        //dd($reservacionesPaisesHoy);die();

        $reservaciones = DB::table('tbl_reservaciones')->get();

        $matrimonial = DB::table('tbl_reservaciones')->where('lng_idtipohab', 1)->count();

        $suite = DB::table('tbl_reservaciones')->where('lng_idtipohab', 2)->count();

        $doble = DB::table('tbl_reservaciones')->where('lng_idtipohab', 3)->count();

        $familiar = DB::table('tbl_reservaciones')->where('lng_idtipohab', 4)->count();

        return \View::make('index', compact('totalReservaciones','totalClientes','clientes','reservaciones','matrimonial','suite','doble','familiar','reservacionesPaises','reservacionesPaisesHoy','clientesPaisesHoy'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function denegado()
    {
        return \View::make('errors.denegado');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getRecuperar()
    {
        return \View::make('usuarios.recuperar');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRecuperar(Request $request)
    {

        //Mi variable bandera para establecer si pasa o no a determinada vista:
        $flag = false;
 
            $user = User::where('email',$request->email)->first();
            //var_dump($user->id);
            //die();

        if (!empty($user)) {
            $flag = true;
                       
            $clave = $this->generarCodigo(8);
            
            $id = $user->id;
            
            $nombre = $user->str_nombre;
            
            $apellido = $user->str_apellido;
            
            //die($id);
            $user = User::find($id);
            $user->password = $clave;
            $user->save();

            $message = '<table>

        <tr>
            <td>
                <img src="smarty/assets/images/LOGOS-ILERNUS-FINAL-2017-02.png" alt="Logo de iLernus">
    
            </td>       
        </tr>
        <tr>
            
            <td>
                <p>
                    <b>*** POR FAVOR NO RESPONDA ESTE CORREO ***</b>
                </p>
                
                <p>
                    <b>Este correo electronico ha sido enviado por ilernus.com</b>
                    <br><br>
                    Estimada(o) '.ucfirst($nombre).' '.ucfirst($apellido).',
                </p>
                                
            </td>
        </tr>       
        
        <tr>
            <td>
                <p>
                    Usted solicitó recuperar la clave de su cuenta. A continuación su nueva clave de acceso:<br><br>
                
                    <b>Clave: '.$clave.'</b><br>
                    
                    Para cambiar su clave, podra hacerlo en su panel de administración en la opción <b>Mi Cuenta</b> y luego en la opción <b>Clave</b>
                    
                </p>
                <p>
                    Por favor, conserve este mensaje para una futura referencia.<br>
                    Muchas gracias,             
                </p>
                
                <p>
                    El equipo de iLernus<br>
                    www.iLernus.com
                </p>
                
            </td>
        </tr>
        
    </table>';
            
            /*
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $cabeceras .= "Content-Type: image/png";
            $cabeceras .= 'To: <'.$request->email.'>' . "\r\n";   
            $cabeceras .= 'From: Troovami <troovami@gmail.com>' . "\r\n";
        
            if (!mail($request->email, 'Recuperar Clave - Troovami.com', $message, $cabeceras)) {
                //echo "Error: " . $mail->ErrorInfo;
                Session::flash('message','Error!, el mensaje no se pudo enviar');
            } else {
                Session::flash('message','Su clave fue enviada exitosamente a su dirección de correo electrónico');
            }
            */


            
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Debugoutput = 'html';
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Username = "atrellus@gmail.com";
            $mail->Password = "falcor90dvv";
            $mail->setFrom('admin@ilernus.com', 'ilernus.com');
            $mail->addAddress($request->email);
            $mail->Subject = 'Recuperar Clave - iLernus.com';
            //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
            //$mail->msgHTML('<img src="autostars/images/trovami-logo-beta.png" alt="Logo">Su nueva clave es:  '.$clave);
                        
            $mail->msgHTML($message);
                        
            $mail->AltBody = 'Recuperar Clave';
            //$mail->addAttachment('images/imagen_adjunta.png');
             
            if (!$mail->send()) {
                //echo "Error: " . $mail->ErrorInfo;
                Session::flash('error','Error!'.$mail->ErrorInfo);
            } else {
                Session::flash('message','Su clave fue enviada exitosamente a su dirección de correo electrónico');
            }
            

            return Redirect::to('/Recuperar-Clave');    
        }   

        if ($flag == false) {
            //echo "no existe";
             Session::flash('error','¡Error!, la dirección de correo eletrónico no existe en el sistema');
             return Redirect::to('/Recuperar-Clave'); 
        }

    }
    
    public function generarCodigo($longitud) {
        $key = '';
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
        $max = strlen($pattern)-1;
        for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
        return $key;
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

        //dd($gerencias);die(); 

        return \View::make('usuarios.crearCuenta', compact('generos','roles','gerencias'));
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
        Session::flash('message','¡El usuario ha sido creado con éxito!');
        return Redirect::to('/Crear-Cuenta'); 
        
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
                
            'name' => 'required|max:255|unique:tbl_admin',
            'str_cedula' => 'required|max:255|unique:tbl_admin',
            'str_nombre' => 'required|max:255',
            'str_apellido' => 'required|max:255',
            'str_genero' => 'required|max:255',
            'email' => 'required|email|max:255|unique:tbl_admin',
            'str_telefono' => 'required|max:255',
            'str_departamento' => 'required|max:255',
            'str_rol' => 'required|max:255',
            'password' => 'min:6|required', 
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

            return User::create([


                'name' => $data['name'],
                'str_cedula' => $data['str_cedula'],
                'str_nombre' => $data['str_nombre'],
                'str_apellido' => $data['str_apellido'],
                'str_genero' => $data['str_genero'],
                'email' => $data['email'],
                'str_telefono' => $data['str_telefono'],
                'str_departamento' => $data['str_departamento'],
                'str_rol' => $data['str_rol'],
                'password' => $data['password'],
                'blb_img' => $data['blb_img'],
                //'blb_img' => base64_encode(file_get_contents($data['blb_img'])),
                'str_estatus' => 'activo',

            ]);

        }else{

            return User::create([

                'name' => $data['name'],
                'str_cedula' => $data['str_cedula'],
                'str_nombre' => $data['str_nombre'],
                'str_apellido' => $data['str_apellido'],
                'str_genero' => $data['str_genero'],
                'email' => $data['email'],
                'str_telefono' => $data['str_telefono'],
                'str_departamento' => $data['str_departamento'],
                'str_rol' => $data['str_rol'],
                'password' => $data['password'],
                'str_estatus' => 'activo',

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
    
        $usuarios = DB::table('tbl_admin')->where('bol_eliminado', '=', 0)->get();
        
        return \View::make('usuarios.buscarCuenta', compact('usuarios'));
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
    
        $usuarios = DB::table('tbl_admin')
        ->where('id', $id)
        ->Where(function ($query) {
            $query->where('bol_eliminado', '=', 0);
        })  
        ->get();

        if (!$usuarios){
            
           Session::flash('message','¡El id solicitado no existe!');
           return Redirect::to('/Buscar-Cuenta'); 
            
        }

        $generos = DB::table('cat_datos_maestros')
        ->where('str_tipo', 'genero')
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
        return \View::make('usuarios.cuenta', compact('usuarios','generos', 'roles','gerencias','estatus'));
    }

    public function editarCuenta(Request $request)
    {
        
        /*$validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }*/

        $user = User::find($request->id);
        $user->fill($request->all());
        $user->save();

        Session::flash('message','¡Se han editado los datos personales con éxito!');
        return Redirect::to('/Ver-Cuenta-'.$request->id); 

    }

    public function editarImagen(Request $request)
    {
        
        $user = User::find($request->id);
        $user->fill($request->all());
        $user->save();

        Session::flash('message','¡Se ha cambiado la imágen de perfil con éxito!');
        return Redirect::to('/Ver-Cuenta-'.$request->id); 

    }

    public function eliminarImagen(Request $request)
    {
        
        $imagen = DB::update('update tbl_admin set blb_img = null where id = '.$request->id.' and bol_eliminado = 0');    

        Session::flash('message','¡Se ha eliminado la imágen de perfil con éxito!');
        return Redirect::to('/Ver-Cuenta-'.$request->id); 

    }

    public function eliminarCuenta(Request $request)
    {
        
        $cuenta = DB::update('update tbl_admin set bol_eliminado = 1 where id = '.$request->id.' and bol_eliminado = 0');

        Session::flash('message','¡Se ha eliminado la cuenta con éxito!');
        return Redirect::to('/Buscar-Cuenta'); 

    }













    public function verCuenta2($id)
    {
    
        $usuarios = DB::table('tbl_admin')->where('id', $id)->get();

        //dd($usuarios);die();

        if( !$usuarios){

           return \View::make('errors.404');
        }
        
        return \View::make('usuarios.cuenta', compact('usuarios'));

    }


}
