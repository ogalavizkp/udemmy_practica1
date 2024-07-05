<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public static function middleware(): array 
    {
        return [
            'auth',
             new Middleware('subscribed', except: ['show', 'index'])
        ];
    }


    public function index(User $user, Post $post) 
    {
        //$posts = Post::where('user_id',$user->id)->get();
        //cuando queremos paginar remplazamos get() por paginate()
        $posts = Post::where('user_id',$user->id)->paginate(5);
        return view('layouts.dashboard', ['user'=>$user, 'posts'=>$posts]);
    }

    public function create() {
        return view('posts.create');
    }

    public function show(User $user, Post $post) {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }
    public function store(Request $request) {
        $request->validate([
            'titulo'=>'required|max:155',
            'description'=>'required|max:255',
            'imagen'=>'required',
        ]);

        /*
        Post::create([
            'titulo' => $request->titulo,
            'description'=> $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);
        */

        /*
        $post = new Post;
        $post->titulo = $request->titulo;
        $post->description = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id
        $post->save();
        */

        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'description'=> $request->description,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);


    }

    public function destroy(Post $post) {
        Gate::allows('delete', $post);
        $post->delete();

        //bprrar imagen

        $imagen_path = public_path('uploads/' . $post->imagen);

        if(File::exists($imagen_path))
        {
            unlink($imagen_path);
        }


        return redirect()->route('posts.index', auth()->user()->username );
        

    }
}
