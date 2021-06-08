<div id="flash-notifications">
    @if(session()->has(config('flash.session_key')))
        @foreach(session(config('flash.session_key')) as $notification)
            @include('flash::message', ['notification' => $notification])
        @endforeach
    @endif
</div>

@if(config('flash.validations.enabled'))
    @include(config('flash.validations.view'))
@endif

@php
    $framework = \DPWebSolutions\LaravelFlash\Flash::framework();
@endphp
<script>
    window.FlashNotifications = window.FlashNotifications || {};

    window.FlashNotifications.push = function (type = 'success', message = null, dismissible = true) {
        var classes = '{{config('flash.class')}}';
        var framework = '{{$framework}}';
        var frameworkClasses = @json(config('flash.classes'));
        frameworkClasses = frameworkClasses[framework][type];

        var list = document.getElementById('flash-notifications');
        var newNotification = document.createElement('div');

        if (framework === 'tailwind') {
            newNotification.setAttribute('class', 'p-4 rounded flex justify-between' + ' ' + classes + ' ' + frameworkClasses);

            var messageDiv = document.createElement('p');
            messageDiv.innerHTML = message;
            newNotification.append(messageDiv);

            if (dismissible) {
                var dismissButton = document.createElement("button");
                dismissButton.setAttribute('type', 'button');
                dismissButton.classList.add('ml-2', 'px-2');
                dismissButton.innerHTML = '&times;'
                newNotification.append(dismissButton);
                dismissButton.addEventListener('click', function(e) {
                    e.target.parentElement.remove();
                })
            }
        } else {
            newNotification.setAttribute('class', 'alert' + ' ' + classes + ' ' + frameworkClasses);

            if (dismissible) {
                var dismissButton = document.createElement("button");
                dismissButton.setAttribute('type', 'button');
                dismissButton.setAttribute('aria-hidden', true);
                dismissButton.classList.add('close');
                dismissButton.innerHTML = '&times;'
                newNotification.append(dismissButton);
                dismissButton.addEventListener('click', function(e) {
                    e.target.parentElement.remove();
                })
            }

            var messageDiv = document.createElement('p');
            messageDiv.classList.add('alert');
            messageDiv.innerHTML = message;
            newNotification.append(messageDiv);
        }

        list.append(newNotification);
        return window.FlashNotifications;
    }
</script>