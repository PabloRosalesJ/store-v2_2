<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Store</title>
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <!-- Styles -->
    @yield('extra_css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

</head>

<body>
    <div id="app">
        <!-- [ Pre-loader ] start -->
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>
        
        @include('layouts.includes.menu')
        
        @include('layouts.includes.header')
        
        <div class="pcoded-main-container">
            <div class="pcoded-content">
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <router-link to="/"><i class="feather icon-home"></i></router-link>
                            </li>
                            {{-- <li class="breadcrumb-item"></li> --}}
                        </ul>
                    </div>
                    </div>
                </div>
                {{-- <div class="row"> --}}
                    {{-- <div class="col-sm-12"> --}}
                        <router-view></router-view>
                    {{-- </div> --}}
                {{-- </div> --}}
            </div>
        </div>
        
    </div>

    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="{{ asset('js/scripts.js') }}" ></script>

    <script src="{{ asset('js/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables.bootstrap4.min.js') }}"></script>
    
    @yield('extra_js')

    <script>
        // setTimeout(function(){ 
        //     // $("#client-table").DataTable();
        // }, 3000);
       
    </script>
    
</body>

</html>