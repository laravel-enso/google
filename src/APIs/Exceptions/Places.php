<?php

namespace LaravelEnso\Google\APIs\Exceptions;

use LaravelEnso\Helpers\Exceptions\EnsoException;

class Places extends EnsoException
{
    public static function missingApiUrl(): self
    {
        return new static(__('Google places api url is missing'));
    }

    public static function missingApiKey(): self
    {
        return new static(__('Google places api key is missing'));
    }

    public static function missingPlaceId(): self
    {
        return new static(__('Google place id is missing'));
    }

    public static function error(string $status, string $message): self
    {
        return new static(__(
            'Google places api returned the status: ":status" with the error: ":error"',
            [
                'status' => $status,
                'error' => $message,
            ]
        ));
    }
}
