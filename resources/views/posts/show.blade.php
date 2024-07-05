@extends('layouts.app')


@section('titulo')
    {{ $post->titulo }}
@endsection


@section('contenido')
    <div class="container mx-auto flex">
        <div class="md:w-1/2 ">
            <img src="{{ asset('uploads') .'/'. $post->imagen }}" alt="Imagen del post {{ $post->titulo }}" />
        
            <div class='p-3 text-center flex gap-4'>

                @auth
                @if( $post->checkLike(auth()->user() ))
                <form method="POST" action="{{ route('posts.likes.destroy', $post) }}">
                    @method('DELETE')
                    @csrf
                    <div class=" m-4">
                        <button type="submit"> <span class=" text-red-600">corazon-red</span> </button>
                    </div>
                </form>
               
                @else

                    <form method="post" action="{{ route('posts.likes.store', $post) }}">
                        @csrf
                        <div class=" m-4">
                            <button type="submit"> corazon </button>
                        </div>
                    </form>
                    
                    
                    
                    
                    
                    @endif
                    @endauth


                <p>{{ $post->likes->count() }} likes</p>
            </div>

            <div>
                <p class='font-bold'>
                    {{ $post->user->username }}
                </p>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>

                <p class="mt-5">
                    {{ $post->description }}
                </p>

                @auth
                    @if( $post->user_id == auth()->user()->id) 
                        <div>
                            <form action='{{ route('posts.destroy', $post) }}' method="post" >
                                @method('DELETE')
                                @csrf
                                
                                <input type="submit" value="Eliminar publciacion" class=" bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer" 
                                />
                            </form>
                        </div>
                    @endif

                @endauth
            </div>
        </div>

        <div class="md:w-1/2 p-5">

            <div class="shadow bg-white p-5 mb-5">   
            @auth

            <p class="text-xl font-bold text-center mb-4">agrega un nuevo comentario</p>

            @if(session('mensaje'))
                <div class="bg-green-500 p-2 rounded-lg mb-6 text-white uppercase font-bold">
                    {{ session('mensaje') }}
                </div>
            @endif

            <form action='{{ route('comentarios.store', ['post'=>$post, 'user'=>$user]) }}' method="post">
                @csrf

                <div class='mb-5'>
                    <label for='description' class='mb-2 block uppercase text-gray-500 font-bold'>A;ade un comentario</label>
                    <textarea
                        id='comentario'
                        name='comentario'
                        type='text'
                    class='border p-3 w-full rounded-lg  @error('comentario') border-red-500  @enderror' />
                    {{ old('comentario') }}
                </textarea>
                    @error('comentario')
                        <p class='bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center' >{{ $message }}</p>
                    @enderror
                    <!-- git clone https://github.com/MarcoGomesr/laravel-validation-en-espanol.git resources/lang -->
                </div>

                <input 
                type='submit'
                value='Crear comentario'
                class='bg-sky-600 hover:bg-sky-800 font-bold transition-color cursor-pointer w-full text-white p-3 uppercase rounded-lg'
            />

            </form>

            @endauth

            <div class=" bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                @if($post->comentarios->count())
                    @foreach ($post->comentarios as $comentario)
                        <div class=" p-5 border-gray-300 border-b">
                                    <a href='{{ @route('posts.index', $comentario->user ) }}'>
                                        {{ $comentario->user->username }}
                                    </a>
                                    <p>{{ $comentario->comentario }}</p>
                                    <p class=' text-gray-500 text-sm' >{{ $comentario->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach
                @else
                     <p class=" p-10 text-center"> No hay comentarios</p>
                @endif
            </div>
            
        </div>
        </div>
    </div>
@endsection