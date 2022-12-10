<!DOCTYPE html>
<html lang="en">

<head>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- HTML -->
    <title>Tienda</title>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    <style>
        .contentform {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            margin-top: 5%
        }
    </style>

</head>

<body>
    <div>
        @yield('content')
    </div>
</body>

</html>
