@extends('layouts.app')
@section('content')
@include('partials.alert')
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Create new account</h2>
  </div>

  <div class="mt-10 md:mx-auto max-w-4xl">
    {{ html()->form('POST')->route('register',['view'=>'Year'])->class('bg-white shadow-xs outline outline-gray-900/5 sm:rounded-xl md:col-span-12')->id('registration')->open() }}
    
      <div class="px-4 py-6 sm:p-8">
        <div class="grid max-w-2xxl gap-x-6 gap-y-8 grid-cols-12">
            <div class="sm:col-span-6">
                <label for="city" class="block text-sm/6 font-medium text-gray-900">Email Address</label>
                <div class="mt-2">
                    {{ html()->text('email', old('email'))->class('col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6')->id('email')->placeholder('Email address')}}
                </div>
            </div>
           
            <div class="sm:col-span-6">
                    <div class="flex items-center">
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                    </div>
                    <div class="relative mt-2">
                        <div class="absolute inset-y-0 right-0 flex items-center px-2">
                        <input class="hidden js-password-toggle" id="toggle" type="checkbox" />
                        <label class=" rounded px-2 py-1 text-sm  font-mono cursor-pointer js-password-label" for="toggle">
                        <svg fill="#0498d7" width="23px" height="23px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#0498d7"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g data-name="Layer 2"> <g data-name="eye-off-2"> <rect width="24" height="24" opacity="0"></rect> <path d="M17.81 13.39A8.93 8.93 0 0 0 21 7.62a1 1 0 1 0-2-.24 7.07 7.07 0 0 1-14 0 1 1 0 1 0-2 .24 8.93 8.93 0 0 0 3.18 5.77l-2.3 2.32a1 1 0 0 0 1.41 1.41l2.61-2.6a9.06 9.06 0 0 0 3.1.92V19a1 1 0 0 0 2 0v-3.56a9.06 9.06 0 0 0 3.1-.92l2.61 2.6a1 1 0 0 0 1.41-1.41z"></path> </g> </g> </g></svg>
                        </label>
                        </div>
                          <div class="sm:col-span-6">
                
                            {{ html()->password('password', null)->class('col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 js-password')->id('email')->placeholder('Enter password')->required()}}
                
                        </div>
                    </div>
                </div>
            <div class="sm:col-span-4">
                <label for="first-name" class="block text-sm/6 font-medium text-gray-900">First name</label>
                <div class="mt-2">
                    {{ html()->text('firstname', old('firstname'))->class('col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6')->id('firstname')->placeholder('Firstname')->required()}}
                </div>
            </div>
            <div class="sm:col-span-4">
                <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Middlename</label>
                <div class="mt-2">
                    {{ html()->text('middlename', old('middlename'))->class('col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6')->id('middlename')->placeholder('Middlename')}}
                </div>
            </div>  
            <div class="sm:col-span-4">
                <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Lastname</label>
                <div class="mt-2">
                {{ html()->text('lastname', old('lastname'))->class('col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6')->id('lastname')->placeholder('Lastname')->required()}}
                </div>
            </div>
           
            <div class="sm:col-span-4">
                <label for="street-address" class="block text-sm/6 font-medium text-gray-900">Facebook URL</label>
                <div class="mt-2">
                    {{ html()->text('facebookurl', old('facebookurl'))->class('col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6')->id('facebookurl')->placeholder('Facebook URL')}}
                </div>
            </div>
            <div class="sm:col-span-4">
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Youtube URL</label>
                <div class="mt-2">
                    {{ html()->text('youtubeurl', old('youtubeurl'))->class('col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6')->id('youtubeurl')->placeholder('Youtube URL')}}
                </div>
            </div>
            <div class="sm:col-span-4">
                <label for="city" class="block text-sm/6 font-medium text-gray-900">Contact #:</label>
                <div class="mt-2">
                    {{ html()->text('contact_number', old('contact_number'))->class('col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6')->id('contact_number')->placeholder('Contact Number')}}
                </div>
            </div>
            <div class="sm:col-span-4">
                <label for="country" class="block text-sm/6 font-medium text-gray-900">Region</label>
                <div class="mt-2 grid grid-cols-1">
                    {{ html()->select('region_id', $regions,old('municipalname'))->id('region_id')->class('col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6')->placeholder('Region')->required() }}
                </div>
            </div>
            <div class="sm:col-span-4">
                <label for="country" class="block text-sm/6 font-medium text-gray-900">Province</label>
                <div class="mt-2 grid grid-cols-1">
                    {{ html()->select('province_id', null,old('province_id'))->id('province_id')->class('col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6')->placeholder('Select region first')->required() }}
                </div>
            </div>  
            <div class="sm:col-span-4">
                <label for="country" class="block text-sm/6 font-medium text-gray-900">City / Municipality</label>
                <div class="mt-2 grid grid-cols-1">
                    {{ html()->select('citymun_id', null,old('citymun_id'))->id('citymun_id')->class('col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6')->placeholder('Select province first')->required() }}
                </div>
            </div> 
            <div class="sm:col-span-4">
                <label for="city" class="block text-sm/6 font-medium text-gray-900">Marital Status</label>
                <div class="mt-2">
                    {{ html()->select('maritalstatus', ['Single'=>'Single','Married'=>'Married','Widow'=>'Widow','Widower'=>'Widower'],old('maritalstatus'))->id('maritalstatus')->class('col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6')->placeholder('Select status')->required() }}
                </div>
            </div>
           

            <div class="sm:col-span-4">
                <label for="city" class="block text-sm/6 font-medium text-gray-900">Gender</label>
                <div class="mt-2">
                    {{ html()->select('gender', [0=>'Female',1=>'Male'],old('gender'))->id('gender')->class('col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6')->placeholder('Select gender')->required() }}
                </div>
            </div>
        </div>
      </div>

      <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
      </div>
    {{ html()->form()->close() }}

    <p class="mt-10 text-center text-sm/6 text-gray-500">
      Has an account?
      <a href="{{route('login')}}" class="font-semibold text-indigo-600 hover:text-indigo-500">Login now</a>
    </p>
  </div>
</div>

@endsection
@push('header-css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('footer-scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    var regionSelect = $('#region_id');
    var provinceSelect = $('#province_id');
        provinceSelect.select2();
    var citymunSelect = $('#citymun_id');
        citymunSelect.select2();
     regionSelect.select2({
        placeholder: "Select Province",
        width:'100%',
        allowClear:true,
    });
    regionSelect.change(function(){
        var region_id = $(this).val();
        populateProvinceSelect(region_id);
    });
    provinceSelect.change(function(){
        var province_id = $(this).val();
        populateCityMunSelect(province_id);
    });
    const passwordToggle = document.querySelector('.js-password-toggle')

    passwordToggle.addEventListener('change', function() {
    const password = document.querySelector('.js-password'),
        passwordLabel = document.querySelector('.js-password-label')

    if (password.type === 'password') {
        password.type = 'text'
        passwordLabel.innerHTML = '<svg viewBox="0 0 24.00 24.00" width="25px" height="25px" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="1.9200000000000004"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.8160000000000001"> <path d="M4 12C4 12 5.6 7 12 7M12 7C18.4 7 20 12 20 12M12 7V4M18 5L16 7.5M6 5L8 7.5M15 13C15 14.6569 13.6569 16 12 16C10.3431 16 9 14.6569 9 13C9 11.3431 10.3431 10 12 10C13.6569 10 15 11.3431 15 13Z" stroke="#0498d7" stroke-linecap="round" stroke-linejoin="round"></path> </g><g id="SVGRepo_iconCarrier"> <path d="M4 12C4 12 5.6 7 12 7M12 7C18.4 7 20 12 20 12M12 7V4M18 5L16 7.5M6 5L8 7.5M15 13C15 14.6569 13.6569 16 12 16C10.3431 16 9 14.6569 9 13C9 11.3431 10.3431 10 12 10C13.6569 10 15 11.3431 15 13Z" stroke="#0498d7" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>'
    
    } else {
        password.type = 'password'
        passwordLabel.innerHTML = '<svg fill="#0498d7" width="23px" height="23px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#0498d7"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g data-name="Layer 2"> <g data-name="eye-off-2"> <rect width="24" height="24" opacity="0"></rect> <path d="M17.81 13.39A8.93 8.93 0 0 0 21 7.62a1 1 0 1 0-2-.24 7.07 7.07 0 0 1-14 0 1 1 0 1 0-2 .24 8.93 8.93 0 0 0 3.18 5.77l-2.3 2.32a1 1 0 0 0 1.41 1.41l2.61-2.6a9.06 9.06 0 0 0 3.1.92V19a1 1 0 0 0 2 0v-3.56a9.06 9.06 0 0 0 3.1-.92l2.61 2.6a1 1 0 0 0 1.41-1.41z"></path> </g> </g> </g></svg>'
    
    }

    password.focus()
    })
    function populateProvinceSelect(region_id) {
        // Clear existing options
        provinceSelect.empty();
        // Send an AJAX request to fetch options based on the selected value
        $.ajax({
            url: "{{route('select-province-by-region-id')}}", 
            method: 'GET',
            data: { region_id: region_id }, // Pass the selected value to the API
            dataType: 'json',
            success: function(data) {
                // Populate options in the second select based on the response data
                $.each(data, function(index, option) {
                    provinceSelect.append('<option value="' + option.id + '">' + option.provDesc + '</option>');
                });

                // Refresh the Select2 widget for the second select to update its appearance
                provinceSelect.trigger('change.select2');
            },
            error: function() {
                console.error('Error fetching options from the server.');
            }
        });
    }
    function populateCityMunSelect(province_id) {
        // Clear existing options
       citymunSelect.empty();
        // Send an AJAX request to fetch options based on the selected value
        $.ajax({
            url: "{{route('select-citymun-by-province-id')}}", 
            method: 'GET',
            data: { province_id: province_id }, // Pass the selected value to the API
            dataType: 'json',
            success: function(data) {
                // Populate options in the second select based on the response data
                $.each(data, function(index, option) {
                    citymunSelect.append('<option value="' + option.id + '">' + option.citymunDesc + '</option>');
                });

                // Refresh the Select2 widget for the second select to update its appearance
                citymunSelect.trigger('change.select2');
            },
            error: function() {
                console.error('Error fetching options from the server.');
            }
        });
    }
</script>
@endpush