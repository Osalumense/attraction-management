<h2 class="text-lg font-semibold mb-4">Weather Conditions</h2>
@if ($weather)
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h4 class="text-xl font-bold mb-2">Current Weather in {{ $attractions->location }}</h4>
        <p class="text-gray-700">Temperature: {{ $weather['main']['temp'] }} °C</p>
        <p class="text-gray-700">Weather: {{ $weather['weather'][0]['description'] }}</p>
        <p class="text-gray-700">Humidity: {{ $weather['main']['humidity'] }}%</p>
    </div>
@else
    <p class="text-gray-500">Weather information unavailable at this time.</p>
@endif