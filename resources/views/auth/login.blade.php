@extends('layouts.app')

@section('titulo')
    Login en DevOmarGalaviz
@endsection

@section("contenido")
    <div class='md:flex md:justify-center  md:gap-10 md:items-center'>
        <div class='md:w-4/12 p-5'>
            <img src="{{ asset('img/login.png') }}" alt='Imagen de Login' />
        </div>

        <div class='md:w-4/12 bg-white p-6 rounded-lg shadow'>
            <form action='{{ @route("login") }}' method="POST">
                @csrf

                @if (session('mensaje'))    
                    <p class='bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center' >{{ session('mensaje') }}</p>
                @endif


       

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


                <input 
                    type='submit'
                    value='Login Cuenta'
                    class='bg-sky-600 hover:bg-sky-800 font-bold transition-color cursor-pointer w-full text-white p-3 uppercase rounded-lg'
                />

                <input type='checkbox' name='remember' /><label class='  text-gray-500 text-sm' > mantener mi sesion abierta</label>
            </form>
        </div>
    </div>
@endsection