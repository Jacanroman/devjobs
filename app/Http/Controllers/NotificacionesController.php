<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
        $notificaciones = auth()->user()->unreadNotifications;
        $notificacionesant = auth()->user()->notifications;

        auth()->user()->unreadNotifications->markAsRead();

        return view('notificaciones.index', compact(['notificaciones','notificacionesant']));
    }
}
