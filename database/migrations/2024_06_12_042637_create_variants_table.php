<?php

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
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('character_id');
            $table->string('art');
            $table->string('art_filename');
            $table->string('rarity');
            $table->string('rarity_slug');
            $table->string('variant_order');
            $table->string('status');
            $table->string('full_description')->nullable();
            $table->string('inker')->nullable();
            $table->string('sketcher');
            $table->string('colorist')->nullable();
            $table->integer('possession')->nullable();
            $table->integer('usage_count')->nullable();
            $table->double('ReleaseDate');
            $table->string('UseIfOwn')->nullable();
            $table->string('PossesionShare');
            $table->string('UsageShare');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variant_models');
    }
};
