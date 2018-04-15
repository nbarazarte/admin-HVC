<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Categoria;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use PHPMailer;
use DB;
use Validator;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
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
    public function crearPost()
    {

        $autores = DB::table('tbl_autores')
        ->Where(function ($query) {
            $query->where('bol_eliminado', '=', 0);
        })              
        ->orderBy('str_nombre')
        ->select('str_nombre','id')
        ->lists('str_nombre','id');

        $etiquetas = DB::table('cat_datos_maestros')
        ->where('str_tipo', '=' ,'etiqueta')
        ->Where(function ($query) {
            $query->where('bol_eliminado', '=', 0);
        })              
        ->orderBy('str_descripcion')
        ->select('str_descripcion','id')
        ->lists('str_descripcion','id');

        //dd($etiquetas);die(); 

        return \View::make('post.crearPost', compact('autores','etiquetas'));
    }

  /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCrearPost(Request $request)
    {

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
        $this->create($request->all());

        //return redirect($this->redirectPath()); 
        Session::flash('message','¡El post ha sido creado con éxito!');
        return Redirect::to('/Crear-Post-iLernus'); 
        
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
            'str_post_resumen' => 'required', 
            'str_post' => 'required',      

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

            $post = Post::create([

            'lng_idadmin' =>  Auth::user()->id,    
            'str_tipo' =>  $data['str_tipo'],
            'lng_idautor' =>  $data['lng_idautor'],
            'str_titulo' => $titulo,
            'str_post_resumen' => $data['str_post_resumen'],
            'str_post' => $data['str_post'],
            'str_estatus' => 'inactivo',
            ]);

        }else if($data['str_tipo'] == 'imagen'){ 

            $img1 = base64_encode(file_get_contents($data['blb_img1']));      

            $post = Post::create([

            'lng_idadmin' =>  Auth::user()->id,
            'str_tipo' =>  $data['str_tipo'],
            'lng_idautor' =>  $data['lng_idautor'],
            'str_titulo' => $titulo,
            'str_post_resumen' => $data['str_post_resumen'],
            'str_post' => $data['str_post'],
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

            $post = Post::create([

            'lng_idadmin' =>  Auth::user()->id,
            'str_tipo' =>  $data['str_tipo'],
            'lng_idautor' =>  $data['lng_idautor'],
            'str_titulo' => $titulo,
            'str_post_resumen' => $data['str_post_resumen'],
            'str_post' => $data['str_post'],
            'blb_img1' => $img1,
            'blb_img2' => $img2,
            'blb_img3' => $img3,
            'str_estatus' => 'inactivo',
            ]); 

        }else if($data['str_tipo'] == 'video'){

            $post = Post::create([

            'lng_idadmin' =>  Auth::user()->id, 
            'str_tipo' =>  $data['str_tipo'],
            'lng_idautor' =>  $data['lng_idautor'],
            'str_titulo' => $titulo,
            'str_post_resumen' => $data['str_post_resumen'],
            'str_post' => $data['str_post'],
            'str_video' => $data['str_video'],
            'str_estatus' => 'inactivo',
            ]); 

        }else if($data['str_tipo'] == 'audio'){

            $post = Post::create([

            'lng_idadmin' =>  Auth::user()->id,    
            'str_tipo' =>  $data['str_tipo'],
            'lng_idautor' =>  $data['lng_idautor'],
            'str_titulo' => $titulo,
            'str_post_resumen' => $data['str_post_resumen'],
            'str_post' => $data['str_post'],
            'str_audio' => $data['str_audio'],
            'str_estatus' => 'inactivo',
            ]); 

        }

        $lastInsertedId = $post->id;


        if(!empty($data['str_categoria'])){

            //dd($data['str_categoria']);
            //die();

            $categorias = array_values($data['str_categoria']);
            
            $total_categorias = count($categorias);
            
            for ($i = 0; $i <= $total_categorias - 1; $i++)
            {
                $categoriasPost = Categoria::create([
                    'lng_idpost' => $lastInsertedId,
                    'str_categoria' => $categorias[$i],
                ]);
            }

            return $categoriasPost;

        }else{

            return $post;

        }


  
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function buscarPost()
    {

        $posts = DB::table('tbl_post as p')
                ->join('tbl_autores as au', 'au.id', '=', 'p.lng_idautor')
                ->join('tbl_admin as adm', 'adm.id', '=', 'p.lng_idadmin')
                ->where('p.bol_eliminado', '=' ,0)
                ->select('p.id as idpost','p.str_estatus','adm.name as usuario','adm.blb_img as img_usuario','p.str_titulo', 'p.str_post', 'p.str_post_resumen', 'p.str_tipo', 'p.str_video','p.str_audio', 'p.blb_img1', 'p.blb_img2', 'p.blb_img3', 'p.created_at as fecha', 'au.id', 'au.str_nombre as autor', 'au.str_genero', 'au.str_profesion', 'au.str_cv', 'au.blb_img')
                ->orderBy('p.id','asc')
                ->get();



            //dd($posts);die();
        
        return \View::make('post.buscarPost', compact('posts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function estatusPost($id, $estatus)
    {
    
        $estatusPost = DB::update('update tbl_post set str_estatus = "'.$estatus.'", lng_idadmin = '.Auth::user()->id.' where id = '.$id.' and bol_eliminado = 0');
         
        return $estatusPost;
    }

    public function verPost($id)
    {
    
        $posts = DB::table('tbl_post as p')
        ->join('tbl_autores as a', 'p.lng_idautor', '=', 'a.id')
        ->where('p.id', '=', $id)
        ->Where(function ($query) {
            $query->where('p.bol_eliminado', '=', 0);
        })

        ->select( 'p.id as idpost','p.str_estatus','p.str_tipo', 'p.created_at as fecha','p.str_titulo', 'p.str_post', 'p.str_post_resumen','p.str_video', 'p.str_audio', 'p.blb_img1', 'p.blb_img2', 'p.blb_img3', 'a.str_nombre as autor')

        ->orderBy('p.id', 'desc')
        ->get(); 
              
        $autores = DB::table('tbl_autores')
            ->orderBy('str_nombre', 'asc')
            ->where('bol_eliminado', '=', 0)
            ->select('str_nombre','id')
            ->lists('str_nombre','id');

        $tipopost = DB::table('cat_datos_maestros')
            ->where('str_tipo', 'post')
            ->where('bol_eliminado', '=', 0)
            ->orderBy('id', 'asc')
            ->lists('str_descripcion');

        $tipoEstatus = DB::table('cat_datos_maestros')
            ->where('str_tipo', 'estatus_post')
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


        $etiquetas = DB::table('tbl_categorias_post as cat')
        ->where('cat.lng_idpost', '=', $id)
        ->orderBy('str_categoria')
        ->select('str_categoria')
        ->lists('str_categoria');          

        //dd($todasEtiquetas);

        return \View::make('post.post', compact('posts','categorias','autores','tipopost','todasEtiquetas','etiquetas','tipoEstatus'));
    }

    public function editarPost(Request $request)
    {
        
        /*$validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }*/

        $request["str_titulo"] = str_replace(" ","-",$request->str_titulo);
        $post = Post::find($request->id);
        $post->fill($request->all());
        $post->save();

        Session::flash('message','¡Se han editado los datos del post con éxito!');
        return Redirect::to('/Ver-Post-iLernus-'.$request->id); 

    }

    public function editarMultimedia(Request $request)
    {
        
        $blb_img1 = base64_encode(file_get_contents($request->blb_img1));
        $publicacion = DB::update("update tbl_post set str_tipo = '".$request->str_tipo."', blb_img1 = '".$blb_img1."' where id = ".$request->id);

        Session::flash('message','¡Se ha cambiado la imágen del post con éxito!');
        return Redirect::to('/Ver-Post-iLernus-'.$request->id); 

    }

    public function editarMultimedia2(Request $request)
    {
        
        $blb_img1 = base64_encode(file_get_contents($request->blb_img1));
        $blb_img2 = base64_encode(file_get_contents($request->blb_img2));
        $blb_img3 = base64_encode(file_get_contents($request->blb_img3));

        $publicacion = DB::update("update tbl_post set str_tipo = '".$request->str_tipo."', blb_img1 = '".$blb_img1."', blb_img2 = '".$blb_img2."', blb_img3 = '".$blb_img3."' where id = ".$request->id);

        Session::flash('message','¡Se ha cambiado la imágen del post con éxito!');
        return Redirect::to('/Ver-Post-iLernus-'.$request->id); 

    }

    public function editarMultimedia3(Request $request)
    {
        
        $post = Post::find($request->id);
        $post->fill($request->all());
        $post->save();

        Session::flash('message','¡Se ha cambiado el contenido multimedia con éxito!');
        return Redirect::to('/Ver-Post-iLernus-'.$request->id); 

    }

    public function editarMultimedia4(Request $request)
    {
        
        /*$validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }*/

        $post = Post::find($request->id);
        $post->fill($request->all());
        $post->save();

        Session::flash('message','¡Se ha quitado el contenido multimedia con éxito!');
        return Redirect::to('/Ver-Post-iLernus-'.$request->id); 

    }

    public function editarEtiquetas(Request $request)
    {
        
        $categoriasPostActuales = DB::table('tbl_categorias_post')
            ->where('lng_idpost', '=', $request->id)
            ->delete();

        //dd($request);die();

        $categorias = array_values($request->str_categoria);
        
        $total_categorias = count($categorias);
        
        for ($i = 0; $i <= $total_categorias - 1; $i++)
        {
            $categoriasPost = Categoria::create([
                'lng_idpost' => $request->id,
                'str_categoria' => $categorias[$i],
            ]);
        }

     

        Session::flash('message','¡Se han editado las etiquetas con éxito!');
        return Redirect::to('/Ver-Post-iLernus-'.$request->id); 

    }


    public function eliminarPost(Request $request)
    {
        
        $post = DB::update('update tbl_post set bol_eliminado = 1 where id = '.$request->id.' and bol_eliminado = 0');

        Session::flash('message','¡Se ha eliminado el post con éxito!');
        return Redirect::to('/Buscar-Post-iLernus'); 

    }







}
