<section id="work" class="px-4 py-24" aria-labelledby="work-heading">
    <div class="mx-auto max-w-6xl">
        <x-section-heading
            class="rv"
            label="My Work"
            heading="Here's what I've been building."
            subheading="Live products with real users, not case studies made for a portfolio."
            heading-id="work-heading"
        />

        <div class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-2">
            @foreach (config('portfolio.projects') as $project)
                <x-project-card :project="$project" />
            @endforeach
        </div>
    </div>
</section>
