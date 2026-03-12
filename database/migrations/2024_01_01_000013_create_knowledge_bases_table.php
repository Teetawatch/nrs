<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('knowledge_bases', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->text('excerpt')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('external_url')->nullable();
            $table->enum('type', ['article', 'video', 'link', 'file'])->default('article');
            $table->foreignId('category_id')->constrained('knowledge_categories');
            $table->integer('view_count')->default(0);
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('knowledge_bases');
    }
};
