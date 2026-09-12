@props([
    'title' => config('portfolio.name') . ' | ' . config('portfolio.title'),
    'description' => config('portfolio.description'),
    'ogImage' => config('portfolio.images.og'),
    'canonical' => config('portfolio.url'),
])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="author" content="{{ config('portfolio.full_name') }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ $canonical }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ config('portfolio.url') }}{{ $ogImage }}">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $canonical }}">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ config('portfolio.url') }}{{ $ogImage }}">

    <link rel="icon" href="/favicon.ico" sizes="any">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@400..800&family=Instrument+Sans:wght@400..600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    @if ($canonical === config('portfolio.url'))
        <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "Person",
            "name": {!! json_encode(config('portfolio.full_name')) !!},
            "jobTitle": {!! json_encode(config('portfolio.title')) !!},
            "url": {!! json_encode(config('portfolio.url')) !!},
            "sameAs": {!! json_encode(array_values(config('portfolio.socials'))) !!}
        }
        </script>
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-bg font-sans text-ink">

    @include('partials.dock')

    {{ $slot }}

    @include('partials.footer')

</body>
</html>
