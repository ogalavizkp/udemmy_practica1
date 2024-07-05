<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @stack('styles')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>Laravel @yield('titulo')</title>
    </head>
    <body class="bg-gray-100">
       <header class="p-5 border-b bg-white shadow"  >
            <div class="container mx-auto flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-3xl font-black">DevOmarGalaviz</a>
             

                @auth
                <nav class="flex gap-2 items-center">

                    <a class='text-sm flex items-center rounded uppercase gap-2 text-gray-600 p-2 bg-white border cursor-pointers font-bold ' 
                        href='{{ route('posts.create') }}' 
                    >
                        
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                          </svg>
                          

                        Crear
                    </a>
                    <a href='{{ route('posts.index', auth()->user()->username ) }}'>
                    <p>Hola, {{ auth()->user()->username }}</p>
                    </a>
                    <form action="{{ route('logout') }} " method='POST' >
                        @csrf
                    <button type='submit'  class="font-bold text-gray-600 text-sm" >cerrar session</button>
                    </form>                    
                </nav>
                @endauth

                @guest
                    
                <nav class="flex gap-2 items-center">
                    <a class="font-bold uppercase text-gray-600 text-sm" href='{{ @route("login") }}'>Login</a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href='{{ @route("registrar") }}'>Crear Cuenta</a>                    
                </nav>
                @endguest


            </div>
       </header>

       <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">
                @yield("titulo")
            </h2>
            @yield("contenido")
       </main>  

       <footer class="text-center p-5 text-gray-600 font-bold uppercase">
            Todos los derechos reservados {{ now()->year }}
       </footer>
       @stack('scripts')
    </body>
</html>
