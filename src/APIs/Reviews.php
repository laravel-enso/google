<?php

namespace LaravelEnso\Google\APIs;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use LaravelEnso\Google\APIs\Exceptions\Places;
use LaravelEnso\Google\Models\Settings;

class Reviews
{
    private const Denied = 'REQUEST_DENIED';
    private const Invalid = 'INVALID_REQUEST';
    private const NoResults = 'ZERO_RESULTS';

    public function handle(): array
    {
        $response = Http::get($this->apiUrl(), [
            'fields' => 'user_ratings_total,rating,reviews',
            'reviews_no_translations' => true,
            'reviews_sort' => 'newest',
            'place_id' => $this->placeId(),
            'key' => $this->apiKey(),
        ]);

        $this->check($response);

        return $response->json('result');
    }

    private function check(Response $response): void
    {
        if ($response->json('status') === self::Denied) {
            throw Places::wrongApiKey();
        }

        if ($response->json('status') === self::Invalid) {
            throw Places::failed($response->json('error_message'));
        }

        if ($response->json('status') === self::NoResults) {
            throw Places::zeroResults();
        }
    }

    private function apiUrl(): string
    {
        $url = Settings::placesURL();

        if (! $url) {
            throw Places::missingApiUrl();
        }

        return $url;
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
