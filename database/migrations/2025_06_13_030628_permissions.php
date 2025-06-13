<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->unique(); // contoh: VIEW_USER, EDIT_USER, APPROVE_REQUEST
            $table->string('name', 200);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('created_by', 100)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->string('modified_by', 100)->nullable();
            $table->timestamp('modified_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};