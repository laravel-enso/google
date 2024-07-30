<?php

namespace LaravelEnso\Google\APIs;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use LaravelEnso\Google\APIs\Exceptions\Localize;
use LaravelEnso\Google\Models\Settings;

class Geocoding
{
    private const Denied = 'REQUEST_DENIED';
    private const Invalid = 'INVALID_REQUEST';
    private const NoResults = 'ZERO_RESULTS';

    public function __construct(private string $address)
    {
    }

    public function handle(): array
    {
        $response = Http::get($this->apiUrl(), [
            'address' => $this->address,
            'key' => $this->apiKey(),
        ]);

        $this->check($response);

        return $response->json('results')[0];
    }

    private function check(Response $response): void
    {
        if ($response->json('status') === self::Denied) {
            throw Localize::wrongApiKey();
        }

        if ($response->json('status') === self::Invalid) {
            throw Localize::failed($response->json('error_message'));
        }

        if ($response->json('status') === self::NoResults) {
            throw Localize::zeroResults();
        }
    }

    private function apiUrl(): string
    {
        $url = Settings::mapsURL();

        if (! $url) {
            throw Localize::missingApiUrl();
        }

        return $url;
    }

    private function apiKey(): string
    {
        $key = Settings::geocodingKey();

        if (! $key) {
            throw Localize::missingApiKey();
        }

        return $key;
    }
}
