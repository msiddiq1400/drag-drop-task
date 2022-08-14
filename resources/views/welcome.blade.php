<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mail Signup</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body class="antialiased background-img">
        <h2 class="text-center margin-top register-style">Show Tasks</h2>
        <form id="myForm" method="POST" action="/showTasks">
            {{ csrf_field() }}
            <div class="form-group text-center">
                <button style="cursor:pointer;" type="submit" class="btn button-style">Submit</button>
            </div>
        </form>
        @yield('content')
    </body>
</html>
