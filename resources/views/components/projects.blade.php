<div class="flex flex-col gap-4 fadeInUp-animation mt-2">
    <div class="flex flex-row justify-between item-start w-full p-2">
        <h2 class="text-lg lg:text-2xl font-bold text-primary-content">Latest Project</h2>
    </div>
    <div class="flex flex-col lg:flex-row gap-4 md:gap-10 lg:gap-4">
        @foreach ($projects as $item)
        @include('components.card-project',['item' => $item])
        @endforeach
    </div>
    @include('components.other-project')
</div>