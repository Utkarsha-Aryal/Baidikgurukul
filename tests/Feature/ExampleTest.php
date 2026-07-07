<?php

namespace Tests\Feature;

use App\Models\BackPanel\Enquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_public_frontend_pages_render_successfully(): void
    {
        $paths = [
            '/',
            '/members',
            '/gallery',
            '/video',
            '/events',
            '/news',
            '/notices',
            '/about',
            '/contact',
            '/program',
            '/rules',
            '/form',
            '/certificate',
            '/message',
            '/timeline',
            '/birth',
        ];

        foreach ($paths as $path) {
            $this->get($path)->assertOk();
        }
    }

    public function test_contact_form_can_submit_without_captcha_when_not_configured(): void
    {
        config([
            'services.nocaptcha.sitekey' => null,
            'services.nocaptcha.secret' => null,
        ]);

        $response = $this->post(route('enquiry.save'), [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'message' => 'This is a browser verification message.',
        ]);

        $response
            ->assertOk()
            ->assertJson([
                'type' => 'success',
            ]);

        $this->assertSame(1, Enquiry::count());
    }
}
