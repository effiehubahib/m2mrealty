@extends('layouts.dashboard')

@section('content')
    @include('partials.alert')

    {{-- Page Header --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Add New Listing</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Fill in the details to create a new property listing.</p>
        </div>
        <a href="{{ route('listings.index') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-gray-500 hover:bg-gray-600 px-4 py-2.5 text-sm font-semibold text-white shadow transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Listings
        </a>
    </div>

    {{ html()->form('POST')->route('listing.store')->attribute('enctype', 'multipart/form-data')->class('space-y-6')->open() }}

        {{-- Basic Information --}}
        <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6">
            <h2 class="text-sm font-bold text-gray-700 dark:text-white mb-5 flex items-center gap-2">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Basic Information
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                <div class="lg:col-span-3">
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Listing Title <span class="text-red-500">*</span></label>
                    {!! html()->text('title', old('title'))
                        ->placeholder('e.g. 3-Bedroom House in Quezon City')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors')
                        ->required() !!}
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Category</label>
                    <select name="categoryid" class="w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors">
                        <option value="">Select Category</option>
                        @foreach($categoriesChoice as $cat)
                            <option value="{{ $cat->id }}" {{ old('categoryid') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @foreach($cat->children as $child)
                                <option value="{{ $child->id }}" {{ old('categoryid') == $child->id ? 'selected' : '' }}>
                                    &nbsp;&nbsp;&nbsp; {{ $child->name }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Property Type</label>
                    <select name="propertytype" class="w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors">
                        <option value="">Select Type</option>
                        @foreach(['House and Lot', 'Condominium', 'Townhouse', 'Lot Only', 'Commercial', 'Warehouse', 'Farm Lot'] as $type)
                            <option value="{{ $type }}" {{ old('propertytype') == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Property Status</label>
                    <select name="propertystatus" class="w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors">
                        <option value="">Select Status</option>
                        @foreach(['Pre-selling', 'Ready for Occupancy', 'For Sale', 'For Rent', 'Rent to Own', 'Foreclosed'] as $ps)
                            <option value="{{ $ps }}" {{ old('propertystatus') == $ps ? 'selected' : '' }}>{{ $ps }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Model Name</label>
                    {!! html()->text('model', old('model'))
                        ->placeholder('e.g. Amara Model')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors') !!}
                </div>

                <div class="flex items-center gap-2 pt-4">
                    <input type="checkbox" name="exclusive" id="exclusive" value="1"
                           {{ old('exclusive') ? 'checked' : '' }}
                           class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500"/>
                    <label for="exclusive" class="text-sm font-medium text-gray-700 dark:text-gray-300">Exclusive Listing</label>
                </div>

            </div>
        </div>

        {{-- Location --}}
        <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6">
            <h2 class="text-sm font-bold text-gray-700 dark:text-white mb-5 flex items-center gap-2">
                <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
                Location
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                <div class="lg:col-span-3">
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Full Address</label>
                    {!! html()->text('address', old('address'))
                        ->placeholder('Street, Subdivision, City, Province')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors') !!}
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Region</label>
                    <select name="region_id" id="region_id"
                            class="w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors">
                        <option value="">Select Region</option>
                        @foreach($regions as $code => $name)
                            <option value="{{ $code }}" {{ old('region_id') == $code ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Province</label>
                    <select name="province_id" id="province_id"
                            class="w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors">
                        <option value="">Select Province</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">City / Municipality</label>
                    <select name="city" id="city"
                            class="w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors">
                        <option value="">Select City</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Barangay</label>
                    <select name="barangay" id="barangay"
                            class="w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors">
                        <option value="">Select Barangay</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Latitude</label>
                    {!! html()->text('latitude', old('latitude'))
                        ->placeholder('e.g. 14.5995')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors') !!}
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Longitude</label>
                    {!! html()->text('longitude', old('longitude'))
                        ->placeholder('e.g. 120.9842')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors') !!}
                </div>

            </div>
        </div>

        {{-- Property Details --}}
        <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6">
            <h2 class="text-sm font-bold text-gray-700 dark:text-white mb-5 flex items-center gap-2">
                <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Property Details
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Lot Area (sqm) <span class="text-red-500">*</span></label>
                    {!! html()->number('lotarea', old('lotarea'))
                        ->placeholder('0.00')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors')
                        ->attribute('step', '0.01')
                        ->required() !!}
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Floor Area (sqm) <span class="text-red-500">*</span></label>
                    {!! html()->number('floorarea', old('floorarea'))
                        ->placeholder('0.00')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors')
                        ->attribute('step', '0.01')
                        ->required() !!}
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Bedrooms <span class="text-red-500">*</span></label>
                    {!! html()->number('bedroom', old('bedroom', 0))
                        ->placeholder('0')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors')
                        ->attribute('min', '0')
                        ->required() !!}
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Bathrooms <span class="text-red-500">*</span></label>
                    {!! html()->number('bathroom', old('bathroom', 0))
                        ->placeholder('0')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors')
                        ->attribute('min', '0')
                        ->required() !!}
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Garage Slots</label>
                    {!! html()->number('garage', old('garage', 0))
                        ->placeholder('0')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors')
                        ->attribute('min', '0') !!}
                </div>

            </div>
        </div>

        {{-- Pricing --}}
        <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6">
            <h2 class="text-sm font-bold text-gray-700 dark:text-white mb-5 flex items-center gap-2">
                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Pricing
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Total Price (₱) <span class="text-red-500">*</span></label>
                    {!! html()->number('totalprice', old('totalprice'))
                        ->placeholder('0.00')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors')
                        ->attribute('step', '0.01')
                        ->required() !!}
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Monthly Amortization (₱)</label>
                    {!! html()->number('monthlyamortization', old('monthlyamortization'))
                        ->placeholder('0.00')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors')
                        ->attribute('step', '0.01') !!}
                </div>

            </div>
        </div>

        {{-- Description & Media --}}
        <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6">
            <h2 class="text-sm font-bold text-gray-700 dark:text-white mb-5 flex items-center gap-2">
                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                </svg>
                Description & Media
            </h2>
            <div class="space-y-4">

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Description</label>
                    {!! html()->textarea('description', old('description'))
                        ->placeholder('Describe the property...')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors resize-none')
                        ->attribute('rows', '4') !!}
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                   
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Meta Keywords</label>
                        {!! html()->text('meta_keywords', old('meta_keywords'))
                            ->placeholder('e.g. house, lot, quezon city')
                            ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors') !!}
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Sample Computation</label>
                    {!! html()->textarea('samplecomputation', old('samplecomputation'))
                        ->placeholder('Enter sample payment computation...')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors resize-none')
                        ->attribute('rows', '3') !!}
                </div>

            </div>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('listings.index') }}"
               class="rounded-lg border border-gray-200 dark:border-white/15 px-5 py-2.5 text-sm font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                Cancel
            </a>
            <button type="submit"
                    class="rounded-lg bg-red-500 hover:bg-red-600 px-5 py-2.5 text-sm font-semibold text-white shadow transition-colors">
                Create Listing
            </button>
        </div>

    {{ html()->form()->close() }}

@endsection

@push('footer-scripts')
<script>
    document.getElementById('region_id').addEventListener('change', function () {
        if (!this.value) { return; }
        fetch('{{ route('select-province-by-region-id') }}?regCode=' + this.value)
            .then(r => r.json())
            .then(data => {
                const sel = document.getElementById('province_id');
                sel.innerHTML = '<option value="">Select Province</option>';
                Object.entries(data).forEach(([val, label]) => {
                    sel.innerHTML += `<option value="${val}">${label}</option>`;
                });
                document.getElementById('city').innerHTML = '<option value="">Select City</option>';
                document.getElementById('barangay').innerHTML = '<option value="">Select Barangay</option>';
            });
    });

    document.getElementById('province_id').addEventListener('change', function () {
        if (!this.value) { return; }
        fetch('{{ route('select-citymun-by-province-id') }}?provCode=' + this.value)
            .then(r => r.json())
            .then(data => {
                const sel = document.getElementById('city');
                sel.innerHTML = '<option value="">Select City</option>';
                Object.entries(data).forEach(([val, label]) => {
                    sel.innerHTML += `<option value="${val}">${label}</option>`;
                });
                document.getElementById('barangay').innerHTML = '<option value="">Select Barangay</option>';
            });
    });

    document.getElementById('city').addEventListener('change', function () {
        if (!this.value) { return; }
        fetch('{{ route('select-barangay-by-citymun-id') }}?citymunCode=' + this.value)
            .then(r => r.json())
            .then(data => {
                const sel = document.getElementById('barangay');
                sel.innerHTML = '<option value="">Select Barangay</option>';
                Object.entries(data).forEach(([val, label]) => {
                    sel.innerHTML += `<option value="${val}">${label}</option>`;
                });
            });
    });
</script>
@endpush
