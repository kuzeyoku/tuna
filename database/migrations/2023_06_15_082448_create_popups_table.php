<?php

use App\Enums\StatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('popups', function (Blueprint $table) {
            $table->id();
            $table->enum("type", ["image", "video", "text"])->default("text");
            $table->string("image", 50)->nullable();
            $table->string("video")->nullable();
            $table->string("url")->nullable();
            $table->integer("time")->default(0);
            $table->integer("width")->default(600);
            $table->boolean("closeOnEscape")->default(false);
            $table->boolean("closeButton")->default(false);
            $table->boolean("overlayClose")->default(false);
            $table->boolean("pauseOnHover")->default(false);
            $table->boolean("fullScreenButton")->default(false);
            $table->string("color")->default("#88A0B9");
            $table->enum("status", StatusEnum::getValues())->default(StatusEnum::Active->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('popups');
    }
};
