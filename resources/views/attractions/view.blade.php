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
                    <span class="text-base">View Attraction</span>
                </span>
                <span>/</span>
            </div>
            <div>
                <a href="{{ route('attractions.index') }}" class="appearance-none block w-full bg-blue-700 text-gray-100 font-bold border border-gray-200 rounded-lg py-3 px-5 leading-tight hover:bg-blue-600 focus:outline-none focus:bg-blue-600 focus:border-gray-400">View All Attractions</a>
            </div>
        </div>
        <div class="header bg-white m-4 rounded-md p-4 h-12 px-10 flex items-center justify-center">
            <h1 class="font-medium text-2xl">Attraction Details</h1>
        </div>

        <div class="flex justify-center p-4">
            <div class="w-1/3">
                @include('attractions.partials.weather')
            </div>

            <div class="w-2/3 header bg-white m-4 rounded-md shadow-md p-4 px-10">
                <div class="mb-4">
                    <h1 class="text-gray-800 text-3xl font-bold">{{ $attractions->name }}</h1>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                    <p class="text-gray-800">{{ $attractions->description }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Location</label>
                    <p class="text-gray-800">{{ $attractions->location }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Price</label>
                    <p class="text-gray-800">{{ $attractions->price }}</p>
                </div>
                <div class="px-3 mb-8">
                    @if ($attractions->image_path)
                        <div class="mb-4">
                            <img src="{{ $attractions->image_path }}" alt="Attraction Image" class="w-48 h-48 rounded-lg shadow-md flex text-center">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
