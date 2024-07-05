@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class=" md:flex md:justify-center ">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form method="POST" action="{{ route('perfil.store') }}" enctype="multipart/form-data" class="mt-10 md:mt-0 ">
                @csrf
                <div class='mb-5'>
                    <label for='name' class='mb-2 block uppercase text-gray-500 font-bold'>Username</label>
                    <input 
                        id='username'
                        name='username'
                        type='text'
                        placeholder='Tu username'
                        value="{{ auth()->user()->username }}"
                    class='border p-3 w-full rounded-lg  @error('username') border-red-500  @enderror' />

                    @error('username')
                        <p class='bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center' >{{ $message }}</p>
                    @enderror
                    <!-- git clone https://github.com/MarcoGomesr/laravel-validation-en-espanol.git resources/lang -->
                </div>

                <div class='mb-5'>
                    <label for='imagen' class='mb-2 block uppercase text-gray-500 font-bold'>Imagen</label>
                    <input 
                        id='imangen'
                        name='imagen'
                        type='file'
                        accept=".jpg, .jpeg, .png"
                    class='border p-3 w-full rounded-lg' />

                    <!-- git clone https://github.com/MarcoGomesr/laravel-validation-en-espanol.git resources/lang -->
                </div>

                <input 
                type='submit'
                value='Guardar cambios'
                class='bg-sky-600 hover:bg-sky-800 font-bold transition-color cursor-pointer w-full text-white p-3 uppercase rounded-lg'
            />



            </form>
        </div>
    </div>
@endsection