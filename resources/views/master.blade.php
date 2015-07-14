<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Library</title>
        {!!HTML::style('assets/css/bootstrap.min.css')!!}
        {!!HTML::style('assets/css/style.css')!!}
    </head>
    <body>
        <div class="container">
            @include('navbar')
            <div class="row">
                @yield('main')
            </div>
        </div>
    </body>
</html>