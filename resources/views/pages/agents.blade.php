@extends('layouts.app')
@section('title') Our Professional Agents @endsection
@section('content')

{{-- ============================================================
     AGENTS PAGE
     ============================================================ --}}
<section class="bg-slate-100 min-h-screen py-10">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">


    {{-- ========================================================
         PAGE HEADER
         ======================================================== --}}
    <div class="mb-8">
      <h1 class="text-3xl lg:text-4xl font-bold text-slate-900">Our Professional Agents</h1>
      <p class="text-slate-500 mt-2 max-w-md text-sm leading-relaxed">
        Connect with the most trusted luxury real estate experts in the industry. Our
        agents bring decades of collective experience to every transaction.
      </p>
    </div>


    {{-- ========================================================
         SEARCH + FILTER BAR
         ======================================================== --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm px-5 py-4 mb-10">
      <div class="flex flex-col sm:flex-row gap-3">

        {{-- Search input --}}
        <div class="relative flex-1">
          <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400 pointer-events-none"
               viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
          </svg>
          <input type="text" id="agent-search" placeholder="Search by name or specialty..."
                 class="w-full pl-9 pr-4 py-2.5 text-sm text-slate-700 border border-slate-200 rounded-lg outline-none focus:border-cyan-400 transition-colors bg-slate-50" />
        </div>

        {{-- Specialty dropdown --}}
        <div class="relative">
          <button type="button" id="specialty-btn"
                  class="flex items-center gap-2 bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 hover:border-cyan-400 transition-colors font-medium shadow-sm w-full sm:w-auto justify-center">
            <svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="11" y1="18" x2="13" y2="18"/>
            </svg>
            Specialty
            <svg class="h-3.5 w-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="6 9 12 15 18 9"/>
            </svg>
          </button>

          {{-- Dropdown panel --}}
          <div id="specialty-dropdown"
               class="hidden absolute right-0 mt-2 w-56 bg-white border border-slate-200 rounded-xl shadow-lg z-20 py-2">
            @php
              $specialties = ['All Specialties', 'Luxury Residential', 'International Investment',
                              'New Development', 'Architectural Heritage', 'Urban Loft', 'Estate Portfolio'];
            @endphp
            @foreach ($specialties as $spec)
              <button type="button" data-specialty="{{ $spec }}"
                      class="specialty-option w-full text-left px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-cyan-600 transition-colors
                             {{ $loop->first ? 'text-cyan-600 font-medium' : '' }}">
                {{ $spec }}
              </button>
            @endforeach
          </div>
        </div>

        {{-- Find Agent button --}}
        <button type="button" id="find-agent-btn"
                class="bg-cyan-700 hover:bg-cyan-800 text-white font-medium text-sm px-6 py-2.5 rounded-lg transition-colors shadow-sm shrink-0">
          Find Agent
        </button>

      </div>
    </div>


    {{-- ========================================================
         AGENTS GRID
         ======================================================== --}}
    @php
      $agents = $agents ?? [
        [
          'name'       => 'Julian Sterling',
          'role'       => 'Principal Broker',
          'specialty'  => 'Luxury Residential Specialist',
          'bio'        => 'With over 15 years in high-stakes real estate, Julian specializes in waterfront estates and historic penthouse properties across the tri-state area.',
          'image'      => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&q=80',
          'email'      => 'julian@m2mrealty.com',
          'phone'      => '+1 (212) 555-0101',
          'slug'       => 'julian-sterling',
        ],
        [
          'name'       => 'Elena Rodriguez',
          'role'       => 'Senior Associate',
          'specialty'  => 'International Investment Expert',
          'bio'        => 'Elena leverages her global network to assist international clients in finding the perfect secondary residence in premier markets.',
          'image'      => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80',
          'email'      => 'elena@m2mrealty.com',
          'phone'      => '+1 (212) 555-0102',
          'slug'       => 'elena-rodriguez',
        ],
        [
          'name'       => 'Marcus Chen',
          'role'       => 'Development Liaison',
          'specialty'  => 'New Development Specialist',
          'bio'        => 'Specializing in off-plan sales and developer relations, Marcus has successfully launched over twenty premier residential developments.',
          'image'      => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
          'email'      => 'marcus@m2mrealty.com',
          'phone'      => '+1 (212) 555-0103',
          'slug'       => 'marcus-chen',
        ],
        [
          'name'       => 'Sophia Laurent',
          'role'       => 'Luxury Specialist',
          'specialty'  => 'Architectural Heritage Expert',
          'bio'        => "Sophia's background in art history allows her to provide unique insights into the heritage value of iconic mid-century and pre-war residences.",
          'image'      => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=400&q=80',
          'email'      => 'sophia@m2mrealty.com',
          'phone'      => '+1 (212) 555-0104',
          'slug'       => 'sophia-laurent',
        ],
        [
          'name'       => 'David Park',
          'role'       => 'Sales Manager',
          'specialty'  => 'Urban Loft Specialist',
          'bio'        => 'David is the leading expert in adaptive reuse loft spaces, helping creative professionals find industrial-chic homes in up-and-coming neighborhoods.',
          'image'      => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=400&q=80',
          'email'      => 'david@m2mrealty.com',
          'phone'      => '+1 (212) 555-0105',
          'slug'       => 'david-park',
        ],
        [
          'name'       => 'Isabella Grant',
          'role'       => 'Partner',
          'specialty'  => 'Estate Portfolio Manager',
          'bio'        => 'Isabella manages high-value real estate portfolios for private equity firms and ultra-high-net-worth individuals across multiple markets.',
          'image'      => 'https://images.unsplash.com/photo-1551836022-deb4988cc6c0?auto=format&fit=crop&w=400&q=80',
          'email'      => 'isabella@m2mrealty.com',
          'phone'      => '+1 (212) 555-0106',
          'slug'       => 'isabella-grant',
        ],
      ];
    @endphp

    <div id="agents-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse ($agents as $agent)
      <div class="agent-card bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow group"
           data-name="{{ strtolower($agent['name']) }}"
           data-specialty="{{ $agent['specialty'] }}">

        {{-- Photo --}}
        <div class="relative h-64 overflow-hidden bg-slate-100">
          <img src="{{ $agent['image'] }}" alt="{{ $agent['name'] }}"
               class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500" />
          <span class="absolute top-3 left-3 bg-slate-900/70 backdrop-blur-sm text-white text-[11px] font-semibold tracking-wide px-2.5 py-1 rounded-md">
            {{ $agent['role'] }}
          </span>
        </div>

        {{-- Info --}}
        <div class="p-5">
          <h3 class="text-lg font-bold text-slate-900">{{ $agent['name'] }}</h3>
          <p class="text-sm font-medium text-cyan-600 mb-3">{{ $agent['specialty'] }}</p>
          <p class="text-sm text-slate-500 leading-relaxed line-clamp-3 mb-5">{{ $agent['bio'] }}</p>

          {{-- Actions --}}
          <div class="flex items-center gap-3">
            <a href="mailto:{{ $agent['email'] }}"
               class="flex-1 flex items-center justify-center gap-2 border border-slate-200 rounded-lg py-2 text-sm text-slate-600 hover:border-cyan-400 hover:text-cyan-600 transition-colors font-medium">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2,4 12,13 22,4"/>
              </svg>
              Email
            </a>
            <a href="tel:{{ $agent['phone'] }}"
               class="flex-1 flex items-center justify-center gap-2 bg-cyan-700 hover:bg-cyan-800 text-white rounded-lg py-2 text-sm font-medium transition-colors">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.18 6.18l.9-.9a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
              </svg>
              Call
            </a>
          </div>
        </div>

      </div>
      @empty
      <div class="col-span-3 py-20 text-center text-slate-400">
        <svg class="mx-auto h-12 w-12 mb-4 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
        </svg>
        <p class="text-base font-medium text-slate-500">No agents found</p>
        <p class="text-sm mt-1">Try a different search or specialty.</p>
      </div>
      @endforelse
    </div>

    {{-- No results message (shown by JS) --}}
    <div id="no-results" class="hidden py-20 text-center text-slate-400">
      <svg class="mx-auto h-12 w-12 mb-4 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
      </svg>
      <p class="text-base font-medium text-slate-500">No agents match your search</p>
      <p class="text-sm mt-1">Try a different name or specialty.</p>
    </div>


    {{-- ========================================================
         LOAD MORE
         ======================================================== --}}
    <div class="flex justify-center mt-12">
      <button type="button" id="load-more-btn"
              class="border border-slate-300 bg-white hover:border-cyan-400 hover:text-cyan-600 text-slate-700 font-medium text-sm px-10 py-3 rounded-xl transition-colors shadow-sm">
        Load More Agents
      </button>
    </div>

  </div>
</section>


{{-- ============================================================
     AGENTS PAGE JS — search, specialty filter, dropdown
     ============================================================ --}}
<script>
(function () {

  // ── Specialty dropdown toggle ──────────────────────────────
  const specialtyBtn      = document.getElementById('specialty-btn');
  const specialtyDropdown = document.getElementById('specialty-dropdown');

  specialtyBtn.addEventListener('click', function (e) {
    e.stopPropagation();
    specialtyDropdown.classList.toggle('hidden');
  });

  document.addEventListener('click', function () {
    specialtyDropdown.classList.add('hidden');
  });


  // ── Filter state ───────────────────────────────────────────
  let activeSpecialty = 'All Specialties';
  let searchQuery     = '';

  function applyFilters() {
    const cards     = document.querySelectorAll('.agent-card');
    let   visible   = 0;

    cards.forEach(function (card) {
      const name      = card.dataset.name      || '';
      const specialty = card.dataset.specialty || '';

      const matchesSearch    = name.includes(searchQuery) ||
                               specialty.toLowerCase().includes(searchQuery);
      const matchesSpecialty = activeSpecialty === 'All Specialties' ||
                               specialty.toLowerCase().includes(activeSpecialty.toLowerCase());

      if (matchesSearch && matchesSpecialty) {
        card.classList.remove('hidden');
        visible++;
      } else {
        card.classList.add('hidden');
      }
    });

    document.getElementById('no-results').classList.toggle('hidden', visible > 0);
  }


  // ── Search input ───────────────────────────────────────────
  document.getElementById('agent-search').addEventListener('input', function () {
    searchQuery = this.value.toLowerCase().trim();
    applyFilters();
  });

  document.getElementById('find-agent-btn').addEventListener('click', applyFilters);


  // ── Specialty option click ─────────────────────────────────
  document.querySelectorAll('.specialty-option').forEach(function (opt) {
    opt.addEventListener('click', function () {
      activeSpecialty = opt.dataset.specialty;

      // Update active style
      document.querySelectorAll('.specialty-option').forEach(function (o) {
        o.classList.remove('text-cyan-600', 'font-medium');
      });
      opt.classList.add('text-cyan-600', 'font-medium');

      // Update button label
      specialtyBtn.childNodes[2].textContent = ' ' + activeSpecialty + ' ';

      specialtyDropdown.classList.add('hidden');
      applyFilters();
    });
  });


  // ── Load More (static demo — wire to real pagination if needed) ──
  document.getElementById('load-more-btn').addEventListener('click', function () {
    this.textContent = 'No more agents to load';
    this.disabled    = true;
    this.classList.add('opacity-50', 'cursor-not-allowed');
  });

})();
</script>

@endsection