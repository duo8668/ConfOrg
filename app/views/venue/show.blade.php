<!-- app/views/nerds/show.blade.php -->

<!DOCTYPE html>
<html>
<head>    
    <title>Venue - Conference organizer</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">      

</head>
<body>
<div class="container">

<h1>Showing {{ $venue->Name }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $venue->Name }}</h2>
        <p>
            <strong>Venue Name:</strong> {{ $venue->Name }}<br>
            <strong>Venue Address:</strong> {{ $venue->Address }}
        </p>
    </div>

</div>
</body>
</html>