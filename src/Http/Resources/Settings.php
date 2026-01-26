<?php

namespace LaravelEnso\Google\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LaravelEnso\Google\Models\Settings as Model;

class Settings extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'recaptchaKey' => Model::recaptchaKey(),
            'tagManagerId' => Model::tagManagerId(),
        ];
    }
}
