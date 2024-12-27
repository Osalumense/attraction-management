@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center">
    <div class="py-6 px-8 h-120 mt-20 bg-white rounded shadow-xl">
        <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="mb-6">
            <label for="email" class="block text-gray-800 font-bold">Email address:</label>
            <input type="email" name="email" id="email" placeholder="Enter email" :value="old('email')"  class="w-full border border-gray-300 py-2 pl-3 rounded mt-2 outline-none focus:ring-blue-600 :ring-blue-600" />
          </div>
          @error('email')
            <span class="text-red-400">{{ $message }}</span>
          @enderror
    
          <div>
            <label for="password" class="block text-gray-800 font-bold">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter password" class="w-full border border-gray-300 py-2 pl-3 rounded mt-2 outline-none focus:ring-blue-600 :ring-blue-600" />
          </div>
          @error('password')
            <span class="text-red-400">{{ $message }}</span>
          @enderror
          <a href="#" class="text-sm font-thin text-gray-800 hover:underline mt-4 inline-block hover:text-blue-600">Create Account</a>
          <button class="cursor-pointer py-2 px-4 block mt-6 bg-blue-500 text-white font-bold w-full text-center rounded">Login</button>
        </form>
    </div>
</div>

@endsection