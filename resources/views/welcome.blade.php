<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth hover:scroll-auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Denny - Personal Portofolio</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <!--
    Big Thanks to
    - a
    - b
    -->
</head>

<body>
    <!-- Full-width fluid until the `md` breakpoint, then lock to container -->
    <div class="container md:mx-auto">
        @include('components.navbar')

        @include('components.hero')

        @include('components.projects')

        @include('components.tools')

        @include('components.footer')
    </div>
</body>

</html>