@if(config('flash.framework') === 'tailwind')
    @include('flash::tailwind.message', ['notification' => $notification])
@else
    @include('flash::bootstrap.message', ['notification' => $notification])
@endif