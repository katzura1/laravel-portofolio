<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth hover:scroll-auto">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Showcasing Web Development Skills: My Portfolio')</title>
    <meta name="description"
        content="Welcome to my web developer portfolio, showcasing my skills in Laravel and Flutter development. Witness my expertise in building dynamic, responsive websites, and engaging mobile applications, delivering innovative solutions and exceptional user experiences.">
    <meta name="keywords"
        content="Web Developer Portfolio, Laravel Development, Flutter Development, Innovative Solutions, Mobile App Development">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
</head>

<body>
    <!-- Full-width fluid until the `md` breakpoint, then lock to container -->
    <div class="container md:mx-auto">
        @include('components.navbar')

        @yield('content')

        @include('components.footer')
    </div>
</body>

</html>