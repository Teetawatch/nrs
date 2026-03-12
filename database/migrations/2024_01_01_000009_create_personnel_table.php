<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personnel', function (Blueprint $table) {
            $table->id();
            $table->string('prefix');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug')->unique();
            $table->string('position');
            $table->string('rank')->nullable();
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->enum('role_type', ['commander', 'unit_head', 'teacher', 'staff'])->default('staff');
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personnel');
    }
};
