<?php

namespace LaravelEnso\Google\APIs\Exceptions;

use LaravelEnso\Helpers\Exceptions\EnsoException;

class Localize extends EnsoException
{
    public static function missingApiUrl(): self
    {
        return new static(__('Google maps api url is missing'));
    }

    public static function missingApiKey(): self
    {
        return new static(__('Google maps api key is missing'));
    }

    public static function wrongApiKey(): self
    {
        return new static(__('Google maps api key is incorrect'));
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
