<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Vue Js 2.0 CRUD</title>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script>
          window.Laravel = { csrfToken: '{{ csrf_token() }}' }
        </script>
    </head>
    <body>
        <div class="container" id="app">
          <vuecrud></vuecrud>
        </div>

        <script src="{{asset(mix('/js/app.js'))}}"></script>
    </body>
</html>
