<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();

            $table->string('name_en');
            $table->string('name_ar')->nullable();
            $table->string('slug')->unique();

            $table->string('excerpt_en', 500)->nullable();
            $table->string('excerpt_ar', 500)->nullable();

            $table->longText('description_en')->nullable();
            $table->longText('description_ar')->nullable();

            $table->longText('ingredients')->nullable();
            $table->json('benefits')->nullable();

            $table->string('image_path')->nullable();
            $table->string('og_image_path')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['published', 'draft'])->default('published');
            $table->timestamp('published_at')->nullable();

            $table->string('seo_title', 70)->nullable();
            $table->string('seo_description', 160)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
