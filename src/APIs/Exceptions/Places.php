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

    public static function wrongApiKey(): self
    {
        return new static(__('Google places api key is incorrect'));
    }

    public static function zeroResults(): self
    {
        return new static(__('Zero results found'));
    }

    public static function failed(string $message): self
    {
        return new static(__($message));
    }
}
