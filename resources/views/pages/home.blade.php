@extends('layouts.app')
@section('content')
<!-- ============ HERO ============ -->
 <section class="relative">
  <div class="relative h-[560px] sm:h-[600px] w-full overflow-hidden">
    <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=2000&q=80"
         alt="Modern luxury home at dusk"
         class="absolute inset-0 w-full h-full object-cover" />

    <!-- Gradient overlay -->
    <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.45) 0%, rgba(0,0,0,0.55) 50%, rgba(0,0,0,0.65) 100%);"></div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-8 h-full flex items-center">
      <div class="max-w-4xl text-white">
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight tracking-tight">
          Redefining the Standard of Luxury Living
        </h1>
        <p class="mt-5 text-base xl:text-lg text-slate-200 max-w-2xl leading-relaxed font-light">
          Discover an exclusive collection of prestigious estates and contemporary
          architectural masterpieces across the globe's most coveted locations.
        </p>

        <!-- Search panel -->
        <div class="mt-8 bg-white rounded-xl shadow-2xl p-3 sm:p-4 flex flex-col md:flex-row gap-3 md:items-center">

          <!-- Buy/Rent toggle -->
          <div class="inline-flex bg-slate-100 rounded-lg p-1 shrink-0 self-start md:self-auto" role="tablist" aria-label="Listing type">
            <button type="button" role="tab" aria-selected="true"
                    class="px-4 py-2 rounded-md bg-cyan-500 text-white text-sm font-medium shadow-sm">Buy</button>
            <button type="button" role="tab" aria-selected="false"
                    class="px-4 py-2 rounded-md text-slate-600 hover:text-slate-800 text-sm font-medium">Rent</button>
          </div>

          <!-- Location input -->
          <div class="flex-1 min-w-0 flex items-center gap-2 px-3 md:border-l border-slate-200">
            <svg class="h-5 w-5 text-slate-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
              <circle cx="12" cy="10" r="3"/>
            </svg>
            <input type="text" placeholder="Enter location, area or building"
                   class="w-full min-w-0 bg-transparent outline-none text-slate-700 placeholder:text-slate-400 text-sm py-2"/>
          </div>

          <!-- Property type select -->
          <div class="relative flex items-center px-3 md:border-l border-slate-200 w-full md:w-[180px]">

              <select class="w-full bg-transparent outline-none text-slate-700 text-sm py-2 cursor-pointer appearance-none pr-8">
                  <option>Property Type</option>
                  <option>Villa</option>
                  <option>Apartment</option>
                  <option>Penthouse</option>
                  <option>Estate</option>
              </select>
              <svg class="absolute right-3 h-4 w-4 text-slate-400 pointer-events-none"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <polyline points="6 9 12 15 18 9"/>
              </svg>
          </div>

          <!-- Search button -->
          <button type="button" class="shrink-0 inline-flex items-center justify-center gap-2 bg-cyan-500 hover:bg-cyan-600 text-white font-medium text-sm px-6 py-3 rounded-lg transition-colors">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8"/>
              <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            Search
          </button>

        </div>
      </div>
    </div>
  </div>
</section>
  <!-- ============ FEATURED LISTINGS ============ -->
  <section class="bg-slate-50 py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Featured Listings</h2>
        <div class="flex items-center gap-2">
          <button aria-label="Previous" class="h-10 w-10 rounded-md border border-slate-200 bg-white hover:bg-slate-50 flex items-center justify-center text-slate-600 transition-colors">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
          </button>
          <button aria-label="Next" class="h-10 w-10 rounded-md border border-slate-200 bg-white hover:bg-slate-50 flex items-center justify-center text-slate-600 transition-colors">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
          </button>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <article class="bg-white rounded-xl border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow">
          <div class="relative">
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80" alt="Skyline Penthouse" class="w-full h-56 object-cover"/>
            <span class="absolute top-3 left-3 bg-cyan-500 text-white text-xs font-semibold px-3 py-1 rounded">FOR SALE</span>
            <button aria-label="Save" class="absolute top-3 right-3 h-8 w-8 rounded-full bg-white/95 flex items-center justify-center text-slate-400 hover:text-cyan-500 transition-colors">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            </button>
          </div>
          <div class="p-5">
            <p class="text-cyan-500 text-2xl font-bold">₱8,450,000</p>
            <h3 class="mt-1 text-lg font-semibold text-slate-900">Skyline Penthouse</h3>
            <p class="mt-1 flex items-center gap-1 text-sm text-slate-500">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              Beverly Hills, CA
            </p>
            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center gap-5 text-sm text-slate-600">
              <span class="flex items-center gap-1.5"><svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 17h20M2 17v-5a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v5M6 9V7a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2"/></svg>5 Beds</span>
              <span class="flex items-center gap-1.5"><svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12V6a2 2 0 0 1 4 0M3 12h18v4a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-4z"/></svg>6 Baths</span>
              <span class="flex items-center gap-1.5"><svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 21h18M3 21V8l9-5 9 5v13M9 21v-6h6v6"/></svg>4,200 sqft</span>
            </div>
          </div>
        </article>

        <!-- Card 2 -->
        <article class="bg-white rounded-xl border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow">
          <div class="relative">
            <img src="https://images.unsplash.com/photo-1613977257363-707ba9348227?auto=format&fit=crop&w=800&q=80" alt="Azure Waterfront Estate" class="w-full h-56 object-cover"/>
            <span class="absolute top-3 left-3 bg-cyan-500 text-white text-xs font-semibold px-3 py-1 rounded">EXCLUSIVE</span>
            <button aria-label="Save" class="absolute top-3 right-3 h-8 w-8 rounded-full bg-white/95 flex items-center justify-center text-cyan-500">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            </button>
          </div>
          <div class="p-5">
            <p class="text-cyan-500 text-2xl font-bold">₱12,000,000</p>
            <h3 class="mt-1 text-lg font-semibold text-slate-900">Azure Waterfront Estate</h3>
            <p class="mt-1 flex items-center gap-1 text-sm text-slate-500">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              Miami Beach, FL
            </p>
            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center gap-5 text-sm text-slate-600">
              <span class="flex items-center gap-1.5"><svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 17h20M2 17v-5a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v5M6 9V7a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2"/></svg>7 Beds</span>
              <span class="flex items-center gap-1.5"><svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12V6a2 2 0 0 1 4 0M3 12h18v4a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-4z"/></svg>8 Baths</span>
              <span class="flex items-center gap-1.5"><svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 21h18M3 21V8l9-5 9 5v13M9 21v-6h6v6"/></svg>8,500 sqft</span>
            </div>
          </div>
        </article>

        <!-- Card 3 -->
        <article class="bg-white rounded-xl border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow">
          <div class="relative">
            <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=800&q=80" alt="Oakwood Modern Retreat" class="w-full h-56 object-cover"/>
            <span class="absolute top-3 left-3 bg-cyan-500 text-white text-xs font-semibold px-3 py-1 rounded">NEW LISTING</span>
            <button aria-label="Save" class="absolute top-3 right-3 h-8 w-8 rounded-full bg-white/95 flex items-center justify-center text-slate-400 hover:text-cyan-500 transition-colors">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            </button>
          </div>
          <div class="p-5">
            <p class="text-cyan-500 text-2xl font-bold">₱4,250,000</p>
            <h3 class="mt-1 text-lg font-semibold text-slate-900">Oakwood Modern Retreat</h3>
            <p class="mt-1 flex items-center gap-1 text-sm text-slate-500">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              Aspen, CO
            </p>
            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center gap-5 text-sm text-slate-600">
              <span class="flex items-center gap-1.5"><svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 17h20M2 17v-5a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v5M6 9V7a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2"/></svg>4 Beds</span>
              <span class="flex items-center gap-1.5"><svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12V6a2 2 0 0 1 4 0M3 12h18v4a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-4z"/></svg>4 Baths</span>
              <span class="flex items-center gap-1.5"><svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 21h18M3 21V8l9-5 9 5v13M9 21v-6h6v6"/></svg>3,800 sqft</span>
            </div>
          </div>
        </article>
      </div>

      <!-- Pagination dots -->
      <div class="flex items-center justify-center gap-2 mt-8">
        <span class="h-2 w-6 rounded-full bg-cyan-500"></span>
        <span class="h-2 w-2 rounded-full bg-slate-300"></span>
        <span class="h-2 w-2 rounded-full bg-slate-300"></span>
      </div>
    </div>
  </section>

  <!-- ============ BROWSE BY CATEGORY ============ -->
  <section class="bg-slate-100 py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <div class="text-center mb-10">
        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Browse by Category</h2>
        <p class="mt-2 text-slate-500">Tailored search experiences for every lifestyle</p>
      </div>

      <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Apartments -->
        <a href="#" class="group relative h-44 rounded-xl overflow-hidden">
          <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?auto=format&fit=crop&w=800&q=80" alt="" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
          <div class="absolute inset-0 bg-black/45 group-hover:bg-black/55 transition-colors"></div>
          <div class="absolute inset-0 flex flex-col items-center justify-center text-white">
            <svg class="h-7 w-7 mb-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="1"/><path d="M9 22v-4h6v4M8 6h.01M16 6h.01M8 10h.01M16 10h.01M8 14h.01M16 14h.01M12 6h.01M12 10h.01M12 14h.01"/></svg>
            <span class="text-base font-semibold">Apartments</span>
          </div>
        </a>

        <!-- Villas -->
        <a href="#" class="group relative h-44 rounded-xl overflow-hidden">
          <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=800&q=80" alt="" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
          <div class="absolute inset-0 bg-black/30 group-hover:bg-black/45 transition-colors"></div>
          <div class="absolute inset-0 flex flex-col items-center justify-center text-white">
            <svg class="h-7 w-7 mb-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12l9-8 9 8M5 10v10h14V10"/><path d="M9 20v-6h6v6"/></svg>
            <span class="text-base font-semibold">Villas</span>
          </div>
        </a>

        <!-- Houses -->
        <a href="#" class="group relative h-44 rounded-xl overflow-hidden">
          <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=800&q=80" alt="" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
          <div class="absolute inset-0 bg-black/35 group-hover:bg-black/50 transition-colors"></div>
          <div class="absolute inset-0 flex flex-col items-center justify-center text-white">
            <svg class="h-7 w-7 mb-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            <span class="text-base font-semibold">Houses</span>
          </div>
        </a>

        <!-- Condos -->
        <a href="#" class="group relative h-44 rounded-xl overflow-hidden">
          <img src="https://images.unsplash.com/photo-1486325212027-8081e485255e?auto=format&fit=crop&w=800&q=80" alt="" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
          <div class="absolute inset-0 bg-black/45 group-hover:bg-black/55 transition-colors"></div>
          <div class="absolute inset-0 flex flex-col items-center justify-center text-white">
            <svg class="h-7 w-7 mb-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2h12v20H6zM10 6h.01M14 6h.01M10 10h.01M14 10h.01M10 14h.01M14 14h.01M10 18h.01M14 18h.01"/></svg>
            <span class="text-base font-semibold">Condos</span>
          </div>
        </a>
      </div>
    </div>
  </section>

  <!-- ============ WHY CHOOSE US ============ -->
  <section class="bg-slate-50 py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

        <!-- Image with stat overlay -->
        <div class="relative">
          <div class="rounded-xl overflow-hidden shadow-lg">
            <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=1000&q=80"
                 alt="Investor reviewing property portfolio"
                 class="w-full h-[480px] object-cover"/>
          </div>
          <div class="absolute -bottom-6 right-6 sm:right-10 bg-cyan-500 text-white rounded-xl px-8 py-5 shadow-xl">
            <p class="text-3xl font-bold leading-none">25+</p>
            <p class="text-xs uppercase tracking-wider mt-1">Years of Excellence</p>
          </div>
        </div>

        <!-- Copy -->
        <div>
          <p class="text-cyan-500 text-xs font-semibold uppercase tracking-[0.2em] mb-4">Expertise &amp; Trust</p>
          <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 leading-tight">
            Why Global Investors Choose <span class="block">M2M REALTY</span>
          </h2>

          <ul class="mt-8 space-y-6">
            <li class="flex gap-4">
              <span class="shrink-0 h-9 w-9 rounded-full bg-cyan-50 flex items-center justify-center text-cyan-500">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              </span>
              <div>
                <h3 class="font-semibold text-slate-900">Market Leading Insights</h3>
                <p class="mt-1 text-sm text-slate-500 leading-relaxed">We provide deep-dive analytics and real-time market data to ensure your investments are always ahead of the curve.</p>
              </div>
            </li>
            <li class="flex gap-4">
              <span class="shrink-0 h-9 w-9 rounded-full bg-cyan-50 flex items-center justify-center text-cyan-500">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l8 4v6c0 5-3.5 9-8 10-4.5-1-8-5-8-10V6l8-4z"/></svg>
              </span>
              <div>
                <h3 class="font-semibold text-slate-900">Bespoke Privacy</h3>
                <p class="mt-1 text-sm text-slate-500 leading-relaxed">Discretion is our hallmark. We handle high-profile transactions with the utmost confidentiality and security.</p>
              </div>
            </li>
            <li class="flex gap-4">
              <span class="shrink-0 h-9 w-9 rounded-full bg-cyan-50 flex items-center justify-center text-cyan-500">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
              </span>
              <div>
                <h3 class="font-semibold text-slate-900">Global Network</h3>
                <p class="mt-1 text-sm text-slate-500 leading-relaxed">Access exclusive off-market listings across five continents through our unparalleled partner network.</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ FEATURED LISTINGS (REPEAT) ============ -->
  <section class="bg-slate-50 py-16 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Featured Listings</h2>
        <div class="flex items-center gap-2">
          <button aria-label="Previous" class="h-10 w-10 rounded-md border border-slate-200 bg-white hover:bg-slate-50 flex items-center justify-center text-slate-600 transition-colors">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
          </button>
          <button aria-label="Next" class="h-10 w-10 rounded-md border border-slate-200 bg-white hover:bg-slate-50 flex items-center justify-center text-slate-600 transition-colors">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
          </button>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- duplicate of cards above; kept inline for simple static page -->
        <article class="bg-white rounded-xl border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow">
          <div class="relative">
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80" alt="" class="w-full h-56 object-cover"/>
            <span class="absolute top-3 left-3 bg-cyan-500 text-white text-xs font-semibold px-3 py-1 rounded">FOR SALE</span>
            <button aria-label="Save" class="absolute top-3 right-3 h-8 w-8 rounded-full bg-white/95 flex items-center justify-center text-slate-400 hover:text-cyan-500 transition-colors">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            </button>
          </div>
          <div class="p-5">
            <p class="text-cyan-500 text-2xl font-bold">₱8,450,000</p>
            <h3 class="mt-1 text-lg font-semibold text-slate-900">Skyline Penthouse</h3>
            <p class="mt-1 flex items-center gap-1 text-sm text-slate-500">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              Beverly Hills, CA
            </p>
            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center gap-5 text-sm text-slate-600">
              <span class="flex items-center gap-1.5"><svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 17h20M2 17v-5a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v5M6 9V7a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2"/></svg>5 Beds</span>
              <span class="flex items-center gap-1.5"><svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12V6a2 2 0 0 1 4 0M3 12h18v4a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-4z"/></svg>6 Baths</span>
              <span class="flex items-center gap-1.5"><svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 21h18M3 21V8l9-5 9 5v13M9 21v-6h6v6"/></svg>4,200 sqft</span>
            </div>
          </div>
        </article>

        <article class="bg-white rounded-xl border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow">
          <div class="relative">
            <img src="https://images.unsplash.com/photo-1613977257363-707ba9348227?auto=format&fit=crop&w=800&q=80" alt="" class="w-full h-56 object-cover"/>
            <span class="absolute top-3 left-3 bg-cyan-500 text-white text-xs font-semibold px-3 py-1 rounded">EXCLUSIVE</span>
            <button aria-label="Save" class="absolute top-3 right-3 h-8 w-8 rounded-full bg-white/95 flex items-center justify-center text-cyan-500">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            </button>
          </div>
          <div class="p-5">
            <p class="text-cyan-500 text-2xl font-bold">₱12,000,000</p>
            <h3 class="mt-1 text-lg font-semibold text-slate-900">Azure Waterfront Estate</h3>
            <p class="mt-1 flex items-center gap-1 text-sm text-slate-500">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              Miami Beach, FL
            </p>
            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center gap-5 text-sm text-slate-600">
              <span class="flex items-center gap-1.5"><svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 17h20M2 17v-5a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v5M6 9V7a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2"/></svg>7 Beds</span>
              <span class="flex items-center gap-1.5"><svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12V6a2 2 0 0 1 4 0M3 12h18v4a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-4z"/></svg>8 Baths</span>
              <span class="flex items-center gap-1.5"><svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 21h18M3 21V8l9-5 9 5v13M9 21v-6h6v6"/></svg>8,500 sqft</span>
            </div>
          </div>
        </article>

        <article class="bg-white rounded-xl border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow">
          <div class="relative">
            <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=800&q=80" alt="" class="w-full h-56 object-cover"/>
            <span class="absolute top-3 left-3 bg-cyan-500 text-white text-xs font-semibold px-3 py-1 rounded">NEW LISTING</span>
            <button aria-label="Save" class="absolute top-3 right-3 h-8 w-8 rounded-full bg-white/95 flex items-center justify-center text-slate-400 hover:text-cyan-500 transition-colors">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            </button>
          </div>
          <div class="p-5">
            <p class="text-cyan-500 text-2xl font-bold">₱4,250,000</p>
            <h3 class="mt-1 text-lg font-semibold text-slate-900">Oakwood Modern Retreat</h3>
            <p class="mt-1 flex items-center gap-1 text-sm text-slate-500">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              Aspen, CO
            </p>
            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center gap-5 text-sm text-slate-600">
              <span class="flex items-center gap-1.5"><svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 17h20M2 17v-5a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v5M6 9V7a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2"/></svg>4 Beds</span>
              <span class="flex items-center gap-1.5"><svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12V6a2 2 0 0 1 4 0M3 12h18v4a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-4z"/></svg>4 Baths</span>
              <span class="flex items-center gap-1.5"><svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 21h18M3 21V8l9-5 9 5v13M9 21v-6h6v6"/></svg>3,800 sqft</span>
            </div>
          </div>
        </article>
      </div>

      <div class="flex items-center justify-center gap-2 mt-8">
        <span class="h-2 w-6 rounded-full bg-cyan-500"></span>
        <span class="h-2 w-2 rounded-full bg-slate-300"></span>
        <span class="h-2 w-2 rounded-full bg-slate-300"></span>
      </div>
    </div>
  </section>
  @endsection

  

