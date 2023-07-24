<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Denny - Personal Portofolio</title>
    @vite('resources/css/app.css')
    <!--
    Big Thanks to
    - a
    - b
    -->
</head>

<body>

    <div class="md:container md:mx-auto mt-6">
        @include('components.navbar')

        <h2 class="text-2xl font-bold text-primary-content p-4">Latest Project</h2>
        <div id="project-list" class="p-4">

            <div class="flex flex-col lg:flex-row flex-wrap ">

                <a class="lg:w-1/2 my-2" href="{{ url('detail') }}">
                    <div class="card card-side bg-base-100 shadow-xl lg:h-[20vh] rounded-lg">
                        <figure><img src="https://daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                                alt="Movie" />
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title text-lg text-primary-content">New movie is released!</h2>
                            <p class="text-xs">Click the button to watch on Jetflix app.</p>
                        </div>
                    </div>
                </a>

                <a class="lg:w-1/2 my-2" href="{{ url('detail') }}">
                    <div class="card card-side bg-base-100 shadow-xl lg:h-[20vh] rounded-lg">
                        <figure><img src="https://daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                                alt="Movie" />
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title text-lg text-primary-content">New movie is released!</h2>
                            <p class="text-xs">Click the button to watch on Jetflix app.</p>
                        </div>
                    </div>
                </a>

                <a class="lg:w-1/2 my-2" href="{{ url('detail') }}">
                    <div class="card card-side bg-base-100 shadow-xl lg:h-[20vh] rounded-lg">
                        <figure><img src="https://daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                                alt="Movie" />
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title text-lg text-primary-content">New movie is released!</h2>
                            <p class="text-xs">Click the button to watch on Jetflix app.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="join mt-4">
                <button class="join-item btn">1</button>
                <button class="join-item btn btn-primary">2</button>
                <button class="join-item btn">3</button>
                <button class="join-item btn">4</button>
            </div>
        </div>

        @include('components.footer')
    </div>
</body>