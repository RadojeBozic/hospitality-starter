@php
    $supported = config('i18n.supported');
    $path = request()->path();
    $parts = explode('/', $path);
    array_shift($parts); // skini trenutni locale
    $rest = implode('/', $parts);
@endphp

@foreach ($supported as $locale => $meta)
    <link rel="alternate" hreflang="{{ $locale }}" href="{{ url($locale . ($rest ? '/' . $rest : '')) }}" />
@endforeach
<link rel="alternate" hreflang="x-default" href="{{ url(config('i18n.default') . ($rest ? '/' . $rest : '')) }}" />
