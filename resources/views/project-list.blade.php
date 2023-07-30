@extends('layouts.app')

@section('title', 'My Complete Projects - Denny Portofolio')

@section('breadcrumbs')
<ul>
    <li><a href="{{ url('') }}">Home</a></li>
    <li>Projects</li>
</ul>
@endsection

@section('content')
<h1 class="text-lg lg:text-2xl font-bold text-primary-content p-4 fadeInUp-animation">My Complete Projects</h1>
<div id="project-list" class="p-4">
    <div class="flex flex-col lg:flex-row flex-wrap gap-2 justify-center">
        @foreach ($projects as $item)
        @include('components.card-project', ['item' => $item])
        @endforeach
    </div>

    {{ $projects->links('vendor.pagination.tailwind') }}

</div>
@endsection