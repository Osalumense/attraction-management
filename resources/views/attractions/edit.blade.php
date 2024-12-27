@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="header h-12 px-10 py-8 my-4 border-b-2 border-gray-200 flex items-center justify-between">
            <div class="flex items-center space-x-2 text-gray-400">
                <span class="text-blue-700 tracking-wider text-lg"><a href="{{ route('attractions.index')}}">Home</a></span>
                <span>/</span>
                <span class="text-blue-700 tracking-wider text-lg"><a href="{{ route('attractions.index')}}">Attraction</a></span>
                <span>/</span>
                <span class="tracking-wide text-md ">
                    <span class="text-base">Edit Attraction</span>
                </span>
                <span>/</span>
            </div>
            <div>
                <a href="{{ route('attractions.store') }}" class="appearance-none block w-full bg-blue-700 text-gray-100 font-bold border border-gray-200 rounded-lg py-3 px-5 leading-tight hover:bg-blue-600 focus:outline-none focus:bg-blue-600 focus:border-gray-400">View Attractions</a>
            </div>
        </div>
        <div class="header bg-white m-4 rounded-md p-4 h-12 px-10 flex items-center justify-center">
            <h1 class="font-medium text-2xl">Edit Attraction</h1>
        </div>

        <div class="flex justify-center p-4">

            <div class="header bg-white m-4 rounded-md p-4 px-10 flex items-center">
                <form method="POST" action="{{ route('attractions.update', $attractions->id) }}" enctype="multipart/form-data" class="mt-4">
                    @method('PUT')
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="name">Name</label>
                        <input type="text" name="name" id="name" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ $attractions->name }}">
                        @error('name')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="description">Description</label>
                        <textarea name="description" id="description" rows="3" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ $attractions->description }}</textarea>
                        @error('description')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="location">Location</label>
                        <input type="text" name="location" id="location" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ $attractions->location }}">
                        @error('location')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="price">Price</label>
                        <input type="number" name="price" id="price" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ $attractions->price }}">
                        @error('price')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="px-3 mb-8">
                        @if ($attractions->image_path)
                            <div class="mb-4">
                                <img src="{{ $attractions->image_path }}" alt="Current Attraction Image" class="w-24 h-24 rounded-lg shadow-md flex text-center">
                            </div>
                        @endif
                        <label class="mx-auto px-4 py-2 cursor-pointer flex w-full max-w-lg flex-col items-center justify-center rounded-xl border-2 border-dashed border-blue-400 bg-white p-6 text-center" htmlFor="file">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
    
                            <h2 class="mt-4 text-xl font-medium text-gray-700 tracking-wide">Attraction image</h2>
    
                            <p class="mt-2 text-gray-500 tracking-wide">Upload or drag & drop your file PNG, JPG or JPEG. </p>
    
                            <input id="image_path" type="file" name="image_path" accept="image/png, image/jpeg, image/jpg"/>
                        </label>
                        @error('image_path')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
        
                    <div class="flex justify-end">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-md w-full hover:bg-blue-700">
                            Update
                        </button>
                    </div>
                </form>
            </div>

            
        </div>

        

    </div>
@endsection