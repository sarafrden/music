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
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->string('featuring')->nullable();
            $table->string('genre')->nullable();
            $table->string('sub_genre')->nullable();
            $table->string('label');
            $table->string('format');
            $table->foreignId('artist_id')->constrained()->onDelete('cascade');
            $table->date('release_date')->nullable();
            $table->string('cover_url')->nullable();
            $table->boolean('is_compilation')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
