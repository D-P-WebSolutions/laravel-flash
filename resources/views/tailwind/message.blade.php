<div class="p-4 rounded flex justify-between
            {{ config('flash.class') }}
            {{ $notification['class'] }}"
>
    <div>{!! $notification['message'] !!}</div>

    @if($notification['dismissible'])
        <button class="ml-2 px-2" onclick="this.parentElement.remove();">&times;</button>
    @endif
</div>
