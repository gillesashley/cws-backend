@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Geolocation</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <iframe id="mapFrame" width="100%" height="400" style="border:0" loading="lazy" allowfullscreen
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>




    
<!-- Add JavaScript to dynamically insert the API key -->
<script>
    // Replace with the actual API key obtained from your .env file
    const apiKey = 'AIzaSyAPozn9l_ge8sxcWkAwkb4a-gmLBVy_5ns';

    // Get the iframe element
    const iframe = document.getElementById('mapFrame');

    // Set the iframe src with the API key
    iframe.src = `https://www.google.com/maps/embed/v1/search?key=${apiKey}&q=Accra,+Ghana`;
</script>

@endsection


