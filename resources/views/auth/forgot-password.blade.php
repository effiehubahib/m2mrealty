@extends('layouts.app')
@section('content')

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Forgot Password</h2>
    <p class="mb-10">{{ __('Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    @include('partials.alert')
    {{ html()->form('POST')->route('password.email')->class('space-y-6')->id('forgot-password')->open() }}
    <form action="#" method="POST" class="space-y-6">
      <div>
        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
        <div class="mt-2">
          {{ html()->email('email', old('email'))->class('col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-600 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6')->id('email')->placeholder('Enter your email')}}
          
        </div>
      </div>
      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Send Reset Link</button>
      </div>
    {{ html()->form()->close() }}

    <p class="mt-10 text-center text-sm/6 text-gray-500">
      Not a member?
      <a href="{{route('register')}}" class="font-semibold text-indigo-600 hover:text-indigo-500">Register now</a>
    </p>
  </div>
</div>

@endsection