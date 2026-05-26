@extends('layouts.dashboard')

@section('content')
    @include('partials.alert')

    {{-- Page Header --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white line-clamp-1">{{ $listing->title }}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5 flex items-center gap-2">
                @php $isApproved = strtolower($listing->status ?? '') === 'approved'; @endphp
                <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-semibold
                    {{ $isApproved
                        ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400'
                        : 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ $isApproved ? 'bg-green-500' : 'bg-amber-500' }}"></span>
                    {{ strtoupper($listing->status ?? 'Pending') }}
                </span>
                @if($listing->exclusive)
                    <span class="inline-flex items-center gap-1 rounded-full bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400 px-2.5 py-0.5 text-xs font-semibold">Exclusive</span>
                @endif
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('listing.edit', $listing->id) }}"
               class="inline-flex items-center gap-2 rounded-lg bg-amber-500 hover:bg-amber-600 px-4 py-2.5 text-sm font-semibold text-white shadow transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit
            </a>
            <a href="{{ route('listing.photos', $listing->id) }}"
               class="inline-flex items-center gap-2 rounded-lg bg-teal-500 hover:bg-teal-600 px-4 py-2.5 text-sm font-semibold text-white shadow transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Photos
            </a>
            <a href="{{ route('listings.index') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-gray-500 hover:bg-gray-600 px-4 py-2.5 text-sm font-semibold text-white shadow transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left Column --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Photo Gallery --}}
            <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 overflow-hidden">
                @php
                    $primaryPhoto = $listing->listingphotos->firstWhere('primaryphoto', 1)
                        ?? $listing->listingphotos->first();
                    $primarySrc = $primaryPhoto
                        ? asset('uploads/listing_photos/' . $primaryPhoto->filename)
                        : asset('assets/images/no-image.png');
                @endphp

                {{-- Main Image --}}
                <div class="relative bg-gray-100 dark:bg-darkblack-500" style="height: 360px;">
                    <img id="main-photo"
                         src="{{ $primarySrc }}"
                         alt="{{ $listing->title }}"
                         class="w-full h-full object-cover"
                         onerror="this.src='{{ asset('assets/images/no-image.png') }}'"/>

                    @if($listing->propertystatus)
                        <div class="absolute top-3 left-3">
                            <span class="bg-blue-600 text-white text-xs font-semibold px-2.5 py-1 rounded-lg shadow">
                                {{ $listing->propertystatus }}
                            </span>
                        </div>
                    @endif

                    <div class="absolute bottom-3 right-3 bg-black/50 text-white text-xs px-2 py-1 rounded-lg">
                        {{ $listing->listingphotos->count() }} photo{{ $listing->listingphotos->count() !== 1 ? 's' : '' }}
                    </div>
                </div>

                {{-- Thumbnail Strip --}}
                @if($listing->listingphotos->count() > 1)
                    <div class="flex gap-2 p-3 overflow-x-auto bg-gray-50 dark:bg-darkblack-500">
                        @foreach($listing->listingphotos as $photo)
                            <button type="button"
                                    onclick="document.getElementById('main-photo').src='{{ asset('uploads/listing_photos/' . $photo->filename) }}'"
                                    class="flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden border-2 transition-colors
                                           {{ (int)$photo->primaryphoto === 1 ? 'border-blue-500' : 'border-transparent hover:border-gray-300' }}">
                                <img src="{{ asset('uploads/listing_photos/' . $photo->filename) }}"
                                     alt=""
                                     class="w-full h-full object-cover"
                                     onerror="this.src='{{ asset('assets/images/no-image.png') }}'"/>
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Description --}}
            @if($listing->description)
                <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6">
                    <h2 class="text-sm font-bold text-gray-700 dark:text-white mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                        </svg>
                        Description
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed whitespace-pre-line">{{ $listing->description }}</p>
                </div>
            @endif

            {{-- Sample Computation --}}
            @if($listing->samplecomputation)
                <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6">
                    <h2 class="text-sm font-bold text-gray-700 dark:text-white mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M4 19h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Sample Computation
                    </h2>
                    <pre class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed whitespace-pre-wrap font-sans">{{ $listing->samplecomputation }}</pre>
                </div>
            @endif

        </div>

        {{-- Right Column --}}
        <div class="space-y-6">

            {{-- Pricing --}}
            <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6">
                <h2 class="text-sm font-bold text-gray-700 dark:text-white mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Pricing
                </h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-gray-400 dark:text-gray-500">Total Price</p>
                        <p class="text-2xl font-bold text-red-500">&#8369; {{ number_format($listing->totalprice, 2) }}</p>
                    </div>
                    @if($listing->monthlyamortization)
                        <div>
                            <p class="text-xs text-gray-400 dark:text-gray-500">Monthly Amortization</p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-white">&#8369; {{ number_format($listing->monthlyamortization, 2) }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Property Details --}}
            <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6">
                <h2 class="text-sm font-bold text-gray-700 dark:text-white mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Property Details
                </h2>
                <div class="space-y-2.5">
                    @if($listing->propertytype)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Type</span>
                            <span class="font-medium text-gray-700 dark:text-white">{{ $listing->propertytype }}</span>
                        </div>
                    @endif
                    @if($listing->model)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Model</span>
                            <span class="font-medium text-gray-700 dark:text-white">{{ $listing->model }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500 dark:text-gray-400">Lot Area</span>
                        <span class="font-medium text-gray-700 dark:text-white">{{ number_format($listing->lotarea, 2) }} sqm</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500 dark:text-gray-400">Floor Area</span>
                        <span class="font-medium text-gray-700 dark:text-white">{{ number_format($listing->floorarea, 2) }} sqm</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500 dark:text-gray-400">Bedrooms</span>
                        <span class="font-medium text-gray-700 dark:text-white">{{ $listing->bedroom }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500 dark:text-gray-400">Bathrooms</span>
                        <span class="font-medium text-gray-700 dark:text-white">{{ $listing->bathroom }}</span>
                    </div>
                    @if($listing->garage)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Garage</span>
                            <span class="font-medium text-gray-700 dark:text-white">{{ $listing->garage }} slot{{ $listing->garage != 1 ? 's' : '' }}</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Location --}}
            <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6">
                <h2 class="text-sm font-bold text-gray-700 dark:text-white mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                    Location
                </h2>
                <div class="space-y-2">
                    @if($listing->address)
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ $listing->address }}</p>
                    @endif
                    @if($listing->latitude && $listing->longitude)
                        <p class="text-xs text-gray-400 dark:text-gray-500">
                            {{ $listing->latitude }}, {{ $listing->longitude }}
                        </p>
                    @endif
                    @if(! $listing->address && ! $listing->latitude)
                        <p class="text-sm text-gray-400 italic">No location details</p>
                    @endif
                </div>
            </div>

            {{-- Meta --}}
            <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6">
                <h2 class="text-sm font-bold text-gray-700 dark:text-white mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Info
                </h2>
                <div class="space-y-2.5">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500 dark:text-gray-400">Created by</span>
                        <span class="font-medium text-gray-700 dark:text-white">{{ $listing->user->name ?? 'Unknown' }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500 dark:text-gray-400">Created</span>
                        <span class="font-medium text-gray-700 dark:text-white">{{ $listing->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500 dark:text-gray-400">Last updated</span>
                        <span class="font-medium text-gray-700 dark:text-white">{{ $listing->updated_at->diffForHumans() }}</span>
                    </div>
                    @if($listing->meta_keywords)
                        <div class="pt-2 border-t border-gray-100 dark:border-white/10">
                            <p class="text-xs text-gray-400 dark:text-gray-500 mb-1">Keywords</p>
                            <p class="text-xs text-gray-600 dark:text-gray-300">{{ $listing->meta_keywords }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Delete --}}
            <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-red-100 dark:border-red-900/20 p-6">
                <h2 class="text-sm font-bold text-red-600 dark:text-red-400 mb-3">Danger Zone</h2>
                {{ html()->form('DELETE')->route('listing.destroy', $listing->id)->open() }}
                    <button type="submit"
                            onclick="return confirm('Permanently delete \'{{ addslashes($listing->title) }}\'? This cannot be undone.')"
                            class="w-full rounded-lg bg-red-500 hover:bg-red-600 px-4 py-2.5 text-sm font-semibold text-white shadow transition-colors">
                        Delete Listing
                    </button>
                {{ html()->form()->close() }}
            </div>

        </div>
    </div>

@endsection
