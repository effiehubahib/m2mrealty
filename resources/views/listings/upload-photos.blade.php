@extends('layouts.dashboard')

@section('content')
    @include('partials.alert')

    {{-- Page Header --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Upload Photos</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5 line-clamp-1">{{ $listing->title }}</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('listing.edit', $listing->id) }}"
               class="inline-flex items-center gap-2 rounded-lg bg-amber-500 hover:bg-amber-600 px-4 py-2.5 text-sm font-semibold text-white shadow transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Listing
            </a>
            <a href="{{ route('listings.index') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-gray-500 hover:bg-gray-600 px-4 py-2.5 text-sm font-semibold text-white shadow transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Listings
            </a>
        </div>
    </div>

    {{-- Upload Form --}}
    <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6 mb-6">
        <h2 class="text-sm font-bold text-gray-700 dark:text-white mb-5 flex items-center gap-2">
            <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
            </svg>
            Upload New Photos
        </h2>

        {{ html()->form('POST')->route('listing.photos.store', $listing->id)->attribute('enctype', 'multipart/form-data')->class('space-y-4')->open() }}

            {{-- Drop zone --}}
            <label for="photo-input"
                   id="drop-zone"
                   class="flex flex-col items-center justify-center w-full h-40 rounded-xl border-2 border-dashed border-gray-300 dark:border-white/20 bg-gray-50 dark:bg-darkblack-500 cursor-pointer hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/10 transition-colors">
                <svg class="w-10 h-10 text-gray-300 dark:text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Click to select photos</p>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">JPG, PNG, WEBP, GIF — max 5 MB each — multiple allowed</p>
                <input id="photo-input" type="file" name="photos[]" multiple accept="image/*" class="hidden"/>
            </label>

            {{-- Preview strip --}}
            <div id="preview-strip" class="hidden flex flex-wrap gap-3"></div>

            @error('photos')
                <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
            @error('photos.*')
                <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror

            <div class="flex items-center justify-end gap-3">
                <button type="button" id="clear-btn"
                        class="hidden rounded-lg border border-gray-200 dark:border-white/15 px-4 py-2 text-sm font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                    Clear
                </button>
                <button type="submit"
                        class="rounded-lg bg-teal-500 hover:bg-teal-600 px-5 py-2 text-sm font-semibold text-white shadow transition-colors">
                    Upload Photos
                </button>
            </div>

        {{ html()->form()->close() }}
    </div>

    {{-- Existing Photos --}}
    <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6">
        <h2 class="text-sm font-bold text-gray-700 dark:text-white mb-5 flex items-center gap-2">
            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
            Existing Photos
            <span class="ml-auto text-xs font-normal text-gray-400">{{ $listing->listingphotos->count() }} photo{{ $listing->listingphotos->count() !== 1 ? 's' : '' }}</span>
        </h2>

        @if($listing->listingphotos->isEmpty())
            <div class="flex flex-col items-center justify-center py-12 text-center">
                <svg class="w-12 h-12 text-gray-200 dark:text-gray-700 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-gray-400 font-medium text-sm">No photos yet</p>
                <p class="text-gray-300 text-xs mt-1">Upload photos above to get started.</p>
            </div>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($listing->listingphotos as $photo)
                    @php $isPrimary = (int) $photo->primaryphoto === 1; @endphp
                    <div class="group relative rounded-xl overflow-hidden border-2 transition-colors
                                {{ $isPrimary ? 'border-blue-500' : 'border-gray-100 dark:border-white/10' }}">

                        {{-- Thumbnail --}}
                        <div class="aspect-square bg-gray-100 dark:bg-darkblack-500">
                            <img src="{{ asset('uploads/listing_photos/' . $photo->filename) }}"
                                 alt="Listing photo"
                                 class="w-full h-full object-cover"
                                 onerror="this.src='{{ asset('assets/images/no-image.png') }}'"/>
                        </div>

                        {{-- Primary badge --}}
                        @if($isPrimary)
                            <div class="absolute top-2 left-2">
                                <span class="inline-flex items-center gap-1 rounded-full bg-blue-600 px-2 py-0.5 text-xs font-semibold text-white shadow">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    Primary
                                </span>
                            </div>
                        @endif

                        {{-- Hover overlay with actions --}}
                        <div class="absolute inset-0 flex flex-col items-center justify-end gap-2 p-3
                                    bg-gradient-to-t from-black/60 via-black/10 to-transparent
                                    opacity-0 group-hover:opacity-100 transition-opacity">

                            @if(! $isPrimary)
                                {{ html()->form('PATCH')->route('listing.photo.primary', $photo->id)->class('w-full')->open() }}
                                    <button type="submit"
                                            class="w-full rounded-md bg-blue-600 hover:bg-blue-700 px-2 py-1.5 text-xs font-semibold text-white transition-colors">
                                        Set as Primary
                                    </button>
                                {{ html()->form()->close() }}
                            @endif

                            {{ html()->form('DELETE')->route('listing.photo.destroy', $photo->id)->class('w-full')->open() }}
                                <button type="submit"
                                        onclick="return confirm('Delete this photo?')"
                                        class="w-full rounded-md bg-red-500 hover:bg-red-600 px-2 py-1.5 text-xs font-semibold text-white transition-colors">
                                    Delete
                                </button>
                            {{ html()->form()->close() }}

                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection

@push('footer-scripts')
<script>
(function () {
    const input    = document.getElementById('photo-input');
    const dropZone = document.getElementById('drop-zone');
    const preview  = document.getElementById('preview-strip');
    const clearBtn = document.getElementById('clear-btn');

    input.addEventListener('change', renderPreviews);
    clearBtn.addEventListener('click', function () {
        input.value = '';
        preview.innerHTML = '';
        preview.classList.add('hidden');
        clearBtn.classList.add('hidden');
    });

    // Drag-and-drop support
    dropZone.addEventListener('dragover', function (e) {
        e.preventDefault();
        dropZone.classList.add('border-blue-400', 'bg-blue-50');
    });
    dropZone.addEventListener('dragleave', function () {
        dropZone.classList.remove('border-blue-400', 'bg-blue-50');
    });
    dropZone.addEventListener('drop', function (e) {
        e.preventDefault();
        dropZone.classList.remove('border-blue-400', 'bg-blue-50');

        const dt = new DataTransfer();
        Array.from(e.dataTransfer.files).forEach(function (f) {
            if (f.type.startsWith('image/')) { dt.items.add(f); }
        });
        input.files = dt.files;
        renderPreviews();
    });

    function renderPreviews() {
        preview.innerHTML = '';
        if (!input.files.length) {
            preview.classList.add('hidden');
            clearBtn.classList.add('hidden');
            return;
        }

        Array.from(input.files).forEach(function (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const wrap = document.createElement('div');
                wrap.className = 'relative w-20 h-20 rounded-lg overflow-hidden border border-gray-200 dark:border-white/15 flex-shrink-0';
                wrap.innerHTML = '<img src="' + e.target.result + '" class="w-full h-full object-cover"/>'
                    + '<span class="absolute bottom-0 left-0 right-0 text-center text-white text-[9px] bg-black/50 px-1 truncate">' + file.name + '</span>';
                preview.appendChild(wrap);
            };
            reader.readAsDataURL(file);
        });

        preview.classList.remove('hidden');
        clearBtn.classList.remove('hidden');
    }
})();
</script>
@endpush
