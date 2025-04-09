<?php

namespace LaravelEnso\Google\APIs;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use LaravelEnso\Google\APIs\Exceptions\Places;
use LaravelEnso\Google\Models\Settings;

class Reviews
{
    public function handle(): array
    {
        $response = Http::withHeaders([
            'X-Goog-Api-Key' => $this->apiKey(),
            'X-Goog-FieldMask' => 'displayName,formattedAddress,rating,userRatingCount',
            'Referer' => Config::get('app.url'),
        ])->get($this->apiUrl());

        $this->check($response);

        return $response->json();
    }

    private function check(Response $response): void
    {
        $error = $response->json('error');

        if ($error) {
            throw Places::error($error['code'], $error['message']);
        }
    }

    private function apiUrl(): string
    {
        $url = Settings::placesURL();

        if (! $url) {
            throw Places::missingApiUrl();
        }

        return "{$url}/{$this->placeId()}";
    }

    private function placeId(): string
    {
        $key = Settings::placeId();

        if (! $key) {
            throw Places::missingPlaceId();
        }

        return $key;
    }

    private function apiKey(): string
    {
        $key = Settings::placesKey();

        if (! $key) {
            throw Places::missingApiKey();
        }

        return $key;
    }
}
