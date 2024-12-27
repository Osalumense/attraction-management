    
<form method="GET" action="{{ route('attractions.index') }}" class="mr-3 p-4 rounded-sm shadow-md">
    <div>
        <label for="search" class="block text-sm font-medium text-gray-700">Search:</label>
        <input type="text" name="search" id="search" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ request('search') }}">
        
        <label for="location" class="block text-sm font-medium text-gray-700">Location:</label>
        <input type="text" name="location" id="location" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ request('location') }}">
    </div>

    <div class="flex flex-col sm:flex-row items-center gap-4 mt-4">
        <div class="flex-1">
            <label for="min_price" class="block text-sm font-medium text-gray-700">Min Price:</label>
            <input type="number" name="min_price" id="min_price" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ request('min_price') }}">
        </div>
        <div class="flex-1">
            <label for="max_price" class="block text-sm font-medium text-gray-700">Max Price:</label>
            <input type="number" name="max_price" id="max_price" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ request('max_price') }}">
        </div>
    </div>

    <div class="flex justify-end space-x-2 mt-4">
        <a href="{{ route('attractions.index') }}" class=" px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md">Clear Filters</a>
        <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md">Filter</button>
    </div>
</form>