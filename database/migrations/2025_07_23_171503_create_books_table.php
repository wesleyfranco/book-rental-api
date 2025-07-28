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
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name', 150)->unique();
            $table->text('synopsis');
            $table->string('publisher', 150);
            $table->string('edition', 10);
            $table->integer('page_number');
            $table->string('isbn', 30);
            $table->string('language', 50);
            $table->string('release_date', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
