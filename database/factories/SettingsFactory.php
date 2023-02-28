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
            'analytics_id' => null,
            'ads_id' => null,
            'maps_key' => 'https://maps.googleapis.com/maps/api/geocode/json',
            'maps_url' => null,
            'recaptcha_key' => null,
            'recaptcha_url' => 'https://www.google.com/recaptcha/api/siteverify',
            'recaptcha_secret' => null,
            'tag_manager_id' => null,
        ];
    }
}
