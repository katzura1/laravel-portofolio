<div class="flex flex-col p-4 gap-4">
    <div class="flex flex-row justify-between item-start w-full">
        <h2 class="text-2xl font-bold text-primary-content">Latest Project</h2>
    </div>
    <div class="flex flex-col lg:flex-row gap-4 md:gap-10 lg:gap-4">
        @foreach ($projects as $item)
        <a class="w-full lg:w-1/3 sm:max-h-24 lg:max-h-none"
            href="{{ route('home.project.detail',['id'=>$item->id]) }}">
            <div class="card h-full bg-base-300 shadow-xl image-full hover:cursor-pointer">
                <figure>
                    <img class="w-full" src="{{ $item->image }}" alt="{{ $item->title }}" />
                </figure>
                <div class="card-body rounded-lg">
                    <h2 class="card-title text-md lg:text-lg text-primary-content">
                        {{ $item->title }}
                    </h2>
                    <div class="flex flex-row w-full gap-4 text-primary-content items-start justify-center flex-1">
                        <p class="badge badge-primary p-2">{{ date('M Y', strtotime($item->start_periode)).'-'.date('M
                            Y',
                            strtotime($item->end_periode)) }}</p>
                        <p class="badge p-2">Website</p>
                    </div>
                    <p class="hidden lg:inline-block text-xs p-0 mt-4 flex-none">
                        {{ $item->summary }}
                    </p>
                </div>

            </div>
        </a>
        @endforeach
    </div>
    @include('components.other-project')