<section id="experience" class="px-4 py-24" aria-labelledby="experience-heading">
    <div class="mx-auto max-w-6xl">
        <x-section-heading
            class="rv"
            label="Track Record"
            heading="Experience"
            heading-id="experience-heading"
        />

        <div class="mt-12 divide-y divide-line overflow-hidden rounded-card border border-line bg-card shadow-soft">
            @foreach (config('portfolio.experience') as $row)
                <div class="group rv grid grid-cols-1 items-center gap-3 px-6 py-6 transition-transform duration-300 ease-out hover:translate-x-2.5 sm:grid-cols-[minmax(0,160px)_1fr_auto]">
                    <span class="label text-dim">{{ $row['from'] }} to {{ $row['to'] }}</span>

                    <div>
                        <p class="text-base font-medium text-ink sm:text-lg">
                            {{ $row['role'] }},
                            <span class="transition-colors duration-300 group-hover:text-accent">{{ $row['org'] }}</span>
                        </p>
                    </div>

                    <span class="label w-fit rounded-pill border border-line px-3 py-1 text-muted">
                        {{ $row['badge'] }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</section>
