@extends('layouts.app')

@section('title', $project['title'].'- Denny Portofolio')

@section('breadcrumbs')
<ul>
    <li><a href="{{ url('') }}">Home</a></li>
    <li><a href="{{ url('projects') }}">Projects</a></li>
    <li>{{ $project['title'] }}</li>
</ul>
@endsection

@section('content')
<div class="md:h-min-[75vh] lg:h-min-[62vh]">
    <div class="flex flex-col gap-4 shadow-xl">
        <div class="card bg-base-100 rounded-none lg:rounded-lg">
            <div class="card-body px-4 py-4 flex-col gap-4 justify-start fadeInUp-animation">
                <h1 class="text-2xl text-primary-content">{{ $project['title'] }}</h1>
                <div class="flex flex-col lg:flex-row gap-2 justify-between">
                    <div class="lg:w-1/2">
                        <p class="text-sm">
                            {{ $project['summary'] }}
                        </p>
                    </div>
                    <div class="divider"></div>
                    <div class="lg:w-1/2">
                        <h2 class="text-lg font-bold">Stack</h2>
                        <div class="flex flex-wrap flex-row gap-4 mt-2">
                            @foreach ($project['stack'] as $item)
                            <div class="badge badge-neutral">{{ $item['stack']['name'] }}</div>
                            @endforeach
                        </div>
                        <a class="btn btn-sm btn-primary mt-4 w-full lg:w-fit" href="{{ $project['link'] }}">
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
                        </a>
                    </div>
                </div>

                <h2 class="text-xl text-start text-primary-content tooltip before:w-full before:content-[attr(data-tip)] lg:tooltip-right"
                    data-tip="Use your navigation keyboard to slide">
                    Screenshots
                </h2>
                <div class="flex flex-row gap-2" id="images">
                    @foreach ($project['image'] as $item)
                    <div class="w-2/5 lg:h-[250px] overflow-hidden rounded-lg cursor-pointer">
                        <img src="{{ $item['image'] }}"
                            class="w-full h-full object-cover rounded-lg transition-all duration-500 ease-in-out transform bg-center bg-cover hover:scale-150" />
                    </div>
                    @endforeach
                </div>


            </div>
        </div>

        <div class="divider"></div>
        <div class="p-2 fadeInUp-animation">
            <h2 class="text-xl text-primary-content tooltip before:w-full before:content-[attr(data-tip)] lg:tooltip-right"
                data-tip="Use your navigation keyboard to slide">
                Other Project
            </h2>
            <div class="carousel carousel-center max-w-full mt-2 p-2 space-x-4 ">
                @foreach ($projects as $item)
                <a class="w-3/5 lg:w-1/5 carousel-item" href="{{ route('home.project.detail',['id'=>$item['id']]) }}">
                    <div class="overflow-hidden rounded-lg flex flex-col gap-2">
                        <img src="{{ $item['image'] }}"
                            class="w-full flex-1 object-cover rounded-lg transition-all duration-500 ease-in-out transform bg-center bg-cover hover:scale-150" />
                        <h4 class="text-xs lg:text-md font-bold shadow-xl z-50 px-2 text-white truncate">
                            {{ $item['title'] }}
                        </h4>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@include('components.other-project')
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function(){
        // View a list of images.
        // Note: All images within the container will be found by calling `element.querySelectorAll('img')`.
        const gallery = new Viewer(document.getElementById('images'));
        // Then, show one image by click it, or call `gallery.show()`.
    });
</script>
@endsection