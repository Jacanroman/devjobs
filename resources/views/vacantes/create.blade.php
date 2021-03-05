@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/medium-editor@5.23.2/dist/css/medium-editor.min.css" type="text/css" media="screen" charset="utf-8">
@endsection

@section('navegacion')
    @include('ui.adminnav')
@endsection

@section('content')
    <h1 class="text-2xl text-center mt-10">Nueva Vacante</h1>

    <form class="max-w-lg mx-auto my-10">
        <div class="mb-5">
            <label for="titulo" 
            class="block text-gray-700 text-sm mb-2">
            Titulo Vacante: 
            </label>

            <input 
                id="titulo" 
                type="text" 
                class="p-3 bg-white rounded form-input w-full @error('password') is-invalid @enderror" 
                name="titulo"/>
        </div>

        <div class="mb-5">
            <label for="categoria" 
            class="block text-gray-700 text-sm mb-2">
            Categoria: 
            </label>

            <select
                id="categoria"
                class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:border-gray-500 p-3 bg-gray-100"
                name="categoria"
            >
                <option disabled selected>- Seleccion -</option>

                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}">
                        {{$categoria->nombre}}
                    </option>
                    
                @endforeach
            </select>

        </div>

        {{--$categorias--}}


        <div class="mb-5">
            <label for="experiencia" 
            class="block text-gray-700 text-sm mb-2">
            Experiencia: 
            </label>

            <select
                id="experiencia"
                class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:border-gray-500 p-3 bg-gray-100"
                name="experiencia"
            >
                <option disabled selected>- Seleccion -</option>

                @foreach($experiencias as $experiencia)
                    <option value="{{$experiencia->id}}">
                        {{$experiencia->nombre}}
                    </option>
                    
                @endforeach
            </select>

        </div>

        {{--$experiencias--}}

        <div class="mb-5">
            <label for="ubicacion" 
            class="block text-gray-700 text-sm mb-2">
            Ubicacion: 
            </label>

            <select
                id="ubicacion"
                class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:border-gray-500 p-3 bg-gray-100"
                name="ubicacion"
            >
                <option disabled selected>- Seleccion -</option>

                @foreach($ubicaciones as $ubicacion)
                    <option value="{{$ubicacion->id}}">
                        {{$ubicacion->nombre}}
                    </option>
                    
                @endforeach
            </select>

        </div>

        {{--$ubicaciones--}}


        <div class="mb-5">
            <label for="salario" 
            class="block text-gray-700 text-sm mb-2">
            salario: 
            </label>

            <select
                id="salario"
                class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:border-gray-500 p-3 bg-gray-100"
                name="salario"
            >
                <option disabled selected>- Seleccion -</option>

                @foreach($salarios as $salario)
                    <option value="{{$salario->id}}">
                        {{$salario->nombre}}
                    </option>
                    
                @endforeach
            </select>

        </div>

        {{--$salarios--}}

        <div class="mb-5">
            <label for="salario" 
            class="block text-gray-700 text-sm mb-2">
            Descripcion del puesto: 
            </label>

            {{--parar instanciar usamos div class="--}}
            <div class="editable"></div>

        </div>
        
        <button
            type="submit"
            class="bg-blue-500 w-full hover:bg-blue-600 text-gray-100 font-bold p-3 focus:outline focus:shadow-outline uppercase"
            >Publicar Vacante</button>
    </form>
@endsection

@section('scripts')
   
    <script src="https://cdn.jsdelivr.net/npm/medium-editor@5.23.2/dist/js/medium-editor.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', ()=>{
            const editor = new MediumEditor('.editable');
        })
    </script>


@endsection