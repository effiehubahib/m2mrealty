@extends('layouts.app')
@section('title') Premium Listings @endsection
@section('content')

{{-- ============================================================
     LISTINGS PAGE
     Layout: Left sidebar filters + Right property grid
     ============================================================ --}}
<section class="bg-slate-100 min-h-screen py-10">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">


    {{-- ========================================================
         MOBILE FILTER TRIGGER BAR (visible below lg only)
         ======================================================== --}}
    <div class="flex items-center justify-between mb-6 lg:hidden">
      <div>
        <h1 class="text-2xl font-bold text-slate-900">Premium Listings</h1>
        <p class="text-xs text-slate-500 mt-0.5">Showing {{ $totalCount ?? 148 }} properties in {{ $location ?? 'New York' }}</p>
      </div>
      <button type="button" id="filter-open-btn"
              class="flex items-center gap-2 bg-white border border-slate-200 shadow-sm text-slate-700 hover:border-cyan-400 hover:text-cyan-500 font-medium text-sm px-4 py-2.5 rounded-xl transition-colors">
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="11" y1="18" x2="13" y2="18"/>
        </svg>
        Filters
      </button>
    </div>


    {{-- ========================================================
         MOBILE FILTER DRAWER OVERLAY
         ======================================================== --}}
    <div id="filter-overlay"
         class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden"
         aria-hidden="true">
    </div>

    {{-- Filter drawer panel (slides up from bottom on mobile) --}}
    <div id="filter-drawer"
         class="fixed bottom-0 left-0 right-0 z-50 bg-white rounded-t-2xl shadow-2xl
                translate-y-full transition-transform duration-300 ease-in-out
                lg:hidden max-h-[85vh] overflow-y-auto">

      {{-- Drawer handle + header --}}
      <div class="flex items-center justify-between px-6 pt-5 pb-4 border-b border-slate-100 sticky top-0 bg-white z-10">
        <div class="flex items-center gap-3">
          <div class="w-10 h-1 bg-slate-200 rounded-full absolute top-3 left-1/2 -translate-x-1/2"></div>
          <h2 class="text-base font-bold text-slate-900">Filters</h2>
        </div>
        <div class="flex items-center gap-4">
          <button type="button" class="text-sm text-cyan-500 hover:text-cyan-600 font-medium transition-colors">Clear All</button>
          <button type="button" id="filter-close-btn" aria-label="Close filters"
                  class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 hover:bg-slate-200 transition-colors">
            <svg class="h-4 w-4 text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
          </button>
        </div>
      </div>

      {{-- Drawer filter body --}}
      <div class="px-6 py-5 space-y-6">
        @include('partials.filter-body')
      </div>

      {{-- Sticky apply button --}}
      <div class="sticky bottom-0 bg-white border-t border-slate-100 px-6 py-4">
        <button type="button" id="filter-apply-btn"
                class="w-full bg-cyan-700 hover:bg-cyan-800 text-white font-medium text-sm py-3 rounded-xl transition-colors">
          Apply Filters
        </button>
      </div>
    </div>


    {{-- ========================================================
         MAIN LAYOUT: SIDEBAR + CONTENT
         ======================================================== --}}
    <div class="flex flex-col lg:flex-row gap-8 items-start">


      {{-- ======================================================
           SIDEBAR (desktop only — hidden on mobile)
           ====================================================== --}}
      <aside class="hidden lg:block w-72 shrink-0 bg-white border border-slate-200 rounded-xl p-6 shadow-sm sticky top-24">

        <div class="flex items-center justify-between mb-6">
          <h2 class="text-lg font-bold text-slate-900">Filters</h2>
          <button type="button" class="text-sm text-cyan-500 hover:text-cyan-600 font-medium transition-colors">Clear All</button>
        </div>

        @include('partials.filter-body')

        <button type="button"
                class="w-full mt-6 bg-cyan-700 hover:bg-cyan-800 text-white font-medium text-sm py-3 rounded-xl transition-colors">
          Apply Filters
        </button>

      </aside>


      {{-- ======================================================
           MAIN CONTENT
           ====================================================== --}}
      <div class="flex-1 min-w-0">

        {{-- Page heading + sort (desktop) --}}
        <div class="hidden lg:flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
          <div>
            <h1 class="text-3xl font-bold text-slate-900">Premium Listings</h1>
            <p class="text-sm text-slate-500 mt-1">Showing {{ $totalCount ?? 148 }} properties in {{ $location ?? 'New York' }}</p>
          </div>
          <div class="flex items-center gap-2 shrink-0">
            <span class="text-sm text-slate-500">Sort By:</span>
            <div class="relative">
              <select name="sort" class="appearance-none bg-white border border-slate-200 rounded-lg pl-3 pr-8 py-2 text-sm text-slate-700 outline-none cursor-pointer focus:border-cyan-400 transition-colors shadow-sm">
                <option value="newest"   {{ request('sort') === 'newest'    ? 'selected' : '' }}>Newest First</option>
                <option value="price_asc"  {{ request('sort') === 'price_asc'  ? 'selected' : '' }}>Price: Low to High</option>
                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                <option value="popular"  {{ request('sort') === 'popular'   ? 'selected' : '' }}>Most Popular</option>
              </select>
              <svg class="absolute right-2.5 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400 pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"/>
              </svg>
            </div>
          </div>
        </div>

        {{-- Mobile sort row --}}
        <div class="flex items-center justify-between gap-3 mb-5 lg:hidden">
          <span class="text-xs text-slate-500">{{ $totalCount ?? 148 }} properties found</span>
          <div class="relative">
            <select name="sort" class="appearance-none bg-white border border-slate-200 rounded-lg pl-3 pr-7 py-2 text-xs text-slate-700 outline-none cursor-pointer focus:border-cyan-400 transition-colors shadow-sm">
              <option value="newest"    {{ request('sort') === 'newest'    ? 'selected' : '' }}>Newest First</option>
              <option value="price_asc"  {{ request('sort') === 'price_asc'  ? 'selected' : '' }}>Price: Low to High</option>
              <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
              <option value="popular"   {{ request('sort') === 'popular'   ? 'selected' : '' }}>Most Popular</option>
            </select>
            <svg class="absolute right-2 top-1/2 -translate-y-1/2 h-3.5 w-3.5 text-slate-400 pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="6 9 12 15 18 9"/>
            </svg>
          </div>
        </div>


        {{-- ====================================================
             PROPERTY GRID
             $properties is passed from your controller.
             Falls back to sample data if not provided.
             ==================================================== --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

          @php
            // Fallback demo data — replace with real $properties from controller
            $properties = $properties ?? [
              [
                'badge'       => 'FOR SALE',
                'badge_color' => 'bg-cyan-500',
                'image'       => 'https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=800&q=80',
                'price'       => '₱4,850,000',
                'type'        => 'Villa',
                'address'     => '742 Evergreen Terrace, Beverly Hills, CA',
                'beds'        => 5,
                'baths'       => 6,
                'sqft'        => '5,200',
                'slug'        => 'evergreen-terrace',
              ],
              [
                'badge'       => 'PENTHOUSE',
                'badge_color' => 'bg-slate-700',
                'image'       => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80',
                'price'       => '₱2,120,000',
                'type'        => 'Condo',
                'address'     => '1100 Avenue of the Americas, Manhattan, NY',
                'beds'        => 3,
                'baths'       => 2,
                'sqft'        => '2,850',
                'slug'        => 'avenue-of-americas',
              ],
              [
                'badge'       => 'JUST LISTED',
                'badge_color' => 'bg-cyan-500',
                'image'       => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=800&q=80',
                'price'       => '₱1,750,000',
                'type'        => 'Classic',
                'address'     => '45 Oak Ridge Drive, Greenwich, CT',
                'beds'        => 4,
                'baths'       => 3,
                'sqft'        => '3,600',
                'slug'        => 'oak-ridge-drive',
              ],
              [
                'badge'       => 'REDUCED',
                'badge_color' => 'bg-amber-500',
                'image'       => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80',
                'price'       => '₱3,200,000',
                'type'        => 'Modern',
                'address'     => '288 Waterfront Way, Miami, FL',
                'beds'        => 4,
                'baths'       => 4,
                'sqft'        => '4,100',
                'slug'        => 'waterfront-way',
              ],
            [
                'badge'       => 'FOR SALE',
                'badge_color' => 'bg-cyan-500',
                'image'       => 'https://images.unsplash.com/photo-1583608205776-bfd35f0d9f83?auto=format&fit=crop&w=800&q=80',
                'price'       => '₱5,500,000',
                'type'        => 'Villa',
                'address'     => '18 Sunrise Boulevard, Cebu City, PH',
                'beds'        => 6,
                'baths'       => 5,
                'sqft'        => '6,100',
                'slug'        => 'sunrise-boulevard',
                ],
                [
                'badge'       => 'JUST LISTED',
                'badge_color' => 'bg-cyan-500',
                'image'       => 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=800&q=80',
                'price'       => '₱1,950,000',
                'type'        => 'Classic',
                'address'     => '9 Mango Avenue, Davao City, PH',
                'beds'        => 3,
                'baths'       => 2,
                'sqft'        => '2,400',
                'slug'        => 'mango-avenue',
                ],
                [
                'badge'       => 'PENTHOUSE',
                'badge_color' => 'bg-slate-700',
                'image'       => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?auto=format&fit=crop&w=800&q=80',
                'price'       => '₱8,750,000',
                'type'        => 'Condo',
                'address'     => '52 BGC High Street, Taguig, PH',
                'beds'        => 4,
                'baths'       => 3,
                'sqft'        => '3,900',
                'slug'        => 'bgc-high-street',
                ],
                [
                'badge'       => 'REDUCED',
                'badge_color' => 'bg-amber-500',
                'image'       => 'https://images.unsplash.com/photo-1598228723793-52759bba239c?auto=format&fit=crop&w=800&q=80',
                'price'       => '₱2,300,000',
                'type'        => 'Townhouse',
                'address'     => '77 Palm Street, Iloilo City, PH',
                'beds'        => 3,
                'baths'       => 2,
                'sqft'        => '2,100',
                'slug'        => 'palm-street-iloilo',
                ],
                [
                'badge'       => 'FOR SALE',
                'badge_color' => 'bg-cyan-500',
                'image'       => 'https://images.unsplash.com/photo-1580587771525-78b9dba3b914?auto=format&fit=crop&w=800&q=80',
                'price'       => '₱4,100,000',
                'type'        => 'Modern',
                'address'     => '33 Coastal Drive, Batangas, PH',
                'beds'        => 5,
                'baths'       => 4,
                'sqft'        => '4,800',
                'slug'        => 'coastal-drive-batangas',
                ],

            ];
          @endphp

          @forelse ($properties as $property)
          <a href="{{ isset($property['slug']) ? url('/properties/' . $property['slug']) : '#' }}"
             class="block bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow group">
            <div class="relative h-52 overflow-hidden">
              <img src="{{ $property['image'] }}" alt="{{ $property['address'] }}"
                   class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
              <span class="absolute top-3 left-3 {{ $property['badge_color'] }} text-white text-[11px] font-bold tracking-wider px-2.5 py-1 rounded-md">
                {{ $property['badge'] }}
              </span>
              <button type="button" aria-label="Save property"
                      onclick="event.preventDefault()"
                      class="absolute top-3 right-3 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow hover:text-cyan-500 transition-colors">
                <svg class="h-4 w-4 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
              </button>
            </div>
            <div class="p-5">
              <div class="flex items-center justify-between mb-2">
                <span class="text-2xl font-bold text-cyan-600">{{ $property['price'] }}</span>
                <span class="text-xs text-slate-500 border border-slate-200 rounded-full px-3 py-1">{{ $property['type'] }}</span>
              </div>
              <p class="text-sm text-slate-700 mb-4">{{ $property['address'] }}</p>
              <hr class="border-slate-100 mb-4">
              <div class="flex items-center gap-5 text-sm text-slate-500">
                <span class="flex items-center gap-1.5">
                  {{-- Bed icon --}}
                  <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 9V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v4"/><path d="M2 9h20v11H2z"/><path d="M6 9V5"/><path d="M18 9V5"/>
                  </svg>
                  {{ $property['beds'] }} Beds
                </span>
                <span class="flex items-center gap-1.5">
                  {{-- Bath icon --}}
                  <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 12h16v4a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4v-4z"/><path d="M6 12V5a2 2 0 0 1 2-2h3v2.25"/>
                  </svg>
                  {{ $property['baths'] }} Baths
                </span>
                <span class="flex items-center gap-1.5">
                  {{-- Area icon --}}
                  <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/>
                  </svg>
                  {{ $property['sqft'] }} sqft
                </span>
              </div>
            </div>
          </a>
          @empty
          <div class="col-span-2 py-20 text-center text-slate-400">
            <svg class="mx-auto h-12 w-12 mb-4 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
            <p class="text-base font-medium text-slate-500">No properties found</p>
            <p class="text-sm mt-1">Try adjusting your filters.</p>
          </div>
          @endforelse

        </div>
        {{-- END PROPERTY GRID --}}


        {{-- ====================================================
             PAGINATION
             Works with Laravel's paginator ($properties->links())
             or falls back to a static 3-page example.
             ==================================================== --}}
        @if (isset($properties) && is_object($properties) && method_exists($properties, 'links'))
          <div class="mt-12">
            {{ $properties->links() }}
          </div>
        @else
          {{-- Static fallback pagination --}}
          <div class="flex items-center justify-center gap-2 mt-12">
            <button type="button" class="w-9 h-9 flex items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 hover:border-cyan-400 hover:text-cyan-500 transition-colors shadow-sm">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            </button>
            @foreach ([1, 2, 3] as $page)
              <button type="button"
                      class="w-9 h-9 flex items-center justify-center rounded-lg text-sm font-medium border transition-colors shadow-sm
                             {{ $page === 1 ? 'bg-cyan-600 text-white border-cyan-600' : 'bg-white text-slate-600 border-slate-200 hover:border-cyan-400 hover:text-cyan-500' }}">
                {{ $page }}
              </button>
            @endforeach
            <span class="w-9 h-9 flex items-center justify-center text-slate-400 text-sm">...</span>
            <button type="button" class="w-9 h-9 flex items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 hover:border-cyan-400 hover:text-cyan-500 transition-colors shadow-sm">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
            </button>
          </div>
        @endif

      </div>
      {{-- END MAIN CONTENT --}}

    </div>
  </div>
</section>


{{-- ============================================================
     DRAWER JS
     ============================================================ --}}
<script>
  (function () {
    const openBtn   = document.getElementById('filter-open-btn');
    const closeBtn  = document.getElementById('filter-close-btn');
    const applyBtn  = document.getElementById('filter-apply-btn');
    const drawer    = document.getElementById('filter-drawer');
    const overlay   = document.getElementById('filter-overlay');

    function openDrawer() {
      overlay.classList.remove('hidden');
      drawer.classList.remove('translate-y-full');
      document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
      drawer.classList.add('translate-y-full');
      overlay.classList.add('hidden');
      document.body.style.overflow = '';
    }

    openBtn.addEventListener('click', openDrawer);
    closeBtn.addEventListener('click', closeDrawer);
    applyBtn.addEventListener('click', closeDrawer);
    overlay.addEventListener('click', closeDrawer);
  })();
</script>

@endsection