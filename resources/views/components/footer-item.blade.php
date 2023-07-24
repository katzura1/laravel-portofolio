<div class="flex flex-row gap-4 items-center">
    <div class="rounded-full border-solid border-2 border-primary-content p-2">
        {!! $icon??"" !!}
    </div>
    <div class="flex flex-col">
        <p class="text-primary-content">{{ $title??"" }}</p>
        <p>
            <a href="{{ $link??"" }}">{{ $value??"" }}</a>
        </p>
    </div>
</div>