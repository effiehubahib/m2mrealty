<div class="w-full bg-white border-b border-slate-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">

        <a href="{{ route('home') }}" class="flex items-center gap shrink-0" aria-label="m2m Realty & Brokerage Home">
          <img src="{{ asset('images/logo/m2m-logo.svg') }}" alt="m2m logo" class="h-14 w-14 shrink-0" aria-hidden="true">
          <span class="flex flex-col leading-none sm:hidden text-cyan-500 font-bold tracking-[0.12em] text-[14px] uppercase">
            <span>REALTY &amp;</span>
            <span class="mt-0.5">BROKERAGE</span>
          </span>
          <span class="hidden sm:inline text-cyan-500 font-bold text-xl tracking-[0.18em]">REALTY&amp;BROKERAGE</span>
        </a>

        {{-- Desktop Nav --}}
        <nav class="hidden xl:flex items-center gap-8" aria-label="Primary">

          @php
            $navLinks = [
              ['route' => 'properties',   'label' => 'Properties'],
              ['route' => 'developers.index',  'label' => 'Developers'],
              ['route' => 'about',         'label' => 'About'],
              ['route' => 'contact',       'label' => 'Contact'],
            ];
          @endphp

          @foreach ($navLinks as $link)
            @php $active = request()->routeIs($link['route']); @endphp
            <a href="{{ route($link['route']) }}"
               class="relative font-medium text-[15px] pb-1 transition-colors
                      after:content-[''] after:absolute after:left-0 after:right-0 after:-bottom-0.5
                      after:h-0.5 after:rounded-full after:transition-all after:duration-300
                      {{ $active
                          ? 'text-cyan-500 after:bg-cyan-500 after:scale-x-100'
                          : 'text-slate-700 hover:text-cyan-500 after:bg-cyan-500 after:scale-x-0 hover:after:scale-x-100' }}"
               {{ $active ? 'aria-current=page' : '' }}>
              {{ $link['label'] }}
            </a>
          @endforeach

        </nav>

        {{-- Right Actions --}}
        <div class="flex items-center gap-3 sm:gap-5">
          <button type="button" aria-label="Saved properties" class="p-2 text-slate-600 hover:text-cyan-500 transition-colors">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
          </button>
          <button type="button" aria-label="Notifications" class="relative p-2 text-slate-600 hover:text-cyan-500 transition-colors">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
              <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
          </button>
          <a href="{{ route('login') }}" class="hidden md:inline-flex items-center justify-center bg-cyan-500 hover:bg-cyan-600 text-white font-medium text-[15px] px-5 py-2.5 rounded-md shadow-sm transition-colors">Login</a>

          <button
            type="button"
            id="mobile-menu-btn"
            aria-label="Open menu"
            aria-expanded="false"
            aria-controls="mobile-menu"
            class="xl:hidden p-2 text-slate-700 hover:text-cyan-500 transition-colors"
          >
            <svg id="icon-open" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <line x1="3" y1="6" x2="21" y2="6"/>
              <line x1="3" y1="12" x2="21" y2="12"/>
              <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
            <svg id="icon-close" class="h-6 w-6 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <line x1="18" y1="6" x2="6" y2="18"/>
              <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
          </button>
        </div>

      </div>
    </div>

    {{-- Mobile Menu Drawer --}}
    <div
      id="mobile-menu"
      class="xl:hidden hidden border-t border-slate-100 bg-white"
      aria-label="Mobile navigation"
    >
      <nav class="flex flex-col px-6 py-4 gap-1">

        @foreach ($navLinks as $link)
          @php $active = request()->routeIs($link['route']); @endphp
          <a href="{{ route($link['route']) }}"
             class="font-medium text-[15px] py-3 border-b border-slate-100 transition-colors
                    {{ $active ? 'text-cyan-500' : 'text-slate-700 hover:text-cyan-500' }}"
             {{ $active ? 'aria-current=page' : '' }}>
            {{ $link['label'] }}
          </a>
        @endforeach

        <a href="{{ route('login') }}" class="mt-3 inline-flex items-center justify-center bg-cyan-500 hover:bg-cyan-600 text-white font-medium text-[15px] px-5 py-2.5 rounded-md shadow-sm transition-colors">Login</a>
      </nav>
    </div>
</div>

<script>
  (function () {
    const btn       = document.getElementById('mobile-menu-btn');
    const menu      = document.getElementById('mobile-menu');
    const iconOpen  = document.getElementById('icon-open');
    const iconClose = document.getElementById('icon-close');

    function openMenu() {
      menu.classList.remove('hidden');
      iconOpen.classList.add('hidden');
      iconClose.classList.remove('hidden');
      btn.setAttribute('aria-expanded', 'true');
      btn.setAttribute('aria-label', 'Close menu');
    }

    function closeMenu() {
      menu.classList.add('hidden');
      iconOpen.classList.remove('hidden');
      iconClose.classList.add('hidden');
      btn.setAttribute('aria-expanded', 'false');
      btn.setAttribute('aria-label', 'Open menu');
    }

    btn.addEventListener('click', function () {
      menu.classList.contains('hidden') ? openMenu() : closeMenu();
    });

    menu.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', closeMenu);
    });
  })();
</script>