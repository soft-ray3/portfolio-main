<?php

namespace Tests\Feature;

use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'message' => 'Hello, I would like to talk about a project.',
            'website' => '',
        ], $overrides);
    }

    public function test_valid_submission_stores_a_record_and_dispatches_the_mail(): void
    {
        Mail::fake();

        $response = $this->post(route('contact.store'), $this->payload());

        // Sent back to the contact section specifically, so the success
        // banner is immediately visible without scrolling.
        $response->assertRedirect(route('home') . '#contact');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);

        Mail::assertQueued(ContactMessageReceived::class, function (ContactMessageReceived $mail) {
            return $mail->contactMessage->email === 'jane@example.com';
        });
    }

    public function test_invalid_email_fails_validation(): void
    {
        Mail::fake();

        $response = $this->from('/')->post(route('contact.store'), $this->payload([
            'email' => 'not-an-email',
        ]));

        // Sent back to the contact section specifically (not the top of
        // the page), so the visitor actually sees their errors.
        $response->assertRedirect(route('home') . '#contact');
        $response->assertSessionHasErrors('email');

        $this->assertDatabaseCount('contact_messages', 0);
        Mail::assertNothingQueued();
    }

    public function test_a_filled_honeypot_is_silently_rejected(): void
    {
        Mail::fake();

        $response = $this->post(route('contact.store'), $this->payload([
            'website' => 'https://spam-bot.example',
        ]));

        $response->assertRedirect();
        $response->assertSessionDoesntHaveErrors();

        $this->assertDatabaseCount('contact_messages', 0);
        Mail::assertNothingQueued();
    }

    public function test_the_throttle_returns_429_on_the_sixth_attempt(): void
    {
        Mail::fake();

        for ($i = 0; $i < 5; $i++) {
            $response = $this->post(route('contact.store'), $this->payload([
                'email' => "jane{$i}@example.com",
            ]));

            $response->assertStatus(302);
        }

        $response = $this->post(route('contact.store'), $this->payload([
            'email' => 'jane6@example.com',
        ]));

        $response->assertStatus(429);
    }
}
