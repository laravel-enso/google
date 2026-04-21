<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use LaravelEnso\Google\Models\Settings;
use LaravelEnso\Google\Validation\Recaptcha;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RecaptchaTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Settings::query()->updateOrCreate([
            'id' => Config::get('enso.google.settingsId'),
        ], [
            'recaptcha_url' => 'https://recaptcha.test/verify',
            'recaptcha_secret' => 'test-secret',
        ]);
    }

    #[Test]
    public function passes_when_google_confirms_the_token(): void
    {
        Http::fake([
            'https://recaptcha.test/verify*' => Http::response(['success' => true]),
        ]);

        $validator = Validator::make([
            'captcha' => 'valid-token',
        ], [
            'captcha' => [new Recaptcha()],
        ]);

        $this->assertTrue($validator->passes());
    }

    #[Test]
    public function fails_when_google_rejects_the_token(): void
    {
        Http::fake([
            'https://recaptcha.test/verify*' => Http::response(['success' => false]),
        ]);

        $validator = Validator::make([
            'captcha' => 'invalid-token',
        ], [
            'captcha' => [new Recaptcha()],
        ]);

        $this->assertTrue($validator->fails());
        $this->assertSame(
            'Recaptcha verification failed, please reload the page...',
            $validator->errors()->first('captcha')
        );
    }
}
