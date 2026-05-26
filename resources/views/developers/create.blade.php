@extends('layouts.dashboard')

@section('content')
    @include('partials.alert')

    {{-- Page Header --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Add New Developer</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Fill in the details to create a new developer profile.</p>
        </div>
        <a href="{{ route('developers.index') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-gray-500 hover:bg-gray-600 px-4 py-2.5 text-sm font-semibold text-white shadow transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Developers
        </a>
    </div>

    {{ html()->form('POST')->route('developer.store')->attribute('enctype', 'multipart/form-data')->class('space-y-6')->open() }}

        {{-- Basic Information --}}
        <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6">
            <h2 class="text-sm font-bold text-gray-700 dark:text-white mb-5 flex items-center gap-2">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Developer Information
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                <div class="lg:col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Developer Name <span class="text-red-500">*</span></label>
                    {!! html()->text('developername', old('developername'))
                        ->placeholder('e.g. Ayala Land Inc.')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors')
                        ->required() !!}
                    @error('developername')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Status</label>
                    <select name="status" class="w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors">
                        <option value="0" {{ old('status', '0') == '0' ? 'selected' : '' }}>Inactive</option>
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Website</label>
                    {!! html()->url('website', old('website'))
                        ->placeholder('https://example.com')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors') !!}
                    @error('website')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Facebook Page</label>
                    {!! html()->url('facebooklink', old('facebooklink'))
                        ->placeholder('https://facebook.com/...')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors') !!}
                    @error('facebooklink')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="lg:col-span-3">
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Logo</label>
                    <input type="file" name="logo" accept="image/*"
                           class="w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors
                                  file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                    <p class="text-xs text-gray-400 mt-1">JPG, PNG, SVG — max 4 MB</p>
                    @error('logo')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- Contact Information --}}
        <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6">
            <h2 class="text-sm font-bold text-gray-700 dark:text-white mb-5 flex items-center gap-2">
                <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Contact Information
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Contact Person</label>
                    {!! html()->text('contactperson', old('contactperson'))
                        ->placeholder('e.g. Juan dela Cruz')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors') !!}
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Email</label>
                    {!! html()->email('email', old('email'))
                        ->placeholder('info@developer.com')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors') !!}
                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Mobile Number</label>
                    {!! html()->text('mobilenumber', old('mobilenumber'))
                        ->placeholder('e.g. 09xx xxx xxxx')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors') !!}
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Telephone Number</label>
                    {!! html()->text('telephonenumber', old('telephonenumber'))
                        ->placeholder('e.g. (02) 8xxx xxxx')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors') !!}
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1">Contact Number</label>
                    {!! html()->text('contactnumber', old('contactnumber'))
                        ->placeholder('e.g. 09xx xxx xxxx')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors') !!}
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
                        ->placeholder('Street, City, Province')
                        ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors') !!}
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

        {{-- Description --}}
        <div class="bg-white dark:bg-darkblack-600 rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6">
            <h2 class="text-sm font-bold text-gray-700 dark:text-white mb-5 flex items-center gap-2">
                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                </svg>
                Description
            </h2>

            {!! html()->textarea('description', old('description'))
                ->placeholder('Describe the developer...')
                ->class('w-full rounded-lg border border-gray-200 dark:border-white/15 bg-gray-50 dark:bg-darkblack-500 px-3 py-2 text-sm text-gray-700 dark:text-white outline-none focus:border-blue-400 transition-colors resize-none')
                ->attribute('rows', '5') !!}
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('developers.index') }}"
               class="rounded-lg border border-gray-200 dark:border-white/15 px-5 py-2.5 text-sm font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                Cancel
            </a>
            <button type="submit"
                    class="rounded-lg bg-red-500 hover:bg-red-600 px-5 py-2.5 text-sm font-semibold text-white shadow transition-colors">
                Create Developer
            </button>
        </div>

    {{ html()->form()->close() }}

@endsection