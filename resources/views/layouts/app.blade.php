<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Olshop 2') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        {{-- Title Icon --}}
        <link rel="icon" href="{{ asset('/images/shopping-bags.png') }}" type="images/icon">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <link rel="stylesheet" href="{{ asset('icofont/icofont.min.css') }}">
        <style>
            body{
                background-size: cover;
                background-repeat: no-repeat;
                background-image: linear-gradient(rgba(255,165,0,0.5), rgba(255,0,0,0.5)), url("/images/background-olshop.jpg");
            }
        </style>

    <link rel="stylesheet" href="/dist/jquery.checkify.min.css">

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @guest
            <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                <a href="{{ route('dashboard') }}">
                                    <i class="icofont-shopify icofont-3x"></i>
                                </a>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <x-nav-link :href="route('product.index')" :active="request()->routeIs('product.index')">
                                    {{ __('Products') }}
                                </x-nav-link>
                            </div>
                        </div>
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="mx-2 text-blue-400">
                                <a class=" hover:text-blue-500" href="{{ route('login') }}">
                                    Login
                                </a>
                                <a class=" hover:text-blue-500" href="{{ route('register') }}">
                                    Register
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            @else
                @include('layouts.navigation')

            @endguest
            <div class="w-full px-5 bg-white">
                <form action="{{ route('search.product') }}" method="GET">
                    @csrf
                    <input type="text" name="name" id="" class="w-4/5">
                    <button type="submit" class="bg-blue-500 w-1/6 hover:bg-blue-400 rounded text-white px-4 py-2">Search</button>
                </form>
            </div>
            <!-- Page Heading -->
            <x-session></x-session>
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <footer>
            <div class="bg-red-100 text-center py-5">
                &copy; Randy Steven {{ date('Y') == 2021 ? date('Y') : "2021"."-".date('Y') }}            </div>
        </footer>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="/js/jquery.jscroll.min.js"></script>

        <script type="text/javascript">
            $('ul.pagination').hide();
            $(function() {
                $('.scrolling-pagination').jscroll({
                    autoTrigger: true,
                    padding: 0,
                    nextSelector: '.pagination li.active + li a',
                    contentSelector: 'div.scrolling-pagination',
                    callback: function() {
                        $('ul.pagination').remove();
                    }
                });
            });
        </script>

    </body>
</html>
