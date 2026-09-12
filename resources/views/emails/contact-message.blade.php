<x-mail::message>
# New message from {{ $contactMessage->name }}

**Email:** {{ $contactMessage->email }}

**Message:**

{{ $contactMessage->message }}

---

Sent from the contact form at {{ config('portfolio.url') }}

</x-mail::message>
