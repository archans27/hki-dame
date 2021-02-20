<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">

        
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
        
    </head>
    <body class="font-sans antialiased" id="body">
        <div class="min-h-screen bg-gray-100">
            <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
            <div class="md:flex flex-col md:flex-row md:min-h-screen w-full">
                @include('layouts.navigation')

                <div class="w-full">
                    <!-- Page Heading -->
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                    <!-- Page Content -->
                    <main>
                        {{ $slot }}
                    </main>


                </div>
                <div class="clear-both"></div>

            </div>
            <section class=" mx-auto text-left py-3 bg-gray-300 object-bottom clear-both">
                <div class="flex flex-wrap text-gray-700">
                  <div class="w-full text-center">
                    <p class="text-xl bold">HKI Dame</p> 
                    <p>Alamat: Jl. Soekarno-Hatta No.543, Gumuruh,<br />
                      Kec. Batununggal, Kota Bandung,Jawa Barat 40275</p>
                      <span class="material-icons cursor-pointer hover:text-blue-500 align-middle">phone</span> (022) 611-2030
                      <span class="material-icons cursor-pointer hover:text-blue-500 align-middle">mail</span> hkidame@mail.com
                  </div>
                </div>
              </section>

        </div>
    </body>
</html>
