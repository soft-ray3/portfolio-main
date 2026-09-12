<section id="contact" class="px-4 py-24" aria-labelledby="contact-heading">
    <div class="mx-auto max-w-6xl">
        <div class="grid grid-cols-1 gap-14 md:grid-cols-2">

            {{-- Left: intro + direct links --}}
            <div class="rv">
                <span class="label text-accent">Let's Connect</span>
                <h2 id="contact-heading" class="mt-3 text-3xl font-semibold text-ink sm:text-4xl">Get in touch</h2>
                <p class="mt-4 max-w-md text-base leading-relaxed text-muted sm:text-lg">
                    Have a product to build or a team that needs an extra pair of hands. Send a message, or reach me directly below.
                </p>

                <div class="mt-8 flex flex-col gap-3">
                    <a
                        href="mailto:{{ config('portfolio.contact_email') }}"
                        class="flex items-center gap-3 rounded-card border border-transparent bg-card px-5 py-4 shadow-soft transition-all duration-300 ease-out hover:translate-x-[5px] hover:border-accent"
                    >
                        <svg aria-hidden="true" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FF5C28" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="4" width="20" height="16" rx="2"/>
                            <path d="m22 6-10 7L2 6"/>
                        </svg>
                        <span class="text-sm font-medium text-ink">{{ config('portfolio.contact_email') }}</span>
                    </a>

                    <a
                        href="{{ config('portfolio.socials.x') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center gap-3 rounded-card border border-transparent bg-card px-5 py-4 shadow-soft transition-all duration-300 ease-out hover:translate-x-[5px] hover:border-accent"
                    >
                        <svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="#FF5C28">
                            <path d="M18.9 1.5h3.7l-8.1 9.3 9.5 12.7h-7.5l-5.9-7.7-6.7 7.7H.4l8.7-9.9L0 1.5h7.6l5.4 7.1Zm-1.3 19.5h2L6.5 3.4h-2Z"/>
                        </svg>
                        <span class="text-sm font-medium text-ink">X / Twitter</span>
                    </a>

                    <a
                        href="{{ config('portfolio.socials.tiktok') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center gap-3 rounded-card border border-transparent bg-card px-5 py-4 shadow-soft transition-all duration-300 ease-out hover:translate-x-[5px] hover:border-accent"
                    >
                        <svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="#FF5C28">
                            <path d="M16.6 5.82c-.9-.8-1.44-1.94-1.44-3.2h-3.09v12.4a2.59 2.59 0 0 1-2.59 2.5c-1.42 0-2.59-1.16-2.59-2.6c0-1.72 1.66-3.01 3.37-2.48V9.66c-3.45-.46-6.47 2.22-6.47 5.64c0 3.33 2.76 5.7 5.69 5.7c3.14 0 5.69-2.55 5.69-5.7V9.01a7.35 7.35 0 0 0 4.3 1.38V7.3s-1.88.09-3.24-1.48z"/>
                        </svg>
                        <span class="text-sm font-medium text-ink">TikTok</span>
                    </a>
                </div>
            </div>

            {{-- Right: form card --}}
            <div class="rv rounded-card border border-line bg-card p-7 shadow-lift sm:p-9">
                @if (session('success'))
                    <div class="mb-6 flex items-center gap-3 rounded-card border border-accent/30 bg-accent/10 px-5 py-4 text-sm text-ink" role="status">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-accent text-white">
                            <svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 6 9 17l-5-5"/>
                            </svg>
                        </span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" novalidate>
                    @csrf

                    {{-- Honeypot: hidden from sighted users and screen readers alike --}}
                    <div class="absolute h-0 w-0 overflow-hidden opacity-0" aria-hidden="true">
                        <label for="website">Leave this field empty</label>
                        <input type="text" id="website" name="website" tabindex="-1" autocomplete="off" value="{{ old('website') }}">
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label for="name" class="label mb-2 block text-muted">Name</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                class="w-full rounded-card border border-line bg-bg px-4 py-3 text-ink transition focus:border-accent focus:outline-none"
                            >
                            @error('name')
                                <p class="mt-2 text-sm text-accent">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="label mb-2 block text-muted">Email</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                class="w-full rounded-card border border-line bg-bg px-4 py-3 text-ink transition focus:border-accent focus:outline-none"
                            >
                            @error('email')
                                <p class="mt-2 text-sm text-accent">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="message" class="label mb-2 block text-muted">Message</label>
                            <textarea
                                id="message"
                                name="message"
                                rows="5"
                                required
                                class="w-full rounded-card border border-line bg-bg px-4 py-3 text-ink transition focus:border-accent focus:outline-none"
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-2 text-sm text-accent">{{ $message }}</p>
                            @enderror
                        </div>

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-pill bg-ink px-6 py-3.5 text-sm font-medium text-white shadow-soft transition hover:bg-accent sm:w-auto"
                        >
                            <span>Send message</span>
                            <svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"/>
                                <path d="m13 6 6 6-6 6"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
