{{-- ============================================================
     FILTER BODY PARTIAL
     resources/views/partials/filter-body.blade.php

     Included by both:
       - resources/views/properties.blade.php  (desktop sidebar)
       - The mobile filter drawer in the same file
     ============================================================ --}}

{{-- ── 1. PROPERTY TYPE ─────────────────────────────────────── --}}
<div>
  <h3 class="text-sm font-semibold text-slate-800 mb-3">Property Type</h3>
  <div class="space-y-2">
    @php
      $types = ['Any', 'Villa', 'Condo', 'Classic', 'Modern', 'Townhouse', 'Land'];
    @endphp
    @foreach ($types as $type)
      <label class="flex items-center gap-2.5 cursor-pointer group">
        <input type="radio" name="property_type" value="{{ strtolower($type) }}"
               {{ (request('property_type', 'any') === strtolower($type)) ? 'checked' : '' }}
               class="w-4 h-4 accent-cyan-600 cursor-pointer" />
        <span class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">{{ $type }}</span>
      </label>
    @endforeach
  </div>
</div>

<hr class="border-slate-100">

{{-- ── 2. PRICE RANGE ───────────────────────────────────────── --}}
<div>
  <h3 class="text-sm font-semibold text-slate-800 mb-3">Price Range</h3>
  <div class="space-y-3">
    <div>
      <label class="text-xs text-slate-500 mb-1 block">Min Price</label>
      <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm">$</span>
        <input type="number" name="price_min" placeholder="0"
               value="{{ request('price_min') }}"
               class="w-full bg-slate-50 border border-slate-200 rounded-lg pl-7 pr-3 py-2 text-sm text-slate-700 outline-none focus:border-cyan-400 transition-colors" />
      </div>
    </div>
    <div>
      <label class="text-xs text-slate-500 mb-1 block">Max Price</label>
      <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm">$</span>
        <input type="number" name="price_max" placeholder="No limit"
               value="{{ request('price_max') }}"
               class="w-full bg-slate-50 border border-slate-200 rounded-lg pl-7 pr-3 py-2 text-sm text-slate-700 outline-none focus:border-cyan-400 transition-colors" />
      </div>
    </div>
  </div>
</div>

<hr class="border-slate-100">

{{-- ── 3. BEDROOMS ──────────────────────────────────────────── --}}
<div>
  <h3 class="text-sm font-semibold text-slate-800 mb-3">Bedrooms</h3>
  <div class="flex flex-wrap gap-2">
    @foreach (['Any', '1', '2', '3', '4', '5+'] as $bed)
      @php $val = strtolower($bed); @endphp
      <button type="button"
              data-filter-group="beds" data-filter-value="{{ $val }}"
              class="filter-chip px-3.5 py-1.5 rounded-lg border text-sm font-medium transition-colors
                     {{ request('beds', 'any') === $val
                          ? 'bg-cyan-600 text-white border-cyan-600'
                          : 'bg-white text-slate-600 border-slate-200 hover:border-cyan-400 hover:text-cyan-500' }}">
        {{ $bed }}
      </button>
    @endforeach
    <input type="hidden" name="beds" id="filter-beds" value="{{ request('beds', 'any') }}" />
  </div>
</div>

<hr class="border-slate-100">

{{-- ── 4. BATHROOMS ─────────────────────────────────────────── --}}
<div>
  <h3 class="text-sm font-semibold text-slate-800 mb-3">Bathrooms</h3>
  <div class="flex flex-wrap gap-2">
    @foreach (['Any', '1', '2', '3', '4+'] as $bath)
      @php $val = strtolower($bath); @endphp
      <button type="button"
              data-filter-group="baths" data-filter-value="{{ $val }}"
              class="filter-chip px-3.5 py-1.5 rounded-lg border text-sm font-medium transition-colors
                     {{ request('baths', 'any') === $val
                          ? 'bg-cyan-600 text-white border-cyan-600'
                          : 'bg-white text-slate-600 border-slate-200 hover:border-cyan-400 hover:text-cyan-500' }}">
        {{ $bath }}
      </button>
    @endforeach
    <input type="hidden" name="baths" id="filter-baths" value="{{ request('baths', 'any') }}" />
  </div>
</div>

<hr class="border-slate-100">

{{-- ── 5. LISTING STATUS ────────────────────────────────────── --}}
<div>
  <h3 class="text-sm font-semibold text-slate-800 mb-3">Listing Status</h3>
  <div class="space-y-2">
    @php
      $statuses = [
        'for_sale'    => 'For Sale',
        'just_listed' => 'Just Listed',
        'reduced'     => 'Reduced',
        'penthouse'   => 'Penthouse',
        'for_rent'    => 'For Rent',
      ];
    @endphp
    @foreach ($statuses as $value => $label)
      <label class="flex items-center gap-2.5 cursor-pointer group">
        <input type="checkbox" name="status[]" value="{{ $value }}"
               {{ in_array($value, (array) request('status', [])) ? 'checked' : '' }}
               class="w-4 h-4 accent-cyan-600 cursor-pointer rounded" />
        <span class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">{{ $label }}</span>
      </label>
    @endforeach
  </div>
</div>

<hr class="border-slate-100">

{{-- ── 6. SQUARE FOOTAGE ────────────────────────────────────── --}}
<div>
  <h3 class="text-sm font-semibold text-slate-800 mb-3">Square Footage</h3>
  <div class="space-y-3">
    <div>
      <label class="text-xs text-slate-500 mb-1 block">Min sqft</label>
      <input type="number" name="sqft_min" placeholder="e.g. 1000"
             value="{{ request('sqft_min') }}"
             class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm text-slate-700 outline-none focus:border-cyan-400 transition-colors" />
    </div>
    <div>
      <label class="text-xs text-slate-500 mb-1 block">Max sqft</label>
      <input type="number" name="sqft_max" placeholder="No limit"
             value="{{ request('sqft_max') }}"
             class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm text-slate-700 outline-none focus:border-cyan-400 transition-colors" />
    </div>
  </div>
</div>

<hr class="border-slate-100">

{{-- ── 7. AMENITIES ─────────────────────────────────────────── --}}
<div>
  <h3 class="text-sm font-semibold text-slate-800 mb-3">Amenities</h3>
  <div class="space-y-2">
    @php
      $amenities = [
        'pool'       => 'Swimming Pool',
        'garage'     => 'Garage / Parking',
        'gym'        => 'Gym / Fitness',
        'garden'     => 'Garden / Yard',
        'waterfront' => 'Waterfront',
        'elevator'   => 'Elevator',
        'fireplace'  => 'Fireplace',
      ];
    @endphp
    @foreach ($amenities as $value => $label)
      <label class="flex items-center gap-2.5 cursor-pointer group">
        <input type="checkbox" name="amenities[]" value="{{ $value }}"
               {{ in_array($value, (array) request('amenities', [])) ? 'checked' : '' }}
               class="w-4 h-4 accent-cyan-600 cursor-pointer rounded" />
        <span class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">{{ $label }}</span>
      </label>
    @endforeach
  </div>
</div>


{{-- ── FILTER CHIP JS (beds / baths toggle) ────────────────── --}}
{{-- Only injected once; guard prevents duplicate scripts when --}}
{{-- the partial is included in both sidebar and drawer.       --}}
@once
<script>
  (function () {
    document.querySelectorAll('.filter-chip').forEach(function (btn) {
      btn.addEventListener('click', function () {
        const group = btn.dataset.filterGroup;
        const val   = btn.dataset.filterValue;

        // Deactivate all chips in the same group (both sidebar + drawer)
        document.querySelectorAll('[data-filter-group="' + group + '"]').forEach(function (b) {
          b.classList.remove('bg-cyan-600', 'text-white', 'border-cyan-600');
          b.classList.add('bg-white', 'text-slate-600', 'border-slate-200');
        });

        // Activate clicked chip (and its mirror in the other panel)
        document.querySelectorAll(
          '[data-filter-group="' + group + '"][data-filter-value="' + val + '"]'
        ).forEach(function (b) {
          b.classList.add('bg-cyan-600', 'text-white', 'border-cyan-600');
          b.classList.remove('bg-white', 'text-slate-600', 'border-slate-200');
        });

        // Sync hidden inputs
        document.querySelectorAll('#filter-' + group).forEach(function (inp) {
          inp.value = val;
        });
      });
    });
  })();
</script>
@endonce