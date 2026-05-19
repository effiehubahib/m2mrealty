<!DOCTYPE html>
<html lang="en" class="">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta name="csrf-token" content="{{csrf_token()}}"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ config('app.name') }} - Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="{{asset('assets/css/slick.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/aos.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/output.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />
    @stack('header-css')
    @stack('header-scripts')
    
  </head>
  <body>
    <!-- layout start -->
    <div class="layout-wrapper active w-full">
      <div class="relative flex w-full">
        @include('layouts.admin-open-navigation')
        @include('layouts.admin-close-navigation')
        <div class="body-wrapper flex-1 overflow-x-hidden dark:bg-darkblack-400">
          @include('layouts.header-layout')
          <main class="min-h-screen w-full px-6 pb-6 pt-[100px] sm:pt-[156px] xl:px-12 xl:pb-12">
             @yield('content')
          </main>
        </div>
      </div>
    </div>

    <!-- layout end -->
    <!--scripts -->
    
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    {{--<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>--}}
    
    <script src="{{asset('assets/js/main.js')}}"></script>
    
    
    @stack('footer-scripts')
    
  </body>
</html>
