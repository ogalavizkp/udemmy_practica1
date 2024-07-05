<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;


class PerfilController extends Controller
{
    

    /*
    public static function middleware(): array 
    {
        return [
            'auth',
             new Middleware('subscribed', except: ['show', 'index'])
        ];
    }
    */

    public function index() {
        return view('perfil.index');

    }

    public function store(Request $request) 
    {
        $request->request->add(['username'=> Str::slug($request->username)]);
        $request->validate([
            'username'=>'required|unique:users,username,'.auth()->user()->id.'|min:6|max:16|not_in:twitter,editar_perfil'        
        ]);

        
        if($request->imagen)
        {

            $imagen = $request->file('imagen');
    
            $nameimagen = Str::uuid() . "." . $imagen->extension();
    
            $imagenServidor = ImageManager::imagick()->read($imagen);

            $imagenServidor->resize(1000,1000);
        
            $imagenPath = public_path('profiles/') . '/' . $nameimagen;

            $imagenServidor->save($imagenPath);

        
        }

        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nameimagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        return redirect()->route('posts.index', $usuario->username );
    }
}
