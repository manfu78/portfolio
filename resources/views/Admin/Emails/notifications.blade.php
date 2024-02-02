<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ trans('messages.Notification.NewNotification') }}</title>
    </head>
    <body>
        <h1>{{ trans('messages.Notification.NewNotification') }}</h1>
        <h3>
            {{ $notification->date }}
        </h3>
        <p>
            <span class="fw-semibold notify-modal-date">
            {{ $notification->name }}
            </span>
        <p>
        </p>
            <span class="fw-bold notify-modal-title">
            {{ $notification->description }}
            </span>
        </p>
        @if ($notification->route!=null)
            <a href="{{ request()->root().Storage::url($notification->route) }}">{{ trans('messages.AttachedFile') }}</a>
        @endif
    </body>
</html>
