<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('google_settings', function (Blueprint $table) {
            $table->increments('id');

            $table->string('analytics_id')->nullable();
            $table->string('place_id')->nullable();
            $table->string('ads_id', 300)->nullable();
            $table->string('maps_key', 300)->nullable();
            $table->string('geocoding_key', 300)->nullable();
            $table->string('places_key', 300)->nullable();
            $table->string('maps_url')->nullable();
            $table->string('places_url')->nullable();
            $table->string('recaptcha_key', 300)->nullable();
            $table->string('recaptcha_secret', 300)->nullable();
            $table->string('recaptcha_url', 300)->nullable();
            $table->string('tag_manager_id')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('google_settings');
    }
};
