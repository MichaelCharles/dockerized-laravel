<!doctype html>

<html>
    <head>
        <title>
            @yield('title', 'Laravel')
        </title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/simple.css') }}">
    </head>
    
<body>
<div id="content">
    @yield('content')
</div>
</body>

</html>