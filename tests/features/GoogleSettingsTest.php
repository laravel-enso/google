<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use LaravelEnso\Google\Models\Settings;
use LaravelEnso\Users\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GoogleSettingsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed()
            ->actingAs(User::first());
    }

    #[Test]
    public function index_creates_settings_when_missing(): void
    {
        $this->assertNull(Settings::query()->find(1));

        $this->get(route('integrations.google.settings.index', [], false))
            ->assertStatus(200)
            ->assertJsonStructure(['form']);

        $this->assertNotNull(Settings::query()->find(1));
    }

    #[Test]
    public function can_update_settings(): void
    {
        $settings = Settings::factory()->create([
            'maps_url' => 'https://old.example/maps',
            'places_url' => 'https://old.example/places',
            'recaptcha_url' => 'https://old.example/recaptcha',
        ]);

        $payload = [
            'maps_url' => 'https://new.example/maps',
            'places_url' => 'https://new.example/places',
            'recaptcha_url' => 'https://new.example/recaptcha',
        ];

        $this->patch(route('integrations.google.settings.update', $settings->id, false), $payload)
            ->assertStatus(200)
            ->assertJsonFragment(['message' => 'Settings were stored sucessfully']);

        $this->assertSame($payload['maps_url'], $settings->fresh()->maps_url);
        $this->assertSame($payload['places_url'], $settings->fresh()->places_url);
        $this->assertSame($payload['recaptcha_url'], $settings->fresh()->recaptcha_url);
    }

    #[Test]
    public function rejects_invalid_settings_payload(): void
    {
        $settings = Settings::factory()->create();

        $this->patch(route('integrations.google.settings.update', $settings->id, false), [
            'maps_url' => str_repeat('x', 256),
            'places_url' => 'https://new.example/places',
            'recaptcha_url' => 'https://new.example/recaptcha',
        ])->assertStatus(302)
            ->assertSessionHasErrors(['maps_url']);
    }

    #[Test]
    public function reads_recaptcha_url_from_database_settings(): void
    {
        Settings::factory()->create([
            'recaptcha_url' => 'https://db.example/recaptcha',
        ]);

        Config::set('enso.google.recaptchaUrl', 'https://config.example/recaptcha');

        $this->assertSame('https://db.example/recaptcha', Settings::recaptchaUrl());
    }
}
