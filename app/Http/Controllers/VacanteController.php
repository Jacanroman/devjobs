<?php

namespace App\Http\Controllers;

use App\Models\Salario;
use App\Models\Vacante;
use App\Models\Categoria;
use App\Models\Ubicacion;
use App\Models\Experiencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VacanteController extends Controller
{
    /*
    public function __construct()
    {
        //Revisar que el usuario este autenticado y verificado
        $this->middleware(['auth','verified']);
    }
    */
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        //para recoger las vacante se puede hacer con el auth user
        $vacantes = auth()->user()->vacantes;
        
        */
        //otro metodo para hacer lo anterior es con el modelo
        $vacantes = Vacante::where('user_id', auth()->user()->id)->latest()->paginate(3);

        //dd($vacantes);
        return view('vacantes.index',compact('vacantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Consultas 
        //nos traemos todas las categorias usando el modelo Categoria
        $categorias = Categoria::all();
        $experiencias = Experiencia::all();
        $ubicaciones = Ubicacion::all();
        $salarios = Salario::all();
        
        return view('vacantes.create')
            //para a;adir a la vista la variable $categoria que tiene todas las categorias
            ->with('categorias', $categorias)
            ->with('experiencias', $experiencias)
            ->with('ubicaciones',$ubicaciones)
            ->with('salarios',$salarios);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validacion
        $data = $request->validate([
            'titulo'=> 'required|min:6',
            'categoria'=> 'required',
            'experiencia' => 'required',
            'ubicacion' => 'required',
            'salario' => 'required',
            'descripcion' => 'required|min:50',
            'imagen' => 'required',
            'skills' => 'required'
        ]);

        //Almacenar en la BD
        auth()->user()->vacantes()->create([
            'titulo' => $data['titulo'],
            'imagen' => $data['imagen'],
            'descripcion' => $data['descripcion'],
            'skills' => $data['skills'],
            'categoria_id' => $data['categoria'],
            'experiencia_id' => $data['experiencia'],
            'ubicacion_id' => $data['ubicacion'],
            'salario_id' => $data['salario'],
        ]);

        return redirect()->action('VacanteController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function show(Vacante $vacante)
    {
        //
        //if($vacante->activa === 0 ) return abort(404);
        return view('vacantes.show')->with('vacante', $vacante);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacante $vacante)
    {
        $this->authorize('view', $vacante);

        //Consultas 
        //nos traemos todas las categorias usando el modelo Categoria
        $categorias = Categoria::all();
        $experiencias = Experiencia::all();
        $ubicaciones = Ubicacion::all();
        $salarios = Salario::all();
        
        return view('vacantes.edit')
            //para a;adir a la vista la variable $categoria que tiene todas las categorias
            ->with('categorias', $categorias)
            ->with('experiencias', $experiencias)
            ->with('ubicaciones',$ubicaciones)
            ->with('salarios',$salarios)
            ->with('vacante', $vacante);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacante $vacante)
    {
        $this->authorize('update', $vacante);
        //
        //dd($request->all());

        //Validacion
        
        $data = $request->validate([
            'titulo'=> 'required|min:6',
            'categoria'=> 'required',
            'experiencia' => 'required',
            'ubicacion' => 'required',
            'salario' => 'required',
            'descripcion' => 'required|min:50',
            'imagen' => 'required',
            'skills' => 'required'
        ]);

        $vacante->titulo = $data['titulo'];
        $vacante->skills = $data['skills'];
        $vacante->imagen = $data['imagen'];
        $vacante->descripcion = $data['descripcion'];
        $vacante->categoria_id = $data['categoria'];
        $vacante->experiencia_id = $data['experiencia'];
        $vacante->ubicacion_id = $data['ubicacion'];
        $vacante->salario_id = $data['salario'];

        $vacante->save();

        //Redireccionar

        return redirect()->action('VacanteController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacante $vacante)
    {
        $this->authorize('delete', $vacante);
        //
        //return response()->json($vacante);

        $vacante->delete();

        return response()->json(['mensaje'=>'Se elimino la vacante '. $vacante->titulo]);
    }

    public function imagen(Request $request)
    {
        //return "subiendo imagen";
        $imagen = $request->file('file');
        //return $imagen;
        //para defenir el nombre unico lo renombramos con el timestamp
        $nombreImagen = time() . '.' . $imagen->extension();

        $imagen->move(public_path('storage/vacantes'), $nombreImagen);

        return response()->json(['correcto' => $nombreImagen]);
    }

    //Borrar imagen via Ajax
    public function borrarimagen(Request $request)
    {
        if($request->ajax()){
            $imagen = $request->get('imagen');

            if(File::exists('storage/vacantes/'. $imagen)){
                File::delete('storage/vacantes/'. $imagen);
            }

            return response('Imagen Eliminada',200);
        }
    }

    //Cambia el estado de una vacante
    public function estado(Request $request, Vacante $vacante)
    {
        //Leer nuevo estado y asiganrlo
        $vacante->activa = $request->estado;

        //Guardarlo en la BD
        $vacante->save();

        return response()->json(['respuesta' => 'correcto']);
    }

    public function buscar(Request $request)
    {
        //validar
        $data = $request->validate([
            'categoria' => 'required',
            'ubicacion' => 'required'
        ]);

        //Asignar valores
        $categoria = $data['categoria'];
        $ubicacion = $data['ubicacion'];

        $vacantes = Vacante::latest()
                    ->where('categoria_id', $categoria)
                    ->where('ubicacion_id', $ubicacion)
                    ->get();

        return view('buscar.index', compact('vacantes'));
    }

    public function resultados()
    {
        return "mostrando resultados";
    }
}
