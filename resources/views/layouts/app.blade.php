<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Attraction Management</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://js.pusher.com/8.2/pusher.min.js"></script>

    </head>
    <body class="antialiased">
        <nav>
            <div class="">
              <div class="flex justify-between h-16 px-10 shadow items-center">
                <div class="flex items-center space-x-8">
                  <h1 class="text-xl lg:text-2xl font-bold cursor-pointer">Attraction Management</h1>
                  <div class="hidden md:flex justify-around space-x-4">
                    <a href="/" class="hover:text-blue-600 text-gray-700">Home</a>
                  </div>
                </div>
                @if(Auth::user())
                    <div class="flex space-x-4 items-center">
                        <a href="#" class="bg-blue-600 px-4 py-2 rounded text-white hover:bg-blue-500 text-sm"
                        onclick="event.preventDefault();
                        document.getElementById('frm-logout').submit();">LOGOUT</a>
                    </div>
                @else
                    <div class="flex space-x-4 items-center">
                        <a href="#" class="text-gray-800 text-sm">LOGIN</a>
                        <a href="#" class="bg-blue-600 px-4 py-2 rounded text-white hover:bg-blue-500 text-sm">SIGNUP</a>
                    </div>
                @endif                
              </div>
            </div>
            <form id="frm-logout" action="{{ route('logout') }}" method="POST"
                style="display:none;">
                {{ csrf_field() }}
            </form> 
        </nav>
        
        <!-- Alerts end -->
        <div class="relative">
            <!--Alerts-->
            <div>
                @if (session('success'))
                    <div class="mt-3 flex justify-center" id="success-alert">
                        <div class="bg-green-200 text-green-800 px-4 py-2 rounded-md text-lg flex items-center mx-auto w-3/4 xl:w-2/4">
                            <span class="mx-auto"><i class='bx bxs-check-circle mr-2'></i> {!! session('success') !!}</span>
                            <button class="ml-4 text-green-900 hover:text-green-600 close-alert">
                                <i class="bx bx-x text-2xl"></i>
                            </button>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="flex justify-center" id="error-alert">
                        <div class="bg-red-200 text-red-800 px-4 py-2 rounded-md text-lg flex items-center mx-auto w-3/4 xl:w-2/4">
                            <span class="mx-auto"><i class='bx bxs-x-circle mr-2'></i> {!! session('error') !!}</span>
                            <button class="ml-4 text-red-800 hover:text-red-600 close-alert">
                                <i class="bx bx-x text-2xl"></i>
                            </button>
                        </div>
                    </div>
                @endif

                @if (session('warning'))
                    <div class="flex justify-center" id="warning-alert">
                        <div class="bg-orange-200 text-yellow-600 px-4 py-2 rounded-md text-lg flex items-center mx-auto w-3/4 xl:w-2/4">
                            <span class="mx-auto"><i class='bx bxs-error mr-2'></i> {!! session('warning') !!}</span>
                            <button class="ml-4 text-yellow-600 hover:text-yellow-500 close-alert">
                                <i class="bx bx-x text-2xl"></i>
                            </button>
                        </div>
                    </div>
                @endif

                @if (session('info'))
                    <div class="flex justify-center" id="info-alert">
                        <div class="bg-blue-200 text-blue-600 px-4 py-2 rounded-md text-lg flex items-center mx-auto w-3/4 xl:w-2/4">
                            <span class="mx-auto"><i class='bx bxs-error mr-2'></i> {!! session('info') !!}</span>
                            <button class="ml-4 text-blue-600 hover:text-blue-500 close-alert">
                                <i class="bx bx-x text-2xl"></i>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
            <!-- Content -->
            @yield('content')
            
            <!-- End Content -->
        </div>

        @yield('scripts')

        <script>
            $(document).ready(function() {
                // Automatically hide alerts after 7 seconds
                setTimeout(function() {
                    $('.close-alert').trigger('click'); 
                }, 7000);
        
                // Close alert on button click
                $('.close-alert').on('click', function() {
                    $(this).parent().parent().fadeOut('fast'); 
                });
            });
        </script>
    </body>
</html>
