@php
    $photo = $listing->listingphotos->first();
    $imgSrc = $photo
        ? asset('uploads/listing_photos/' . $photo->filename)
        : asset('images/no-image.jpg');
    $isApproved = strtolower($listing->status ?? '') === 'approved';
@endphp

<div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 overflow-hidden">

    {{-- Top meta bar --}}
    <div class="flex items-center justify-between px-4 py-2 border-b border-gray-50 dark:border-white/5">
        <span class="text-xs text-gray-400 dark:text-gray-500">
            Listing created by:
            <span class="font-medium text-gray-600 dark:text-gray-300">
                {{ $listing->user->name ?? 'Unknown' }}
            </span>
        </span>
        <div class="flex items-center gap-3">
            <span class="text-xs text-gray-400">
                Updated {{ $listing->updated_at->diffForHumans() }}
            </span>
            <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-semibold
                {{ $isApproved
                    ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400'
                    : 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' }}">
                <span class="w-1.5 h-1.5 rounded-full {{ $isApproved ? 'bg-green-500' : 'bg-amber-500' }}"></span>
                {{ strtoupper($listing->status ?? 'Pending') }}
            </span>
        </div>
    </div>

    <div class="flex gap-0">

        {{-- Image + Action Buttons --}}
        <div class="flex flex-col" style="width: 200px; flex-shrink: 0;">
            <div class="relative" style="height: 140px;">
                <img src="{{ $imgSrc }}"
                     alt="{{ $listing->title }}"
                     class="w-full h-full object-cover"
                     onerror="this.src='{{ asset('assets/images/no-image.png') }}'"/>
                @if($listing->propertystatus)
                    <div class="absolute top-2 left-2">
                        <span class="bg-blue-600 text-white text-xs font-semibold px-2 py-0.5 rounded">
                            {{ $listing->propertystatus }}
                        </span>
                    </div>
                @endif
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-col">
                <a href="{{ route('listing.edit', ['id' => $listing->id]) }}"
                   class="text-center text-xs font-semibold text-white bg-amber-500 hover:bg-amber-600 py-2 transition-colors">
                    Edit Listing
                </a>
                <a href="{{ route('listing.photos', ['id' => $listing->id]) }}"
                   class="text-center text-xs font-semibold text-white bg-teal-500 hover:bg-teal-600 py-2 transition-colors">
                    Upload Photos
                </a>
                <a href="{{ route('listings.index', ['recommended' => 'yes']) }}"
                   class="text-center text-xs font-semibold text-white bg-cyan-500 hover:bg-cyan-600 py-2 transition-colors">
                    Recommend
                </a>
                {{ html()->form('DELETE')->route('listing.destroy', $listing->id)->class('block')->open() }}
                    <button type="submit"
                            onclick="return confirm('Delete \'{{ addslashes($listing->title) }}\'?')"
                            class="w-full text-xs font-semibold text-white bg-red-500 hover:bg-red-600 py-2 transition-colors">
                        Delete
                    </button>
                {{ html()->form()->close() }}
            </div>
        </div>

        {{-- Listing Content --}}
        <div class="flex-1 min-w-0 p-4">
            <h3 class="font-bold text-gray-800 dark:text-white text-sm leading-snug mb-1 line-clamp-2">
                {{ $listing->title }}
            </h3>

            @if($listing->propertystatus)
                <span class="inline-block text-xs text-gray-500 dark:text-gray-400 mb-1">
                    &bull; {{ $listing->propertystatus }}
                </span>
            @endif

            @if($listing->address)
                <p class="flex items-center gap-1 text-xs text-gray-500 dark:text-gray-400 mb-2">
                    <svg class="w-3.5 h-3.5 text-red-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                    {{ $listing->address }}
                </p>
            @endif

            <p class="text-base font-bold text-red-500 mb-2">
                Total Price: &#8369; {{ number_format($listing->totalprice, 2) }}
            </p>

            @if($listing->description)
                <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2 mb-3">
                    {{ $listing->description }}
                </p>
            @endif

            {{-- Property Stats --}}
            <div class="grid grid-cols-3 gap-2 pt-2 border-t border-gray-100 dark:border-white/10 text-xs">
                <div class="flex items-center gap-1.5 text-gray-600 dark:text-gray-300">
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                    </svg>
                    <span>Lot: {{ number_format($listing->lotarea, 2) }} sqm</span>
                </div>
                <div class="flex items-center gap-1.5 text-gray-600 dark:text-gray-300">
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span>Floor: {{ number_format($listing->floorarea, 2) }} sqm</span>
                </div>
                <div></div>
                <div class="flex items-center gap-1.5 text-gray-600 dark:text-gray-300">
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Bed: {{ $listing->bedroom }}</span>
                </div>
                <div class="flex items-center gap-1.5 text-gray-600 dark:text-gray-300">
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Bath: {{ $listing->bathroom }}</span>
                </div>
                <div class="flex items-center gap-1.5 text-gray-600 dark:text-gray-300">
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2 2M5 16h7m0 0l2 2m-2-2V6"/>
                    </svg>
                    <span>Garage: {{ $listing->garage }}</span>
                </div>
            </div>
        </div>

    </div>
</div>
