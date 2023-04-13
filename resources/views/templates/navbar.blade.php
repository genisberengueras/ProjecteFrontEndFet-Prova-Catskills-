<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css"  rel="stylesheet" />--}}

    <link href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/datatables.min.js"></script>
    <title>@yield('titol')</title>
</head>
<body>
<div class="bg-cover" style="background-image: url('https://wallup.net/wp-content/uploads/2019/05/10/39861-water-drops-photography-stop-motion-ripple-nature.jpg'); height: 100vh;">
    <nav class="w-full flex justify-center p-1 shadow-2xl">
        <a href="{{ route('inici') }}" class="nav-item">Inici</a>
        <a href="/embassaments" class="nav-item">Embassaments</a>
        <a href="/comarques" class="nav-item">Consum d'aigua</a>
        <a href="/quiz" class="nav-item">Quiz</a>
    </nav>
    @yield('contingut')
</div>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>--}}
</body>
</html>
