<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth hover:scroll-auto">

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
        <div class="md:h-min-[75vh] lg:h-min-[62vh]">
            <div class="flex flex-col lg:flex-row gap-4 shadow-xl">
                <div class="card lg:w-2/4 bg-base-100 rounded-none lg:rounded-lg">
                    {{-- <figure>
                        <img src="https://daisyui.comhttps://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg"
                            class="h-24 lg:h-full rounded-none lg:rounded-lg w-full object-cover" alt="Shoes" />
                    </figure> --}}
                    <div class="card-body px-4 py-4">
                        <h2 class="text-2xl text-primary-content">HR System (Back End)</h2>
                        <p class="text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam optio
                            consectetur nam perspiciatis sit incidunt magnam voluptates. Eveniet, recusandae vitae?
                            Omnis saepe, sint sed et molestiae accusantium a voluptatem iste.</p>

                        <div class="flex flex-row  gap-2">
                            <div class="w-2/5 overflow-hidden rounded-lg">
                                <img src="https://daisyui.com/images/stock/photo-1559703248-dcaaec9fab78.jpg"
                                    class="w-full rounded-lg transition-all duration-500 ease-in-out transform bg-center bg-cover hover:scale-150" />
                            </div>
                            <div class="w-2/5 overflow-hidden rounded-lg">
                                <img src="https://daisyui.com/images/stock/photo-1565098772267-60af42b81ef2.jpg"
                                    class="w-full rounded-lg transition-all duration-500 ease-in-out transform bg-center bg-cover hover:scale-150" />
                            </div>
                            <div class="w-2/5 overflow-hidden rounded-lg">
                                <img src="https://daisyui.com/images/stock/photo-1572635148818-ef6fd45eb394.jpg"
                                    class="w-full rounded-lg transition-all duration-500 ease-in-out transform bg-center bg-cover hover:scale-150" />
                            </div>
                        </div>

                        <h4>Stack</h4>
                        <div class="flex flex-wrap flex-row gap-4">
                            <div class="badge">default</div>
                            <div class="badge badge-neutral">neutral</div>
                            <div class="badge badge-secondary">secondary</div>
                            <div class="badge badge-accent">accent</div>
                            <div class="badge badge-ghost">ghost</div>
                        </div>
                        <button class="btn btn-sm btn-primary mt-4">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 7.28595 22 4.92893 20.5355 3.46447C19.0711 2 16.714 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355ZM9.5 8.75C7.70507 8.75 6.25 10.2051 6.25 12C6.25 13.7949 7.70507 15.25 9.5 15.25C11.2949 15.25 12.75 13.7949 12.75 12C12.75 11.5858 13.0858 11.25 13.5 11.25C13.9142 11.25 14.25 11.5858 14.25 12C14.25 14.6234 12.1234 16.75 9.5 16.75C6.87665 16.75 4.75 14.6234 4.75 12C4.75 9.37665 6.87665 7.25 9.5 7.25C9.91421 7.25 10.25 7.58579 10.25 8C10.25 8.41421 9.91421 8.75 9.5 8.75ZM17.75 12C17.75 13.7949 16.2949 15.25 14.5 15.25C14.0858 15.25 13.75 15.5858 13.75 16C13.75 16.4142 14.0858 16.75 14.5 16.75C17.1234 16.75 19.25 14.6234 19.25 12C19.25 9.37665 17.1234 7.25 14.5 7.25C11.8766 7.25 9.75 9.37665 9.75 12C9.75 12.4142 10.0858 12.75 10.5 12.75C10.9142 12.75 11.25 12.4142 11.25 12C11.25 10.2051 12.7051 8.75 14.5 8.75C16.2949 8.75 17.75 10.2051 17.75 12Z"
                                        fill="#ffff"></path>
                                </g>
                            </svg>
                            Live / Demo
                        </button>
                    </div>
                </div>

                <div class="divider"></div>
                <div class="lg:w-2/4 p-2">
                    <h2 class="text-2xl tooltip before:w-full before:content-[attr(data-tip)] lg:tooltip-right"
                        data-tip="Use your navigation keyboard to slide">
                        Other
                        Project</h2>
                    <div class="carousel carousel-center max-w-full mt-2 p-2 space-x-4 ">
                        <div class="carousel-item w-2/5 overflow-hidden rounded-lg flex flex-col gap-2 max-h-[40vh]">
                            <img src="https://daisyui.com/images/stock/photo-1559703248-dcaaec9fab78.jpg"
                                class="w-full rounded-lg transition-all duration-500 ease-in-out transform bg-center bg-cover hover:scale-150" />
                            <h4
                                class="text-xl font-bold shadow-xl z-50 px-2 text-primary-content truncate overflow-hidden">
                                Title
                                Long Test Test 123213 131 12 3123 2
                            </h4>
                        </div>
                        <div class="carousel-item w-2/5 overflow-hidden rounded-lg flex flex-col gap-2 max-h-[40vh]">
                            <img src="https://daisyui.com/images/stock/photo-1565098772267-60af42b81ef2.jpg"
                                class="w-full rounded-lg transition-all duration-500 ease-in-out transform bg-center bg-cover hover:scale-150" />
                            <h4
                                class="text-xl font-bold shadow-xl z-50 px-2 text-primary-content truncate overflow-hidden">
                                Title
                            </h4>
                        </div>
                        <div class="carousel-item w-2/5 overflow-hidden rounded-lg flex flex-col gap-2 max-h-[40vh]">
                            <img src="https://daisyui.com/images/stock/photo-1572635148818-ef6fd45eb394.jpg"
                                class="w-full rounded-lg transition-all duration-500 ease-in-out transform bg-center bg-cover hover:scale-150" />
                            <h4
                                class="text-xl font-bold shadow-xl z-50 px-2 text-primary-content truncate overflow-hidden">
                                Title
                            </h4>
                        </div>
                        <div class="carousel-item w-2/5 overflow-hidden rounded-lg flex flex-col gap-2 max-h-[40vh]">
                            <img src="https://daisyui.com/images/stock/photo-1494253109108-2e30c049369b.jpg"
                                class="w-full rounded-lg transition-all duration-500 ease-in-out transform bg-center bg-cover hover:scale-150" />
                            <h4
                                class="text-xl font-bold shadow-xl z-50 px-2 text-primary-content truncate overflow-hidden">
                                Title
                            </h4>
                        </div>
                        <div class="carousel-item w-2/5 overflow-hidden rounded-lg flex flex-col gap-2 max-h-[40vh]">
                            <img src="https://daisyui.com/images/stock/photo-1550258987-190a2d41a8ba.jpg"
                                class="w-full rounded-lg transition-all duration-500 ease-in-out transform bg-center bg-cover hover:scale-150" />
                            <h4
                                class="text-xl font-bold shadow-xl z-50 px-2 text-primary-content truncate overflow-hidden">
                                Title
                            </h4>
                        </div>
                        <div class="carousel-item w-2/5 overflow-hidden rounded-lg flex flex-col gap-2 max-h-[40vh]">
                            <img src="https://daisyui.com/images/stock/photo-1559181567-c3190ca9959b.jpg"
                                class="w-full rounded-lg transition-all duration-500 ease-in-out transform bg-center bg-cover hover:scale-150" />
                            <h4
                                class="text-xl font-bold shadow-xl z-50 px-2 text-primary-content truncate overflow-hidden">
                                Title
                            </h4>
                        </div>
                        <div class="carousel-item w-2/5 overflow-hidden rounded-lg flex flex-col gap-2 max-h-[40vh]">
                            <img src="https://daisyui.com/images/stock/photo-1601004890684-d8cbf643f5f2.jpg"
                                class="w-full rounded-lg transition-all duration-500 ease-in-out transform bg-center bg-cover hover:scale-150" />
                            <h4
                                class="text-xl font-bold shadow-xl z-50 px-2 text-primary-content truncate overflow-hidden">
                                Title
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('components.other-project')

        @include('components.footer')
    </div>
</body>

</html>