<!-- ============ FOOTER ============ -->
<footer class="relative text-slate-300 overflow-hidden bg-[#0b1628]"
        style="background: linear-gradient(135deg, #0a1628 0%, #0d1f3c 40%, #0f2a4a 60%, #102a4a 100%);">

  {{-- Base dark-to-blue gradient layer --}}
  {{-- <div class="pointer-events-none absolute inset-0"
       style="background: linear-gradient(to right, #0b1a2e 0%, #0e2444 50%, #1a3a6b 100%);"></div> --}}

  {{-- Bright cyan-blue glowing orb — center-right, matching screenshot --}}
  <div class="pointer-events-none absolute"
       style="
         width: 420px;
         height: 420px;
         right: 12%;
         top: 80%;
         transform: translateY(-50%);
         border-radius: 50%;
         background: radial-gradient(circle, rgba(56,189,248,0.55) 0%, rgba(14,165,233,0.30) 30%, rgba(2,132,199,0.10) 60%, transparent 75%);
         filter: blur(40px);
       ">
  </div>

  {{-- Subtle secondary orb for depth --}}
  <div class="pointer-events-none absolute"
       style="
         width: 250px;
         height: 250px;
         right: 19%;
         top: 80%;
         transform: translateY(-50%);
         border-radius: 50%;
         background: radial-gradient(circle, rgba(125,211,252,0.35) 0%, transparent 65%);
         filter: blur(20px);
       ">
  </div>

  <div class="relative max-w-7xl mx-auto px-6 lg:px-8 py-10">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

      <!-- Logo + copyright -->
      <div class="flex flex-col gap-2">
        <a href="{{ route('home') }}" class="flex items-center gap-2" aria-label="m2m Realty & Brokerage Home">
          <img src="{{ asset('images/logo/m2m-logo.svg') }}" alt="m2m logo" class="h-14 w-14 shrink-0" aria-hidden="true">
          <span class="text-cyan-400 font-bold text-base sm:text-lg tracking-[0.18em]">REALTY&amp;BROKERAGE</span>
        </a>
        <p class="text-sm text-slate-400">© 2026. M2M Realty &amp; Brokerage. All rights reserved.</p>
      </div>

      <!-- Link row -->
      <nav class="flex flex-wrap items-center gap-x-8 gap-y-3" aria-label="Footer">
        <a href="#" class="text-sm text-slate-200 hover:text-cyan-400 transition-colors">Privacy Policy</a>
        <a href="#" class="text-sm text-slate-200 hover:text-cyan-400 transition-colors">Terms of Service</a>
        <a href="#" class="text-sm text-slate-200 hover:text-cyan-400 transition-colors">Market Reports</a>
        <a href="#" class="text-sm text-slate-200 hover:text-cyan-400 transition-colors">Sitemap</a>
        <a href="#" class="text-sm text-slate-200 hover:text-cyan-400 transition-colors">Affiliates</a>
      </nav>

      <!-- Icons -->
      <div class="flex items-center gap-5 text-slate-300">
        <button type="button" aria-label="Share" class="hover:text-cyan-400 transition-colors">
          <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="18" cy="5" r="3"/>
            <circle cx="6" cy="12" r="3"/>
            <circle cx="18" cy="19" r="3"/>
            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/>
            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>
          </svg>
        </button>
        <button type="button" aria-label="Language / Region" class="hover:text-cyan-400 transition-colors">
          <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="10"/>
            <line x1="2" y1="12" x2="22" y2="12"/>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
          </svg>
        </button>
      </div>

    </div>
  </div>

</footer>