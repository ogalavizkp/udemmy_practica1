@extends('layouts.app')


@section('titulo')
    Crear posts
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />   
@endpush

@section('contenido')
    <div class='md:flex md:items-center'>
        <div class='md:w-1/2 px-10'>
        
            
            <form method='POST' enctype="multipart/form-data" action='{{ route('imagenes.store') }}' id='dropzone' class='dropzone justify-center text-center border-dashed  border-2 w-full h-96 flex rounded flex-col'>
                
                @csrf
            </form>
        </div> 

        <div class='md:w-1/2 px-10  bg-white p-10 rounded-lg shadow mt-10 md:mt-0'>
            <form action='{{ @route("posts.store") }}' method="post">
                @csrf
                <div class='mb-5'>
                    <label for='titulo' class='mb-2 block uppercase text-gray-500 font-bold'>Titulo</label>
                    <input 
                        id='titulo'
                        name='titulo'
                        type='text'
                        placeholder='Tu titulo post'
                        value="{{ old('titulo') }}"
                    class='border p-3 w-full rounded-lg  @error('titulo') border-red-500  @enderror' />

                    @error('titulo')
                        <p class='bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center' >{{ $message }}</p>
                    @enderror
                    <!-- git clone https://github.com/MarcoGomesr/laravel-validation-en-espanol.git resources/lang -->
                </div>


                <div class='mb-5'>
                    <label for='description' class='mb-2 block uppercase text-gray-500 font-bold'>description</label>
                    <textarea
                        id='description'
                        name='description'
                        type='text'
                    class='border p-3 w-full rounded-lg  @error('description') border-red-500  @enderror' />
                    {{ old('description') }}
                </textarea>
                    @error('description')
                        <p class='bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center' >{{ $message }}</p>
                    @enderror
                    <!-- git clone https://github.com/MarcoGomesr/laravel-validation-en-espanol.git resources/lang -->
                </div>

                <div class='mb-5'>
                    <input
                        type='hidden'
                        name='imagen' 
                        value="{{ old('imagen') }}"
                    />
                    @error('imagen')
                    <p class='bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center' >{{ $message }}</p>
                @enderror
                </div>
                <input 
                type='submit'
                value='Crear publicacion'
                class='bg-sky-600 hover:bg-sky-800 font-bold transition-color cursor-pointer w-full text-white p-3 uppercase rounded-lg'
            />

            </form>
            </div> 
    </div>

@endsection
