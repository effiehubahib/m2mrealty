@extends('layouts.dashboard')

@section('content')
    @include('partials.alert')

    {{-- Page Header --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Properties</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                List of <span class="font-semibold text-blue-600">"{{ $categoryname }}"</span> Properties
                &mdash; {{ $listings->total() }} total
            </p>
        </div>
        <a href="{{ route('listing.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-red-500 hover:bg-red-600 px-4 py-2.5 text-sm font-semibold text-white shadow transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add New Listing
        </a>
    </div>

    {{-- ── Search / Filter Bar ─────────────────────────────────────── --}}
    <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-5 mb-6">
        <form id="listings-search-form" action="{{ route('listings.index') }}" method="GET">
            <div class="flex flex-wrap gap-3 items-end">

                {{-- Keyword --}}
                <div class="flex-1 min-w-40">
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Search</label>
                    <input type="text"
                           name="searchlisting"
                           value="{{ request('searchlisting') }}"
                           placeholder="Find Properties..."
                           class="w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white placeholder-gray-400 outline-none focus:border-blue-400 transition-colors"/>
                </div>

                {{-- Category --}}
                <div class="min-w-40">
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Category</label>
                    <select name="category"
                            class="w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors">
                        <option value="">All Categories</option>
                        @foreach($categoriesChoice as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @foreach($cat->children as $child)
                                <option value="{{ $child->id }}" {{ request('category') == $child->id ? 'selected' : '' }}>
                                    &nbsp;&nbsp; {{ $child->name }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                {{-- Sort By --}}
                <div class="min-w-36">
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Sort By</label>
                    <select name="orderby"
                            class="w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors">
                        <option value="id-desc" {{ $orderby === 'id-desc' ? 'selected' : '' }}>Latest by ID</option>
                        <option value="id-asc" {{ $orderby === 'id-asc' ? 'selected' : '' }}>Oldest by ID</option>
                        <option value="name" {{ $orderby === 'name' ? 'selected' : '' }}>Name A–Z</option>
                        <option value="updated-asc" {{ $orderby === 'updated-asc' ? 'selected' : '' }}>Oldest Updated</option>
                    </select>
                </div>

                {{-- Price Range --}}
                <div class="min-w-48">
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Price Range (₱)</label>
                    <div class="flex gap-2">
                        <input type="number" name="minpropertyprice"
                               value="{{ $minpropertyprice }}"
                               placeholder="Min"
                               class="w-1/2 rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-2 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors"/>
                        <input type="number" name="maxpropertyprice"
                               value="{{ $maxpropertyprice }}"
                               placeholder="Max"
                               class="w-1/2 rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-2 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors"/>
                    </div>
                </div>

                {{-- Quick Filters + Actions --}}
                <div class="flex items-center gap-2 flex-wrap">
                    <a href="{{ route('listings.index', ['recommended' => 'yes']) }}"
                       class="inline-flex items-center gap-1 text-xs px-2.5 py-2 rounded-lg border
                           {{ request('recommended') === 'yes'
                               ? 'bg-blue-600 text-white border-blue-600'
                               : 'border-gray-200 text-gray-500 hover:border-blue-400 hover:text-blue-500 dark:border-white/15 dark:text-gray-400' }}">
                        Recommended
                    </a>
                    <a href="{{ route('listings.index', ['mylisting' => '1']) }}"
                       class="inline-flex items-center gap-1 text-xs px-2.5 py-2 rounded-lg border
                           {{ request('mylisting') === '1'
                               ? 'bg-blue-600 text-white border-blue-600'
                               : 'border-gray-200 text-gray-500 hover:border-blue-400 hover:text-blue-500 dark:border-white/15 dark:text-gray-400' }}">
                        My Listings
                    </a>
                    <button type="submit"
                            class="rounded-lg bg-blue-600 hover:bg-blue-700 px-4 py-2 text-sm font-semibold text-white transition-colors">
                        Search
                    </button>
                    @if(request()->hasAny(['searchlisting','category','orderby','minpropertyprice','maxpropertyprice','recommended','mylisting']))
                        <a href="{{ route('listings.index') }}"
                           class="text-xs text-gray-400 hover:text-red-500 transition-colors">
                            Clear
                        </a>
                    @endif
                </div>

            </div>
        </form>
    </div>

    {{-- ── Listings ─────────────────────────────────────────────────── --}}
    <div id="listings-container" class="space-y-4">

        @forelse ($listings as $listing)
            @include('listings.partials.card', ['listing' => $listing])
        @empty
            <div id="empty-state" class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-12 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <p class="text-gray-400 font-medium">No listings found.</p>
                <p class="text-gray-300 text-sm mt-1">Try adjusting your search filters.</p>
            </div>
        @endforelse

    </div>

    {{-- Scroll sentinel + loading indicator --}}
    <div id="scroll-sentinel" class="h-4 mt-4"></div>

    <div id="loading-indicator" class="hidden flex justify-center items-center gap-3 py-6 text-sm text-gray-400 dark:text-gray-500">
        <svg class="w-5 h-5 animate-spin text-blue-500" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
        </svg>
        Loading more listings…
    </div>

    <div id="end-of-results" class="hidden text-center py-6 text-xs text-gray-400 dark:text-gray-500">
        All listings loaded.
    </div>
@endsection

@push('header-css')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push('footer-scripts')
<script>
(function () {
    const CACHE_KEY = 'listings_cache';

    let currentPage   = {{ $listings->currentPage() }};
    let hasMorePages  = {{ $listings->hasMorePages() ? 'true' : 'false' }};
    let isLoading     = false;
    let fromCache     = false;

    const container = document.getElementById('listings-container');
    const sentinel  = document.getElementById('scroll-sentinel');
    const loader    = document.getElementById('loading-indicator');
    const endMsg    = document.getElementById('end-of-results');

    // Cache key is the active filters (URL params without page)
    function filterKey() {
        const p = new URLSearchParams(window.location.search);
        p.delete('page');
        return p.toString();
    }

    function saveCache() {
        try {
            sessionStorage.setItem(CACHE_KEY, JSON.stringify({
                filterKey: filterKey(),
                page: currentPage,
                hasMorePages: hasMorePages,
                html: container.innerHTML,
            }));
        } catch (e) { /* quota exceeded — silently skip */ }
    }

    // Restore from cache if filters haven't changed
    try {
        const raw = sessionStorage.getItem(CACHE_KEY);
        if (raw) {
            const cached = JSON.parse(raw);
            if (cached.filterKey === filterKey()) {
                container.innerHTML = cached.html;
                currentPage  = cached.page;
                hasMorePages = cached.hasMorePages;
                fromCache    = true;
            }
        }
    } catch (e) {}

    // Persist the initial server render on first visit
    if (!fromCache) {
        saveCache();
    }

    // Wire up end state
    if (!hasMorePages) {
        if (sentinel) { sentinel.remove(); }
        endMsg.classList.remove('hidden');
    }

    // Observe sentinel for infinite scroll
    const observer = new IntersectionObserver(function (entries) {
        if (entries[0].isIntersecting && hasMorePages && !isLoading) {
            loadMore();
        }
    }, { rootMargin: '200px' });

    if (sentinel && hasMorePages) {
        observer.observe(sentinel);
    }

    function loadMore() {
        isLoading = true;
        loader.classList.remove('hidden');

        const params = new URLSearchParams(window.location.search);
        params.set('page', currentPage + 1);

        fetch('{{ route('listings.index') }}?' + params.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(function (res) { return res.json(); })
        .then(function (data) {
            container.insertAdjacentHTML('beforeend', data.html);
            currentPage++;
            hasMorePages = data.hasMorePages;
            isLoading    = false;
            loader.classList.add('hidden');
            saveCache();

            if (!hasMorePages) {
                observer.disconnect();
                if (sentinel) { sentinel.remove(); }
                endMsg.classList.remove('hidden');
            }
        })
        .catch(function () {
            isLoading = false;
            loader.classList.add('hidden');
        });
    }

    // Clear cache when the search form is submitted so fresh results load
    const searchForm = document.querySelector('#listings-search-form');
    if (searchForm) {
        searchForm.addEventListener('submit', function () {
            try { sessionStorage.removeItem(CACHE_KEY); } catch (e) {}
        });
    }
})();
</script>
@endpush
