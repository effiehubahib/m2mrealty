<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@hasSection('title') @yield('title') - m2m Realty @else m2m Realty &amp; Brokerage — Luxury Living @endif</title>
  <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <style>
    body { font-family: 'Inter', system-ui, sans-serif; }
    /* Hide scrollbar on horizontal scrollers */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
  </style>
</head>
<body class="bg-slate-50 text-slate-800">
    <header>
        @include('partials.navbar')
    </header>
        <main>
        @yield('content')
    </main>
    <footer>
        @include('partials.footer')
    </footer>
    
</body>
</html>