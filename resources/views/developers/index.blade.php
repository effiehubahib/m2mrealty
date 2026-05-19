@extends('layouts.dashboard')
@section('content')
        @include('partials.alert')
        
        <div class="block">
            <section class="mb-6 2xl:mb-0 shadow-lg">
                
                <div class="w-full rounded-lg bg-white px-[24px] py-[20px] dark:bg-darkblack-600">
                    <div class="justify-between sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold text-dgray-900 dark:text-white">Developers</h1>
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <a href="{{route('downloadable.create')}}" class="block rounded-md px-3 py-2 text-center text-sm font-semibold text-white shadow-xs bg-branding hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Upload new downloadable</a>
                        </div>
                    </div>
                   
                    <div class="border-b border-gray-900/10 pb-12 " id='request-products'>
                       
                        <div class="mt-8 flow-root" >
                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                    <table class="relative min-w-full divide-y divide-gray-300" id="downloadable-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 45px;" scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900">Download</th>
                                                <th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900">Title</th>                                                
                                                <th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900">Filename</th>                                        
                                                <th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900">Description</th>                                                
                                                <th scope="col" class="py-3.5 pr-3 pl-4 text-center text-sm font-semibold text-gray-900" >Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($downloadables as $ctr=>$downloadable)
                                                <tr>
                                                    <td style="width: 45px;" scope="col" class="py-1.5 pr-1 pl-1 text-left text-sm font-semibold text-gray-900">
                                                        <a href="{{route('downloadable.open-file',['file'=>$downloadable->uniquename])}}" target="_blank"> <img src="{{ asset('images/logo/m2m-logo.svg') }}"  width="auto" height="70px"/> 
                                                    </td>
                                                    <td scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900">{{$downloadable->title}}</td>
                                                    <td scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900">{{$downloadable->filename}}</td>
                                                    <td scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900">{{$downloadable->description}}</td>                                                
                                                    <td class="text-center">
                                                        <a href="{{route('downloadable.edit',['id'=>$downloadable->id])}}" class="text-indigo-600 hover:text-indigo-900 btn-edit text-sm">Edit</a> 
                                                        | 
                                                        {{ html()->form('DELETE')->route('downloadable.destroy',$downloadable->id)->id('deleteForm')->class('inline space-y-6')->open() }}
                                                            <input type="submit" class="deleteBtn cursor-pointer text-red-600 hover:text-red-900 text-sm" value="Delete" onclick="return confirm('Are you sure you want to delete {{$downloadable->title}} ?')"/>
                                                        {{ html()->form()->close() }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $downloadables->links() }}
                            </div>
                            <div class="d-print-none hidden mt-8" id="submitRequest">
                                <div class="float-end">
                                    <button type="button"  onclick="submitCart()" class="flex items-center gap-x-2 rounded-md px-3 py-2 text-center text-sm font-semibold text-white shadow-xs bg-blue-900 hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M18.1716 1C18.702 1 19.2107 1.21071 19.5858 1.58579L22.4142 4.41421C22.7893 4.78929 23 5.29799 23 5.82843V20C23 21.6569 21.6569 23 20 23H4C2.34315 23 1 21.6569 1 20V4C1 2.34315 2.34315 1 4 1H18.1716ZM4 3C3.44772 3 3 3.44772 3 4V20C3 20.5523 3.44772 21 4 21L5 21L5 15C5 13.3431 6.34315 12 8 12L16 12C17.6569 12 19 13.3431 19 15V21H20C20.5523 21 21 20.5523 21 20V6.82843C21 6.29799 20.7893 5.78929 20.4142 5.41421L18.5858 3.58579C18.2107 3.21071 17.702 3 17.1716 3H17V5C17 6.65685 15.6569 8 14 8H10C8.34315 8 7 6.65685 7 5V3H4ZM17 21V15C17 14.4477 16.5523 14 16 14L8 14C7.44772 14 7 14.4477 7 15L7 21L17 21ZM9 3H15V5C15 5.55228 14.5523 6 14 6H10C9.44772 6 9 5.55228 9 5V3Z" fill="#ffffff"></path> </g></svg>
                                        Submit Request</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
            </section>
            

            
        </div>
@endsection
@push('header-css')

<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endpush
@push('footer-scripts')

<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{asset('assets/js/easy-number-separator.js')}}"></script>
<script>
    
    var firstload = true;
    var supplierSelect = $('#supplier_id');
    var productSelect = $('#products-list');
    var warehouseID = $('#warehouse_id');


</script>
@endpush