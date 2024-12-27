@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="header h-12 px-10 py-8 my-4 border-b-2 border-black-200 flex items-center justify-between">
            <div class="flex items-center space-x-2 text-black-400">
                <span class="text-blue-700 tracking-wider text-lg"><a href="{{ route('attractions.index') }}">Home</a></span>
                <span>/</span>
                <span class="tracking-wide text-md ">
                    <span class="text-base">attractions</span>
                </span>
                <span>/</span>
            </div>
            <div>
                @if(auth()->user() && auth()->user()->role === \App\Models\User::ROLE_ADMIN)
                    <a href="{{ route('attractions.create') }}" class="appearance-none block w-full bg-blue-700 text-white font-bold border border-black-200 rounded-lg py-3 px-5 leading-tight hover:bg-blue-600 focus:outline-none focus:bg-blue-600 focus:border-black-400">Create attraction</a>
                @endif
                
            </div>
        </div>
        <div class="header bg-white m-4 rounded-md p-4 h-16 px-10 flex items-center justify-between">
            <h1 class="font-medium text-2xl">Attractions</h1>
        </div>

        <div class="header bg-white m-4 rounded-md p-4 px-10 flex justify-between">
            <div class="w-1/4">
                @include('attractions.partials.filter')
            </div>
            
            <div class="w-3/4">
                <table class="table-auto w-full">
                    <thead class="text-sm font-semibold uppercase text-black-800 mx-auto">
                        <tr>
                            <th class="p-2">
                                <div class="font-semibold">Image</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold ">Name</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold ">Description</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold ">Price</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold ">Location</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold">Action</div>
                            </th>
                        </tr>
                        
                    </thead>
                    <tbody class="text-sm">
                        @if($attractions->isNotEmpty())
                            @foreach($attractions as $attraction)
                                <tr class="border-b border-black-200 py-4">
                                    <td class="text-center">
                                        @if($attraction->image_path)
                                            <img src="{{ $attraction->image_path }}" class="h-auto w-8" alt="{{ $attraction->name }}">
                                        @else
                                            No image yet
                                        @endif
                                    </td> 
                                    <td>{{ $attraction->name }}</td>
                                    <td>{{ $attraction->description }}</td>
                                    <td>{{ number_format($attraction->price, 2) }}</td>
                                    <td>{{ $attraction->location }}</td>
                                    <td>
                                        <div class="flex justify-center text-white space-x-2">
                                            <a href="{{ route('attractions.show', $attraction->id) }}" class="p-2 rounded-sm bg-gray-400">View</a>
                                            @if(auth()->user() && auth()->user()->role === \App\Models\User::ROLE_ADMIN)
                                                <a href="{{ route('attractions.edit', $attraction->id) }}" class="bg-blue-500 p-2 rounded-sm">Edit</a>
                                                <button class="bg-red-500 p-2 rounded-sm delete-attraction" data-id="{{ $attraction->id }}">Delete</button>
                                            @endif                                            
                                        </div>                            
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-center py-2 text-md">
                                <td colspan="6">No attractions found. Please adjust your filters or add a new attraction.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="pagination mt-4">
                    {{ $attractions->links() }}
                </div>
            </div>
            
        </div>
        

    </div>
@endsection

@section('scripts')
    <script>
         $(document).on('click', '.delete-attraction', function () {
            const attractionId = $(this).data('id');
            if (confirm('Are you sure you want to delete this attraction?')) {
                $.ajax({
                    url: `/attraction/${attractionId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.success) {
                            alert(response.message);
                            location.reload();
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function (error) {
                        alert('An error occurred while deleting the attraction.');
                    }
                });
            }
        });
    </script>
@endsection