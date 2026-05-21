@extends('layouts.dashboard')
@section('content')
@include('partials.alert')
<div class="block">
            <section class="mb-6 2xl:mb-0 shadow-lg">
                <div class="w-full rounded-lg bg-white px-[24px] py-[20px] dark:bg-darkblack-600">
                    <div class="justify-between sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold text-dgray-900 dark:text-bgray-50">Edit Downloadable: {{$downloadable->title}}</h1>
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <a href="{{route('downloadables.index')}}" class="block rounded-md px-3 py-2 text-center text-sm font-semibold text-white shadow-xs bg-branding hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">View Downloadables</a>
                        </div>
                    </div>
                    <div class="mt-8 flow-root">
                        @if($downloadable->uniquename)
                        <img src="{{ asset('images/logo/m2m-logo.svg') }}" alt="" class="inline-block size-14 rounded-md outline -outline-offset-1 outline-black/5 dark:outline-white/10" />
                        {{ html()->form('PATCH')->route('downloadable.destroy-file',$downloadable->id)->id('deleteForm')->class('inline space-y-6')->open() }}
                            <input type="submit" class="deleteBtn cursor-pointer text-red-600 hover:text-red-900 text-sm" value="Delete File" onclick="return confirm('Are you sure you want to delete file of {{$downloadable->title}} ?')"/>
                        {{ html()->form()->close() }}
                        @endif
                        {{ html()->form('PATCH')->route('downloadable.update',$downloadable->id)->id('update-downloadable-form')->attribute('enctype', 'multipart/form-data')->class('space-y-6')->open() }}    
                           
                            <div class="border-b border-gray-900/10 pb-12 mt-8">
                                <h2 class="text-base/7 font-semibold text-dgray-900 dark:text-bgray-50">Downloadable Information</h2>
                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                     <div class="sm:col-span-12">
                                        @if(!$downloadable->uniquename)
                                        <label for="title" class="block text-sm/6 font-medium text-dgray-900 dark:text-bgray-50">Upload File</label>
                                        <div class="mt-2">
                                            {!! html()->file('uploadfile', old('uploadfile'))->id('fileUpload')!!}
                                        </div>
                                        
                                        @endif
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="title" class="block text-sm/6 font-medium text-dgray-900 dark:text-bgray-50">Downloadable Title</label>
                                        <div class="mt-2">
                                            {!! html()->text('title', old('title',$downloadable->title))->placeholder('Title')->class('block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6')->required() !!}
                                        </div>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="gtin" class="block text-sm/6 font-medium text-dgray-900 dark:text-bgray-50">Description </label>
                                        <div class="mt-2">
                                            {!! html()->text('description', old('description',$downloadable->description))->placeholder('Short Description')->class('block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                <a href="{{url()->previous()}}" class="text-sm/6 font-semibold text-dgray-900">Cancel</a>
                                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                            </div>
                        {{ html()->form()->close() }}
                    </div>
                </div>

            </section>
            

            
</div>

@endsection
@push('header-css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <style>
        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 0px auto;
            .avatar-edit {
                position: absolute;
                right: 12px;
                z-index: 1;
                top: 10px;
                input {
                    display: none;
                    + label {
                        display: inline-block;
                        width: 34px;
                        height: 34px;
                        margin-bottom: 0;
                        border-radius: 100%;
                        background: #FFFFFF;
                        border: 1px solid transparent;
                        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
                        cursor: pointer;
                        font-weight: normal;
                        transition: all .2s ease-in-out;
                        &:hover {
                            background: #f1f1f1;
                            border-color: #d6d6d6;
                        }
                        &:after {
                            content: "\f040";
                            font-family: 'FontAwesome';
                            color: #757575;
                            position: absolute;
                            top: 10px;
                            left: 0;
                            right: 0;
                            text-align: center;
                            margin: auto;
                        }
                    }
                }
            }
            .avatar-preview {
                width: 150px;
                height: 150px;
                position: relative;
                border-radius: 100%;
                border: 6px solid #F8F8F8;
                box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
                > div {
                    width: 100%;
                    height: 100%;
                    border-radius: 100%;
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-position: center;
                }
            }
        }

        .select2-container{
            width: 21vw !important;
        }
    </style>
@endpush
@push('footer-scripts')
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
    
  $(document).ready(function(){

    
  });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
</script>
@endpush