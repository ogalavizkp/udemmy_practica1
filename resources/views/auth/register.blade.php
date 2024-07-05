@extends('layouts.app')

@section('titulo')
    Registrate en DevOmarGalaviz
@endsection

@section("contenido")
    <div class='md:flex md:justify-center  md:gap-10 md:items-center'>
        <div class='md:w-4/12 p-5'>
            <img src="{{ asset('img/register.png') }}" />
        </div>

        <div class='md:w-4/12 bg-white p-6 rounded-lg shadow'>
            <form action='{{ @route("registrar") }}' method="post">
                @csrf
                <div class='mb-5'>
                    <label for='name' class='mb-2 block uppercase text-gray-500 font-bold'>Nombre</label>
                    <input 
                        id='name'
                        name='name'
                        type='text'
                        placeholder='Tu nombre'
                        value="{{ old('name') }}"
                    class='border p-3 w-full rounded-lg  @error('name') border-red-500  @enderror' />

                    @error('name')
                        <p class='bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center' >{{ $message }}</p>
                    @enderror
                    <!-- git clone https://github.com/MarcoGomesr/laravel-validation-en-espanol.git resources/lang -->
                </div>



                <div class='mb-5'>
                    <label for='username' class='mb-2 block uppercase text-gray-500 font-bold'>Username</label>
                    <input 
                        id='username'
                        name='username'
                        type='text'
                        placeholder='Tu username' 
                        value="{{ old('username') }}"
                        class='border p-3 w-full rounded-lg  @error('username') border-red-500  @enderror' >

                    @error('username')
                    <p class='bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center' >{{ $message }}</p>
                @enderror
                </div>

                <div class='mb-5'>
                    <label for='email' class='mb-2 block uppercase text-gray-500 font-bold'>Email</label>
                    <input 
                        id='email'
                        name='email'
                        type='email'
                        placeholder='Tu email de registro' 
                        value="{{ old('email') }}"
                        class='border p-3 w-full rounded-lg  @error('email') border-red-500  @enderror'  >

                    @error('email')
                    <p class='bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center' >{{ $message }}</p>
                @enderror
                </div>
                

                <div class='mb-5'>
                    <label for='password' class='mb-2 block uppercase text-gray-500 font-bold'>´assword</label>
                    <input 
                        id='password'
                        name='password'
                        type='password'
                        placeholder='Tu password de registro'
                        class='border p-3 w-full rounded-lg  @error('password') border-red-500  @enderror'  >

                    @error('password')
                    <p class='bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center' >{{ $message }}</p>
                @enderror
                </div>

                <div class='mb-5'>
                    <label for='password_confirmation' class='mb-2 block uppercase text-gray-500 font-bold'>Password  Confirmation</label>
                    <input 
                        id='password_confirmation'
                        name='password_confirmation'
                        type='password'
                        placeholder='Repite tu password'
                    class='border p-3 w-full rounded-lg ' >
                </div>

                <input 
                    type='submit'
                    value='Crear Cuenta'
                    class='bg-sky-600 hover:bg-sky-800 font-bold transition-color cursor-pointer w-full text-white p-3 uppercase rounded-lg'
                />
            </form>
        </div>
    </div>
@endsection