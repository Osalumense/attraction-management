<!DOCTYPE html>
<html>
<head>
    <title>New Attraction Created</title>
</head>
<body>
    <p>A new attraction has been added to the system:</p>
    <h1>{{ $attraction->name }}</h1>
    <p><strong>Description:</strong> {{ $attraction->description }}</p>
    <p><strong>Location:</strong> {{ $attraction->location }}</p>
    <p><strong>Price:</strong> ${{ number_format($attraction->price, 2) }}</p>

    @if ($imageUrl)
        <p><strong>Attraction Image:</strong></p>
        <img src="{{ $imageUrl }}" alt="{{ $attraction->name }}" style="width: 200px; height: 200px;">
    @else
        <p><em>No image was uploaded for this attraction.</em></p>
    @endif
    <br>

    Thanks,<br>
    {{ config('app.name') }}
</body>
</html>