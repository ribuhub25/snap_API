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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->integer('cost');
            $table->integer('power');
            $table->string('ability')->nullable();
            $table->string('flavor')->nullable();
            $table->string('art');
            $table->string('alternate_art')->nullable();
            $table->string('url');
            $table->string('status');
            $table->string('carddefid');
            $table->string('source');
            $table->string('source_slug');
            $table->string('rarity')->nullable();
            $table->string('rarity_slug')->nullable();
            $table->string('difficulty')->nullable();
            $table->string('sketcher')->nullable();
            $table->string('inker')->nullable();
            $table->string('colorist')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_models');
    }
};
