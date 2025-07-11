<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('google_settings', function (Blueprint $table) {
            $table->increments('id');

            $table->string('maps_url')->nullable();
            $table->string('places_url')->nullable();
            $table->string('recaptcha_url', 300)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('google_settings');
    }
};
