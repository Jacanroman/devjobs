@extends('layouts.app')

@section('navegacion')
    @include('ui.adminnav')
@endsection

@section('content')
    <h1 class="text-2xl text-center mt-10">Nuevas Notificaciones</h1>

    @if(count($notificaciones)>0)

        <ul class="max-w-md mx-auto mt-10">
            @foreach($notificaciones as $notificacion)
                @php
                    $data = $notificacion->data;
                @endphp

                <li class="p-5 border border-gray-400 mb-5">
                    <p class="mb-4">
                        Tienes un nuevo candidato en: 
                        <span class="font-bold">{{$data['vacante']}}</span>
                    </p>
                </li>
                
            @endforeach
        </ul>

    @else
        <p class="text-center mt-5">No hay Nuevas Notificaciones</p>

    @endif

    @if(count($notificacionesant)>0)

        <h1 class="text-2xl text-center mt-10">Notificaciones Anteriores</h1>
        
        <ul class="max-w-md mx-auto mt-10">
            @foreach($notificacionesant as $notificaciona)
                @php
                    $data = $notificaciona->data;
                @endphp

                <li class="p-5 border border-gray-400 mb-5">
                    <p class="mb-4">
                        Tienes un nuevo candidato en: 
                        <span class="font-bold">{{$data['vacante']}}</span>
                    </p>
                </li>
                
            @endforeach
        </ul>
        
    @endif
@endsection