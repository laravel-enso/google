<?php

namespace LaravelEnso\Google\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateSettings extends FormRequest
{
    public function rules()
    {
        return [
            'maps_url' => 'nullable|string|max:255',
            'places_url' => 'nullable|string|max:255',
            'recaptcha_url' => 'nullable|string|max:255',
        ];
    }
}
