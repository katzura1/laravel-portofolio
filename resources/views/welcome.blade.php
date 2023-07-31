@extends('layouts.app')

@section('content')

@section('breadcrumbs')
<ul>
    <li>Home</li>
</ul>
@endsection

@include('components.hero')

@include('components.projects')

@include('components.tools')
@endsection