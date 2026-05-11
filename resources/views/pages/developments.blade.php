@extends('layouts.app')
@section('title') Developments — M2M Realty & Brokerage @endsection
@section('content')

{{-- ============================================================
     DEVELOPMENTS PAGE
     ============================================================ --}}

<div class="relative bg-slate-900 overflow-hidden min-h-[420px] flex items-end">
  <div class="absolute inset-0">
    <img src="https://images.unsplash.com/photo-1486325212027-8081e485255e?auto=format&fit=crop&w=1800&q=80"
         alt="Developments hero"
         class="w-full h-full object-cover opacity-30" />
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/60 to-transparent"></div>
  </div>

  <div class="relative max-w-7xl mx-auto px-6 lg:px-8 pb-16 pt-32 w-full">
    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8">
      <div>
        <p class="text-cyan-400 text-xs font-bold tracking-[0.2em] uppercase mb-3">New Developments</p>
        <h1 class="text-4xl lg:text-5xl font-bold text-white leading-tight">
          Tomorrow's Skyline,<br/>
          <span class="text-cyan-400">Available Today</span>
        </h1>
        <p class="text-slate-300 mt-4 text-sm leading-relaxed max-w-lg">
          Explore our curated portfolio of pre-selling and ready-for-occupancy developments
          from the Philippines' most trusted developers.
        </p>
      </div>

      {{-- Hero stats --}}
      <div class="flex gap-8 shrink-0">
        @foreach ([['32', 'Active Projects'], ['12', 'Developers'], ['4,800+', 'Units Available']] as $s)
        <div class="text-center lg:text-right">
          <p class="text-3xl font-bold text-white">{{ $s[0] }}</p>
          <p class="text-xs text-slate-400 mt-0.5">{{ $s[1] }}</p>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>


{{-- ── FILTER BAR ───────────────────────────────────────────── --}}
<div class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-sm">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">

    <div class="flex items-center gap-3 overflow-x-auto overflow-y-hidden py-4 whitespace-nowrap snap-x snap-mandatory scrollbar-hide touch-pan-x">

      {{-- Status tabs --}}
      @php
        $statuses = ['All', 'Pre-Selling', 'Ready for Occupancy', 'Coming Soon'];
      @endphp

      @foreach ($statuses as $i => $status)
      <button
        type="button"
        data-tab="{{ $status }}"
        class="status-tab snap-start shrink-0 px-4 py-2 rounded-lg text-sm font-medium border transition-colors
        {{ $i === 0
          ? 'bg-cyan-700 text-white border-cyan-700'
          : 'bg-white text-slate-600 border-slate-200 hover:border-cyan-400 hover:text-cyan-600' }}">
        {{ $status }}
      </button>
      @endforeach

      <div class="h-6 w-px bg-slate-200 mx-2 shrink-0 snap-start"></div>

      {{-- Location filter --}}
      <div class="relative shrink-0 snap-start">
        <select id="location-filter"
          class="appearance-none bg-white border border-slate-200 rounded-lg pl-3 pr-8 py-2 text-sm text-slate-600 outline-none focus:border-cyan-400 transition-colors cursor-pointer">

          <option value="">All Locations</option>

          @foreach (['Metro Manila', 'Cebu', 'Davao', 'Batangas', 'Laguna', 'Pampanga'] as $loc)
          <option value="{{ $loc }}">{{ $loc }}</option>
          @endforeach

        </select>

        <svg
          class="absolute right-2.5 top-1/2 -translate-y-1/2 h-3.5 w-3.5 text-slate-400 pointer-events-none"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round">
          <polyline points="6 9 12 15 18 9"/>
        </svg>
      </div>

      {{-- Type filter --}}
      <div class="relative shrink-0 snap-start">
        <select id="type-filter"
          class="appearance-none bg-white border border-slate-200 rounded-lg pl-3 pr-8 py-2 text-sm text-slate-600 outline-none focus:border-cyan-400 transition-colors cursor-pointer">

          <option value="">All Types</option>

          @foreach (['Condominium', 'Townhouse', 'House & Lot', 'Commercial'] as $type)
          <option value="{{ $type }}">{{ $type }}</option>
          @endforeach

        </select>

        <svg
          class="absolute right-2.5 top-1/2 -translate-y-1/2 h-3.5 w-3.5 text-slate-400 pointer-events-none"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round">
          <polyline points="6 9 12 15 18 9"/>
        </svg>
      </div>

      {{-- Sort --}}
      <div class="relative shrink-0 snap-start">
        <select id="sort-filter"
          class="appearance-none bg-white border border-slate-200 rounded-lg pl-3 pr-8 py-2 text-sm text-slate-600 outline-none focus:border-cyan-400 transition-colors cursor-pointer">

          <option>Newest First</option>
          <option>Price: Low to High</option>
          <option>Price: High to Low</option>
          <option>Completion Date</option>

        </select>

        <svg
          class="absolute right-2.5 top-1/2 -translate-y-1/2 h-3.5 w-3.5 text-slate-400 pointer-events-none"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round">
          <polyline points="6 9 12 15 18 9"/>
        </svg>
      </div>

    </div>

  </div>
</div>


{{-- ── MAIN CONTENT ─────────────────────────────────────────── --}}
<section class="bg-slate-100 py-12">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">

    {{-- Results count --}}
    <div class="flex items-center justify-between mb-6">
      <p class="text-sm text-slate-500"><span id="results-count">6</span> developments found</p>
    </div>

    {{-- ======================================================
         FEATURED DEVELOPMENT (full-width card)
         ====================================================== --}}
    @php
      $featured = [
        'name'        => 'Pinnacle Residences',
        'developer'   => 'Ayala Land Premier',
        'location'    => 'BGC, Taguig, Metro Manila',
        'status'      => 'Pre-Selling',
        'type'        => 'Condominium',
        'price_from'  => '₱8,500,000',
        'completion'  => 'Q4 2027',
        'units'       => '320',
        'floors'      => '52',
        'image'       => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?auto=format&fit=crop&w=1200&q=80',
        'description' => 'An iconic glass tower rising 52 floors above BGC, Pinnacle Residences offers unobstructed panoramic views of Manila Bay and the Metro skyline. Features resort-style amenities, a sky lounge, and direct mall connectivity.',
        'amenities'   => ['Infinity Pool', 'Sky Lounge', 'Gym', 'Concierge', 'Parking'],
        'slug'        => 'pinnacle-residences',
      ];
    @endphp

    <div class="dev-card bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow mb-6 group"
         data-status="{{ $featured['status'] }}"
         data-location="Metro Manila"
         data-type="{{ $featured['type'] }}">
      <div class="grid grid-cols-1 lg:grid-cols-2">
        {{-- Image --}}
        <div class="relative h-64 lg:h-auto overflow-hidden">
          <img src="{{ $featured['image'] }}" alt="{{ $featured['name'] }}"
               class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent lg:bg-gradient-to-r"></div>

          {{-- Badges --}}
          <div class="absolute top-4 left-4 flex flex-col gap-2">
            <span class="bg-cyan-500 text-white text-[11px] font-bold tracking-wider px-2.5 py-1 rounded-md">
              {{ $featured['status'] }}
            </span>
            <span class="bg-slate-900/70 backdrop-blur-sm text-white text-[11px] font-semibold px-2.5 py-1 rounded-md">
              FEATURED
            </span>
          </div>

          {{-- Save --}}
          <button type="button" aria-label="Save"
                  class="absolute top-4 right-4 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow hover:text-cyan-500 transition-colors">
            <svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
          </button>
        </div>

        {{-- Info --}}
        <div class="p-7 flex flex-col justify-between">
          <div>
            <p class="text-xs text-slate-400 font-medium uppercase tracking-wider mb-1">{{ $featured['developer'] }}</p>
            <h2 class="text-2xl font-bold text-slate-900 mb-1">{{ $featured['name'] }}</h2>
            <div class="flex items-center gap-1.5 text-sm text-slate-500 mb-4">
              <svg class="h-4 w-4 text-cyan-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
              </svg>
              {{ $featured['location'] }}
            </div>
            <p class="text-sm text-slate-500 leading-relaxed mb-5">{{ $featured['description'] }}</p>

            {{-- Amenity chips --}}
            <div class="flex flex-wrap gap-2 mb-6">
              @foreach ($featured['amenities'] as $amenity)
              <span class="text-xs bg-slate-100 text-slate-600 px-3 py-1 rounded-full border border-slate-200">{{ $amenity }}</span>
              @endforeach
            </div>

            {{-- Key stats row --}}
            <div class="grid grid-cols-3 gap-4 py-4 border-y border-slate-100 mb-5">
              @foreach ([
                [$featured['units'], 'Total Units'],
                [$featured['floors'], 'Floors'],
                [$featured['completion'], 'Completion'],
              ] as $stat)
              <div class="text-center">
                <p class="text-base font-bold text-slate-800">{{ $stat[0] }}</p>
                <p class="text-xs text-slate-400 mt-0.5">{{ $stat[1] }}</p>
              </div>
              @endforeach
            </div>
          </div>

          <div class="flex items-center justify-between">
            <div>
              <p class="text-xs text-slate-400">Starting from</p>
              <p class="text-2xl font-bold text-cyan-600">{{ $featured['price_from'] }}</p>
            </div>
            <a href="{{ url('/developments/' . $featured['slug']) }}"
               class="bg-cyan-700 hover:bg-cyan-800 text-white font-medium text-sm px-6 py-2.5 rounded-xl transition-colors shadow-sm">
              View Details
            </a>
          </div>
        </div>
      </div>
    </div>


    {{-- ======================================================
         DEVELOPMENTS GRID
         ====================================================== --}}
    @php
      $developments = $developments ?? [
        [
          'name'       => 'Azure Shores',
          'developer'  => 'DMCI Homes',
          'location'   => 'Pasay, Metro Manila',
          'status'     => 'Ready for Occupancy',
          'type'       => 'Condominium',
          'price_from' => '₱3,200,000',
          'completion' => 'Q2 2024',
          'units'      => '180',
          'image'      => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80',
          'badge_color'=> 'bg-emerald-500',
          'slug'       => 'azure-shores',
        ],
        [
          'name'       => 'Verdana Hills',
          'developer'  => 'Filinvest Land',
          'location'   => 'Antipolo, Rizal',
          'status'     => 'Pre-Selling',
          'type'       => 'House & Lot',
          'price_from' => '₱4,800,000',
          'completion' => 'Q1 2026',
          'units'      => '240',
          'image'      => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=800&q=80',
          'badge_color'=> 'bg-cyan-500',
          'slug'       => 'verdana-hills',
        ],
        [
          'name'       => 'The Grand Cebu',
          'developer'  => 'Robinsons Land',
          'location'   => 'Cebu Business Park, Cebu',
          'status'     => 'Pre-Selling',
          'type'       => 'Condominium',
          'price_from' => '₱5,100,000',
          'completion' => 'Q3 2026',
          'units'      => '410',
          'image'      => 'https://images.unsplash.com/photo-1486325212027-8081e485255e?auto=format&fit=crop&w=800&q=80',
          'badge_color'=> 'bg-cyan-500',
          'slug'       => 'the-grand-cebu',
        ],
        [
          'name'       => 'Mirala Nuvali',
          'developer'  => 'Ayala Land',
          'location'   => 'Santa Rosa, Laguna',
          'status'     => 'Ready for Occupancy',
          'type'       => 'Townhouse',
          'price_from' => '₱6,900,000',
          'completion' => 'Q4 2023',
          'units'      => '96',
          'image'      => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80',
          'badge_color'=> 'bg-emerald-500',
          'slug'       => 'mirala-nuvali',
        ],
        [
          'name'       => 'Harbor Point Tower',
          'developer'  => 'SM Prime Holdings',
          'location'   => 'Subic Bay, Pampanga',
          'status'     => 'Coming Soon',
          'type'       => 'Condominium',
          'price_from' => '₱2,900,000',
          'completion' => 'Q2 2028',
          'units'      => '500',
          'image'      => 'https://images.unsplash.com/photo-1583608205776-bfd35f0d9f83?auto=format&fit=crop&w=800&q=80',
          'badge_color'=> 'bg-amber-500',
          'slug'       => 'harbor-point-tower',
        ],
        [
          'name'       => 'Solana Davao',
          'developer'  => 'Vista Land',
          'location'   => 'Davao City, Davao',
          'status'     => 'Pre-Selling',
          'type'       => 'House & Lot',
          'price_from' => '₱3,750,000',
          'completion' => 'Q1 2027',
          'units'      => '150',
          'image'      => 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=800&q=80',
          'badge_color'=> 'bg-cyan-500',
          'slug'       => 'solana-davao',
        ],
        [
          'name'       => 'Solana Davao',
          'developer'  => 'Vista Land',
          'location'   => 'Davao City, Davao',
          'status'     => 'Pre-Selling',
          'type'       => 'House & Lot',
          'price_from' => '₱3,750,000',
          'completion' => 'Q1 2027',
          'units'      => '150',
          'image'      => 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=800&q=80',
          'badge_color'=> 'bg-cyan-500',
          'slug'       => 'solana-davao',
        ],
      ];
    @endphp

    <div id="dev-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse ($developments as $dev)
      <div class="dev-card bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow group"
           data-status="{{ $dev['status'] }}"
           data-location="{{ explode(',', $dev['location'])[1] ?? $dev['location'] }}"
           data-type="{{ $dev['type'] }}">

        {{-- Image --}}
        <div class="relative h-48 overflow-hidden">
          <img src="{{ $dev['image'] }}" alt="{{ $dev['name'] }}"
               class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent"></div>

          <span class="absolute top-3 left-3 {{ $dev['badge_color'] }} text-white text-[11px] font-bold tracking-wider px-2.5 py-1 rounded-md">
            {{ $dev['status'] }}
          </span>
          <span class="absolute top-3 right-3 bg-slate-900/60 backdrop-blur-sm text-white text-[11px] font-medium px-2.5 py-1 rounded-md">
            {{ $dev['type'] }}
          </span>

          {{-- Completion ribbon --}}
          <div class="absolute bottom-3 left-3 flex items-center gap-1.5 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1">
            <svg class="h-3 w-3 text-cyan-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            <span class="text-[11px] font-semibold text-slate-700">{{ $dev['completion'] }}</span>
          </div>
        </div>

        {{-- Info --}}
        <div class="p-5">
          <p class="text-[11px] text-slate-400 font-medium uppercase tracking-wider mb-1">{{ $dev['developer'] }}</p>
          <h3 class="text-base font-bold text-slate-900 mb-1">{{ $dev['name'] }}</h3>
          <div class="flex items-center gap-1 text-xs text-slate-500 mb-4">
            <svg class="h-3.5 w-3.5 text-cyan-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
            </svg>
            {{ $dev['location'] }}
          </div>

          <div class="flex items-center justify-between border-t border-slate-100 pt-4">
            <div>
              <p class="text-[11px] text-slate-400">Starting from</p>
              <p class="text-lg font-bold text-cyan-600">{{ $dev['price_from'] }}</p>
              <p class="text-xs text-slate-400">{{ $dev['units'] }} units</p>
            </div>
            <a href="{{ url('/developments/' . $dev['slug']) }}"
               class="flex items-center gap-1.5 text-sm font-medium text-cyan-600 hover:text-cyan-800 transition-colors">
              Details
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"/>
              </svg>
            </a>
          </div>
        </div>

      </div>
      @empty
      <div class="col-span-3 py-20 text-center text-slate-400">
        <svg class="mx-auto h-12 w-12 mb-4 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/>
        </svg>
        <p class="text-base font-medium text-slate-500">No developments found</p>
        <p class="text-sm mt-1">Try adjusting your filters.</p>
      </div>
      @endforelse
    </div>

    {{-- No results --}}
    <div id="no-dev-results" class="hidden py-20 text-center text-slate-400">
      <svg class="mx-auto h-12 w-12 mb-4 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
      </svg>
      <p class="text-base font-medium text-slate-500">No developments match your filters</p>
      <p class="text-sm mt-1">Try selecting different options above.</p>
    </div>


    {{-- ======================================================
         LOAD MORE
         ====================================================== --}}
    <div class="flex justify-center mt-12">
      <button type="button" id="load-more-btn"
              class="border border-slate-300 bg-white hover:border-cyan-400 hover:text-cyan-600 text-slate-700 font-medium text-sm px-10 py-3 rounded-xl transition-colors shadow-sm">
        Load More Developments
      </button>
    </div>


    {{-- ======================================================
         CTA BANNER
         ====================================================== --}}
    <div class="mt-16 relative bg-slate-900 rounded-2xl overflow-hidden">
      <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?auto=format&fit=crop&w=1400&q=80"
             alt="CTA background" class="w-full h-full object-cover opacity-20" />
        <div class="absolute inset-0 bg-gradient-to-r from-cyan-900/80 to-slate-900/80"></div>
      </div>
      <div class="relative px-8 py-12 lg:px-16 flex flex-col lg:flex-row items-center justify-between gap-8">
        <div>
          <p class="text-cyan-400 text-xs font-bold tracking-[0.2em] uppercase mb-2">Exclusive Pre-Selling Access</p>
          <h3 class="text-2xl lg:text-3xl font-bold text-white">Get First Pick on New Projects</h3>
          <p class="text-slate-300 text-sm mt-2 max-w-md">
            Register your interest and be the first to receive floor plans, price lists,
            and launch-day offers directly from our development team.
          </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 shrink-0">
          <a href="{{ route('contact') }}"
             class="bg-cyan-600 hover:bg-cyan-500 text-white font-semibold text-sm px-7 py-3 rounded-xl transition-colors text-center">
            Register Interest
          </a>
          <a href="{{ route('agents') }}"
             class="bg-white/10 hover:bg-white/20 text-white font-medium text-sm px-7 py-3 rounded-xl transition-colors border border-white/20 text-center">
            Talk to an Agent
          </a>
        </div>
      </div>
    </div>

  </div>
</section>


{{-- ============================================================
     FILTER JS
     ============================================================ --}}
<script>
(function () {

  let activeStatus   = 'All';
  let activeLocation = '';
  let activeType     = '';

  function applyFilters() {
    const cards   = document.querySelectorAll('.dev-card');
    let   visible = 0;

    cards.forEach(function (card) {
      const status   = card.dataset.status   || '';
      const location = card.dataset.location || '';
      const type     = card.dataset.type     || '';

      const matchStatus   = activeStatus === 'All' || status === activeStatus;
      const matchLocation = !activeLocation || location.includes(activeLocation);
      const matchType     = !activeType     || type === activeType;

      if (matchStatus && matchLocation && matchType) {
        card.classList.remove('hidden');
        visible++;
      } else {
        card.classList.add('hidden');
      }
    });

    const countEl = document.getElementById('results-count');
    if (countEl) countEl.textContent = visible;

    const noResults = document.getElementById('no-dev-results');
    if (noResults) noResults.classList.toggle('hidden', visible > 0);
  }

  // Status tabs
  document.querySelectorAll('.status-tab').forEach(function (btn) {
    btn.addEventListener('click', function () {
      activeStatus = btn.dataset.tab;

      document.querySelectorAll('.status-tab').forEach(function (b) {
        b.classList.remove('bg-cyan-700', 'text-white', 'border-cyan-700');
        b.classList.add('bg-white', 'text-slate-600', 'border-slate-200');
      });
      btn.classList.add('bg-cyan-700', 'text-white', 'border-cyan-700');
      btn.classList.remove('bg-white', 'text-slate-600', 'border-slate-200');

      applyFilters();
    });
  });

  // Location filter
  document.getElementById('location-filter').addEventListener('change', function () {
    activeLocation = this.value;
    applyFilters();
  });

  // Type filter
  document.getElementById('type-filter').addEventListener('change', function () {
    activeType = this.value;
    applyFilters();
  });

  // Load more
  document.getElementById('load-more-btn').addEventListener('click', function () {
    this.textContent = 'No more developments to load';
    this.disabled    = true;
    this.classList.add('opacity-50', 'cursor-not-allowed');
  });

})();
</script>

@endsection