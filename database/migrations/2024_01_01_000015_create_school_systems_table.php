<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_systems', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('url');
            $table->string('icon')->nullable();
            $table->string('logo')->nullable();
            $table->string('color')->default('#3B82F6');
            $table->foreignId('category_id')->nullable()->constrained('system_categories')->nullOnDelete();
            $table->boolean('open_new_tab')->default(true);
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_systems');
    }
};
