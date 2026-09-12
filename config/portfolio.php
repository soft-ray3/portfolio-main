<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Site identity
    |--------------------------------------------------------------------------
    */
    'name' => 'Ugochukwu Raymond ',
    'handle' => 'Raymond',
    'full_name' => 'Ugochukwu Raymond ',
    'title' => 'Software engineer and founder based in Nigeria.',
    'tagline' => 'Software engineer and founder based in Nigeria.',
    'url' => env('APP_URL', 'https://rayfolio.me'),

    'description' => 'Ugochukwu Raymond is a Nigerian software engineer and founder. ',

    /*
    |--------------------------------------------------------------------------
    | Contact
    |--------------------------------------------------------------------------
    */
    'contact_email' => env('CONTACT_TO_EMAIL', 'onahraymond18@gmail.com'),

    /*
    |--------------------------------------------------------------------------
    | Socials
    |--------------------------------------------------------------------------
    */
    'socials' => [

        'x' => 'https://x.com/soft__ray3',
        'instagram' => 'https://www.instagram.com/soft.ray3',
        'tiktok' => 'https://www.tiktok.com/@soft.ray3',
    ],

    'resume' => '/resume.pdf',

    /*
    |--------------------------------------------------------------------------
    | Images
    |--------------------------------------------------------------------------
    */
    'images' => [
        'me' => '/images/me.jpg',
        'about1' => '/images/about1.jpg',
        'about2' => '/images/about2.jpg',
        'og' => '/images/og.png',
    ],

    /*
    |--------------------------------------------------------------------------
    | Experience
    |--------------------------------------------------------------------------
    */
    'experience' => [
        [
            'from' => '2025',
            'to' => 'Present',
            'role' => 'Founder and Lead Engineer',
            'org' => 'DMART',
            'badge' => 'Marketplace',
        ],
        [
            'from' => '2025',
            'to' => 'Present',
            'role' => 'Founder and Lead Engineer',
            'org' => 'Kiosc',
            'badge' => 'SaaS',
        ],
        [
            'from' => '2023',
            'to' => 'Present',
            'role' => 'Full-stack Developer',
            'org' => 'Independent',
            'badge' => 'Client work',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Projects
    |--------------------------------------------------------------------------
    */
    'projects' => [
        [
            'title' => 'Rayfolio',
            'slug' => 'rayfolio',
            'short' => 'My personal portfolio',
            'blurb' => 'A personal portfolio designed and developed to showcase my work, skills, experience, and journey as a developer. Built with a strong focus on modern visual design, smooth interactions, responsive layouts, and a refined user experience. ',
            'tags' => ['React', 'Tailwind CSS', 'Three.js'],
            'url' => 'https://rayfolio.me',
            'status' => 'live',
            'thumbnail' => '/images/projects/rayfolio.jpg',
            'gallery' => [
                '/images/projects/rayfolio.jpg',
            ],
        ],
        [
            'title' => 'DMART',
            'slug' => 'dmart',
            'short' => 'Campus marketplace for buying and selling.',
            'blurb' => 'A campus-focused marketplace connecting students to buy, sell, discover products, services, and opportunities within their school community.',
            'tags' => ['Laravel', 'Tailwind','MySQL', 'Payment API', 'real-time notifications', 'Livewire'],
            'url' => 'https://dmart.ng',
            'status' => 'live',
            'thumbnail' => '/images/projects/dmart.jpg',
            'gallery' => [
                '/images/projects/dmart.jpg',
            ],
        ],
        [
            'title' => 'Kiosc',
            'slug' => 'kiosc',
            'short' => 'Storefront software for African merchants.',
            'blurb' => 'A platform that helps businesses create, manage, and grow their online presence with affordable, easy-to-use business websites and tools.',
            'tags' => ['Laravel', 'Multi-tenant','Tailwind','MySQL',  'Livewire', 'Domain'],
            'url' => 'https://getkiosc.com',
            'status' => 'live',
            'thumbnail' => '/images/projects/kiosc.jpg',
            'gallery' => [
                '/images/projects/kiosc.jpg',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Tilted strip marquee
    |--------------------------------------------------------------------------
    */
    'strip' => [
        'Laravel', 'Livewire', 'Tailwind CSS', 'MySQL', 'Github',
        'Next.js', 'Alpine.js', 'Wordpress', 'PHP', 'JavaScript',
    ],

    /*
    |--------------------------------------------------------------------------
    | Services
    |--------------------------------------------------------------------------
    */
    'services' => [
        [
            'title' => 'Build the product',
            'body' => 'Laravel applications built for production with queues, webhooks, multi-tenancy, and a data model that will not fight you in six months.',
        ],
        [
            'title' => 'Design the interface',
            'body' => 'Screens and design systems drawn with the code in mind, so what you approve is what gets shipped.',
        ],
        [
            'title' => 'Payments and infrastructure',
            'body' => 'Paystack integrations, subscription tiers, VPS provisioning, SSL, and Cloudflare.',
        ],
    ],

];
