<!DOCTYPE html>

<html>
    <head>
        <title>
            @yield('title', 'Laravel')
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.css">
        <style>
            body {
                padding-top: 3em;
            }
            button {
                margin-top: .75em;
                margin-bottom: .75em;
            }
        </style>
    </head>
    
<body>
<div class="container">
    @yield('content')
    @include('errors')
</div>


</body>

</html>