<?php

namespace LaravelEnso\Google\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Settings extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'recaptchaKey' => $this->recaptcha_key,
            'tagManagerId' => $this->tag_manager_id,
        ];
    }
}
