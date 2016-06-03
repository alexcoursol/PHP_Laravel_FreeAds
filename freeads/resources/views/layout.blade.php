<!DOCTYPE html>
<html>
<head>
    <title>FreeAds</title>
    <meta name="description" content="FreeAddsssssssss">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="{{ URL::asset('anim.js') }}"></script>
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet" type="text/css" >
    @yield('css')
</head>
<body>
    <div id="container">
            @include('aside')
        <div id="main_section">
            @yield('content')
        </div>
    </div>
</body>
</html>