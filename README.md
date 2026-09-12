# Rayfolio

Personal portfolio for Raymond Onah (Ugochukwu Raymond Onah), built as a Laravel 12 application. Single marketing-style page (`resources/views/welcome.blade.php`) plus a working contact form backed by MySQL and mail.

## Stack

- Laravel 12, PHP 8.2+ (spec called for 8.3; this environment ships 8.2, which Laravel 12 fully supports)
- Blade templates, no Livewire/Inertia/React
- Tailwind CSS v4 via Vite (`@theme` tokens in `resources/css/app.css`)
- Three.js (npm, code-split into its own chunk) for the hero 3D scene
- MySQL for the `contact_messages` table

## Setup

1. Install PHP and Node dependencies:

   ```bash
   composer install
   npm install
   ```

2. Copy `.env.example` to `.env` (already done in this repo) and set:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=rayfolio
   DB_USERNAME=root
   DB_PASSWORD=

   CONTACT_TO_EMAIL=onahraymond18@gmail.com
   ```

   Create the database first: `CREATE DATABASE rayfolio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;`

3. Generate an app key (skip if `.env` already has one) and migrate:

   ```bash
   php artisan key:generate
   php artisan migrate
   ```

4. Build front-end assets:

   ```bash
   npm run build
   ```

   (use `npm run dev` while actively working on styles/scripts)

5. Serve:

   ```bash
   php artisan serve
   ```

## Mail configuration

Contact form submissions are stored in `contact_messages` **and** emailed to `CONTACT_TO_EMAIL` via the queued `App\Mail\ContactMessageReceived` mailable. In `.env`, `MAIL_MAILER=log` by default, meaning mail bodies land in `storage/logs/laravel.log` instead of being sent — good for local development, useless in production.

To actually send mail, set real SMTP credentials in `.env`, for example with Gmail (using an [app password](https://myaccount.google.com/apppasswords), not your normal password) or any transactional provider (Postmark, Mailgun, SES, etc.):

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.your-provider.com
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@rayfolio.me"
MAIL_FROM_NAME="Rayfolio"

CONTACT_TO_EMAIL=onahraymond18@gmail.com
```

Because the mailable is queued, also run a queue worker in production (`QUEUE_CONNECTION` defaults to `database`):

```bash
php artisan queue:work
```

Without a running worker, queued mail sits in the `jobs` table until one is started.

## Assets to drop in

These files are referenced by the site but are environment-specific, so they are not guaranteed to exist. Every image has a graceful CSS/SVG fallback if missing, so the site still looks intentional without them.

| File | Where | Used for |
|---|---|---|
| `public/images/me.jpg` | already included | reserved headshot asset (not currently rendered on the page, kept for future use) |
| `public/images/about1.jpg` | already included | first About section portrait |
| `public/images/about2.jpg` | already included | second About section portrait |
| `public/images/og.png` | **add this**, 1200x630 | Open Graph / Twitter card preview image |
| `public/resume.pdf` | already included | "Resume" link in the dock nav |
| `public/images/projects/dmart.jpg` | **add this** | DMART project card thumbnail |
| `public/images/projects/kiosc.jpg` | **add this** | Kiosc project card thumbnail |

Project copy, tags, links, and thumbnail paths all live in `config/portfolio.php` — edit that file to add, remove, or change projects instead of touching the Blade views.

## Tests

```bash
php artisan test
```

`tests/Feature/ContactFormTest.php` covers: a valid submission stores a record and queues the mail, an invalid email fails validation, a filled honeypot (`website` field) is silently rejected with no record/mail, and the sixth request within a minute from the same IP gets throttled (429).

## Project structure

```
resources/views/
  welcome.blade.php          Full HTML document, includes every partial in order
  partials/                  One file per page section (dock, hero, strip, about, work, ...)
  components/                <x-section-heading>, <x-project-card>
resources/js/
  app.js                     Scroll-reveal observer, headline reveal, wires up tilt.js and three-hero.js
  three-hero.js               Hero's 3D scene (dynamically imported, only loads once #hero-scene exists)
  tilt.js                     Pointer-driven 3D tilt for project cards
config/portfolio.php          All site copy/data: name, socials, experience, projects, services
app/Http/Controllers/ContactController.php
app/Http/Requests/ContactRequest.php
app/Mail/ContactMessageReceived.php
app/Models/ContactMessage.php
database/migrations/..._create_contact_messages_table.php
```

## Notes

- Light mode only, no dark mode toggle, by design.
- All animations respect `prefers-reduced-motion`.
- The hero's Three.js scene lazy-initialises via `IntersectionObserver` and is code-split into its own bundle chunk so it never blocks first paint; it also degrades to a static SVG wireframe cube if WebGL is unavailable or the visitor prefers reduced motion.
