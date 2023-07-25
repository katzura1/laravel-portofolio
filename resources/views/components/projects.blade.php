<div class="flex flex-col p-4 gap-4">
    <div class="flex flex-row justify-between item-start w-full">
        <h2 class="text-2xl font-bold text-primary-content">Latest Project</h2>
    </div>
    <div class="flex flex-col lg:flex-row gap-4 md:gap-10 lg:gap-4">
        @for ($i = 0; $i < 3 ; $i++) <a href="{{ url('detail') }}">
            <div
                class="card w-full lg:w-124 bg-base-100 shadow-xl image-full sm:max-h-24 lg:max-h-none hover:cursor-pointer">
                <figure>
                    <img class="w-full" src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg"
                        alt="Shoes" />
                </figure>
                <div class="card-body rounded-lg">
                    <h2 class="card-title text-md lg:text-lg text-primary-content">Making a design system from scratch
                    </h2>
                    <div class="flex flex-row w-full gap-4 text-primary-content items-start justify-center flex-1">
                        <p class="badge badge-neutral p-2">12 Feb 2020</p>
                        <p class="badge p-2">Website</p>
                    </div>
                    <p class="hidden lg:inline-block text-xs p-0 flex-none">Amet minim mollit non deserunt ullamco est
                        sit
                        aliqua
                        dolor
                        do amet
                        sint. Velit officia
                        consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                </div>

            </div>
            </a>
            @endfor

    </div>
    @include('components.other-project')