<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth hover:scroll-auto">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Full Stack Developer - Denny Portofolio')</title>
    <meta name="description"
        content="@yield('description','industry experience as a Full-Stack developer, proficient in constructing websites and web applications. My expertise lies in PHP programming language, particularly in Laravel. Additionally, I possess a solid background in working with CodeIgniter, Wordpress, and Flutter.')">
    <meta name="keywords" content="Denny, Full-Stack Developer, Web Developer, Flutter Developer, Freelance Programmer">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('vendor/viewerjs/viewer.min.css') }}">
</head>

<body>
    <!-- Full-width fluid until the `md` breakpoint, then lock to container -->
    <div class="md:container md:mx-auto">
        @include('components.navbar')

        <div class="text-sm breadcrumbs p-4">
            @yield('breadcrumbs', '')
        </div>

        @yield('content')

        @include('components.footer')
    </div>

    <script src="{{ asset('vendor/viewerjs/viewer.min.js') }}"></script>
    <script>
        // Function to handle smooth scroll animation
        function smoothScroll(target) {
            const element = document.querySelector(target);
            if (element) {
                element.scrollIntoView({
                behavior: "smooth",
                });
            }
        }

        // Attach click event listeners to the links
        document.addEventListener("DOMContentLoaded", function () {
            const links = document.querySelectorAll('a[href^="#"]');
            links.forEach((link) => {
                link.addEventListener("click", function (event) {
                event.preventDefault(); // Prevent default link behavior
                const target = this.getAttribute("href");
                smoothScroll(target);
                });
            });
        });

    </script>
    @yield('js')
</body>

</html>