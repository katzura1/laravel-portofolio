<a class="w-full lg:w-[32%] sm:max-h-24 lg:max-h-none" href="{{ route('home.project.detail',['id'=>$item->id]) }}">
    <div class="card h-full bg-base-300 shadow-xl image-full hover:cursor-pointer fadeInUp-animation">
        <figure>
            <img class="w-full" src="{{ $item->image }}" alt="{{ $item->title }}" />
        </figure>
        <div class="card-body rounded-lg flex flex-col justify-between p-4 lg:p-6">
            <h2 class="card-title text-md line-clamp-2 lg:text-lg text-primary-content select-all flex-1">
                {{ $item->title }}
            </h2>
            <div
                class="flex flex-row w-full gap-4 text-primary-content items-end lg:items-start justify-center flex-none lg:flex-1">
                <p class="badge badge-primary p-4 truncate text-center text-xs w-[50%]">{{ date('M Y',
                    strtotime($item->start_periode)).'-'.date('M
                    Y',
                    strtotime($item->end_periode)) }}</p>
                <p class="badge p-4 truncate text-center text-xs w-[50%]">{{ ucfirst(str_replace('_' , ' ' ,
                    $item->type))
                    }}
                </p>
            </div>
            <p class="text-xs text-start lg:text-justify select-all flex-none md:hidden line-clamp-1 lg:line-clamp-3">
                {{ $item->summary }}
            </p>
        </div>

    </div>
</a>