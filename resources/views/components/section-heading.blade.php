@props([
    'label' => null,
    'heading',
    'subheading' => null,
    'headingId' => null,
])

<div {{ $attributes->class(['max-w-2xl']) }}>
    @if($label)
        <span class="label text-accent">{{ $label }}</span>
    @endif

    <h2 @if($headingId) id="{{ $headingId }}" @endif class="mt-3 text-3xl font-semibold text-ink sm:text-4xl">
        {{ $heading }}
    </h2>

    @if($subheading)
        <p class="mt-4 text-base text-muted sm:text-lg">{{ $subheading }}</p>
    @endif
</div>
