@extends('layouts.app')
@section('title') About Page @endsection
@section('content')

{{-- ============================================================
     SECTION 1: HERO BANNER
     ============================================================ --}}
<section class="relative">
  <div class="relative h-[420px] sm:h-[500px] w-full overflow-hidden">
    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=2000&q=80"
         alt="Luxury interior"
         class="absolute inset-0 w-full h-full object-cover" />
    <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.45) 0%, rgba(0,0,0,0.60) 60%, rgba(0,0,0,0.70) 100%);"></div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-8 h-full flex flex-col items-center justify-center text-center text-white">
      <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight tracking-tight max-w-3xl">
        Redefining the Horizon of Luxury Living
      </h1>
      <p class="mt-5 text-base sm:text-lg text-slate-200 max-w-2xl leading-relaxed">
        Founded on a vision of architectural excellence and unwavering integrity, M2M
        Realty connects the world's most discerning individuals with the world's most
        extraordinary properties.
      </p>
    </div>
  </div>
</section>


{{-- ============================================================
     SECTION 2: OUR STORY
     ============================================================ --}}
<section class="bg-white py-16">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 border border-slate-200 rounded-xl overflow-hidden shadow-sm">

      {{-- Text side --}}
      <div class="p-10 flex flex-col justify-center">
        <span class="text-xs font-semibold tracking-widest text-cyan-500 uppercase mb-3">Our Story</span>
        <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 leading-tight mb-6">
          A Legacy Built on Precision
        </h2>
        <p class="text-slate-600 text-sm leading-relaxed mb-4">
          M2M Realty began as a boutique firm in London with a single focus: to provide a
          data-rich, high-service environment for luxury real estate transactions. Over two
          decades, we have evolved into a global authority, managing over $15 billion in
          exclusive listings.
        </p>
        <p class="text-slate-600 text-sm leading-relaxed">
          Our success is rooted in a deep understanding of architectural value and the
          complex financial landscapes that define high-stakes property acquisitions.
        </p>
      </div>

      {{-- Image side --}}
      <div class="h-72 lg:h-auto">
        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1200&q=80"
             alt="Elegant interior corridor"
             class="w-full h-full object-cover" />
      </div>

    </div>
  </div>
</section>


{{-- ============================================================
     SECTION 3: OUR MISSION
     ============================================================ --}}
<section class="bg-white pb-16">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 rounded-xl overflow-hidden shadow-sm">

      {{-- Image side --}}
      <div class="h-72 lg:h-auto">
        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200&q=80"
             alt="Architectural model of a luxury building"
             class="w-full h-full object-cover" />
      </div>

      {{-- Blue card side --}}
      <div class="bg-cyan-600 p-10 flex flex-col justify-center text-white">
        <h2 class="text-2xl sm:text-3xl font-bold mb-5">Our Mission</h2>
        <p class="text-cyan-100 text-sm leading-relaxed mb-8">
          To elevate the standard of luxury real estate through technological innovation,
          unparalleled market intelligence, and a commitment to transparency that builds
          lifelong partnerships with our clients.
        </p>

        {{-- Stats --}}
        <div class="flex gap-6">
          <div class="bg-cyan-700/60 rounded-lg px-5 py-4">
            <p class="text-2xl font-bold">98%</p>
            <p class="text-xs text-cyan-200 tracking-widest uppercase mt-1">Client Retention</p>
          </div>
          <div class="bg-cyan-700/60 rounded-lg px-5 py-4">
            <p class="text-2xl font-bold">24+</p>
            <p class="text-xs text-cyan-200 tracking-widest uppercase mt-1">Global Hubs</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


{{-- ============================================================
     SECTION 4: THE PILLARS
     ============================================================ --}}
<section class="bg-slate-50 py-16">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">

    {{-- Heading --}}
    <div class="text-center mb-12">
      <h2 class="text-3xl sm:text-4xl font-bold text-slate-900">The Pillars of M2M</h2>
      <div class="mt-3 mx-auto w-12 h-0.5 bg-cyan-500 rounded-full"></div>
    </div>

    {{-- Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

      {{-- Integrity --}}
      <div class="bg-white border border-slate-200 rounded-xl p-8 shadow-sm">
        <div class="w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center mb-5">
          <svg class="h-5 w-5 text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
        </div>
        <h3 class="text-lg font-bold text-slate-900 mb-3">Integrity</h3>
        <p class="text-slate-500 text-sm leading-relaxed">
          We operate with radical transparency, ensuring that every transaction is grounded
          in honesty and ethical precision.
        </p>
      </div>

      {{-- Excellence --}}
      <div class="bg-white border border-slate-200 rounded-xl p-8 shadow-sm">
        <div class="w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center mb-5">
          <svg class="h-5 w-5 text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
          </svg>
        </div>
        <h3 class="text-lg font-bold text-slate-900 mb-3">Excellence</h3>
        <p class="text-slate-500 text-sm leading-relaxed">
          From architectural photography to penthouse presentation, we pursue perfection
          in the smallest details of the client journey.
        </p>
      </div>

      {{-- Innovation --}}
      <div class="bg-white border border-slate-200 rounded-xl p-8 shadow-sm">
        <div class="w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center mb-5">
          <svg class="h-5 w-5 text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
          </svg>
        </div>
        <h3 class="text-lg font-bold text-slate-900 mb-3">Innovation</h3>
        <p class="text-slate-500 text-sm leading-relaxed">
          We leverage proprietary AI and global data networks to predict market trends
          before they become headlines.
        </p>
      </div>

    </div>
  </div>
</section>


{{-- ============================================================
     SECTION 5: GLOBAL REACH
     White bg, left: heading + text + bullet stats | Right: map card
     ============================================================ --}}
<section class="bg-slate-50 py-16">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

      {{-- Text side --}}
      <div>
        <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 leading-tight mb-5">
          Global Reach, Local Authority
        </h2>
        <p class="text-slate-600 text-sm leading-relaxed mb-8">
          Our network spans 24 countries across 5 continents, providing our clients with
          seamless access to the world's most exclusive real estate markets. Whether it's
          a villa in Lake Como or a penthouse in Manhattan, our local experts provide the
          boots-on-the-ground intelligence required for successful cross-border investment.
        </p>

        <ul class="space-y-4">
          <li class="flex items-center gap-3 text-sm text-slate-700">
            <svg class="h-5 w-5 text-cyan-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/>
              <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
            </svg>
            150+ Partner Agencies Worldwide
          </li>
          <li class="flex items-center gap-3 text-sm text-slate-700">
            <svg class="h-5 w-5 text-cyan-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/>
              <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
            </svg>
            Concierge Service in 12 Languages
          </li>
        </ul>
      </div>

      {{-- Map card side --}}
      <div class="relative bg-slate-200 rounded-2xl overflow-hidden h-[380px] shadow-lg">
        <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=1200&q=80"
             alt="World map"
             class="w-full h-full object-cover grayscale opacity-80" />

        {{-- Floating info card — centered --}}
        <div class="absolute inset-0 flex items-center justify-center">
          <div class="bg-white rounded-xl shadow-xl px-8 py-6 text-center max-w-[220px]">
            <p class="text-sm font-semibold text-slate-800 mb-1">International Hubs</p>
            <p class="text-xs text-slate-500 mb-4">Connected globally, serving locally.</p>
            <a href="#" class="text-xs font-semibold text-cyan-500 hover:text-cyan-600 transition-colors">
              Explore Locations →
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


{{-- ============================================================
     SECTION 6: CAREERS CTA
     Rounded dark card (not full-width), centered heading + subtitle + two buttons
     ============================================================ --}}
<section class="bg-slate-50 py-10 pb-16">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <div class="bg-slate-900 rounded-2xl py-20 px-8 text-center" style="background: radial-gradient(ellipse at top, #1e3a5f 0%, #0f172a 70%);">
      <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
        Architect Your Career
      </h2>
      <p class="text-slate-400 text-base sm:text-lg max-w-xl mx-auto mb-10">
        Join a team of elite professionals who are redefining the future of real estate. We
        are always looking for visionary agents, analysts, and technologists.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="#" class="inline-flex items-center justify-center bg-cyan-500 hover:bg-cyan-600 text-white font-medium text-sm px-10 py-3.5 rounded-lg transition-colors">
          View Open Positions
        </a>
        <a href="#" class="inline-flex items-center justify-center border border-slate-600 hover:border-slate-400 text-white font-medium text-sm px-10 py-3.5 rounded-lg transition-colors">
          Contact HR
        </a>
      </div>
    </div>
  </div>
</section>

@endsection