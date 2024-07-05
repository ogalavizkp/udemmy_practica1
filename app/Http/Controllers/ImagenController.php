<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImagenController extends Controller
{
   public function store(Request $request) {

    $manager = new ImageManager(new Driver());
    
    $imagen = $request->file('file');
    
    $nameimagen = Str::uuid() . "." . $imagen->extension();

    $imagenServidor = $manager->read($imagen);
    $imagenServidor->scale(1000,1000);

    $imagenPath = public_path('uploads') . '/' . $nameimagen;
    $imagenServidor->save($imagenPath);


    return response()->json(['imagen' => $nameimagen ]);
    
    }
}
