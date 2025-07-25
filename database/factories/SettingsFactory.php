<?php

namespace LaravelEnso\Google\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LaravelEnso\Google\Models\Settings as Model;

class SettingsFactory extends Factory
{
    protected $model = Model::class;

    public function definition()
    {
        return [
            'maps_url' => 'https://maps.googleapis.com/maps/api/geocode/json',
            'recaptcha_url' => 'https://www.google.com/recaptcha/api/siteverify',
            'places_url' => 'https://maps.googleapis.com/maps/api/place/details/json',
        ];
    }
}
