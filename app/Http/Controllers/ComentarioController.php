<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post) 
    {

        $request->validate([
            'comentario'=>'required|max:255'
        ]);

        $comentario = new Comentario;
        $comentario->comentario = $request->comentario;
        $comentario->post_id = $post->id;
        $comentario->user_id = auth()->user()->id;
        $comentario->save();

        return back()->with('mensaje', 'vomentario realizado correcto');

        /*
        $request->comentario()->create([
            'user_id'=> auth()->user()->id,
            'post_id'=> $request->post_id,
            'comentario'=> $request->comentario
        ]);
        */
    }
}
