<div class="alert
            {{ config('flash.class') }}
            {{ $notification['class'] }}" role="alert"
>
    @if ($notification['dismissible'])
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    @endif

    <div>{!! $notification['message'] !!}</div>
</div>
