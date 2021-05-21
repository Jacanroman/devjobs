<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    //
    public function show(Categoria $categoria)
    {
        $vacantes = Vacante::where('categoria_id', $categoria->id)->where('activa',true)->paginate(2);
        
        //dd($vacantes);
        
        return view('categorias.show', compact('vacantes', 'categoria'));
    }
}
