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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Default Laravel
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(); // nullable untuk dukung SSO
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();

            // Tambahan Enterprise
            $table->string('username', 100)->unique()->nullable();
            $table->string('other_email', 300)->nullable();

            $table->enum('auth_provider', ['LOCAL', 'AZURE'])->default('LOCAL');
            $table->string('external_id', 300)->nullable(); // Object ID dari Azure SSO

            $table->boolean('is_active')->default(true);
            $table->boolean('is_email_verified')->default(false);

            $table->string('company', 300)->nullable();
            $table->string('jabatan', 300)->nullable();
            $table->string('role', 100)->nullable();
            $table->string('region', 300)->nullable();

            // Keamanan login
            $table->integer('failed_login_attempt')->default(0);
            $table->timestamp('lockout_until')->nullable();
            $table->timestamp('last_password_change')->nullable();
            $table->timestamp('last_login_date')->nullable();
            $table->string('token_login', 300)->nullable();

            // Audit trail
            $table->string('created_by', 100)->nullable();
            $table->timestamp('created_date')->useCurrent();
            $table->string('modified_by', 100)->nullable();
            $table->timestamp('modified_date')->useCurrent();

            // IP address (track login ip)
            $table->string('ip_address', 45)->nullable();
        });

        // Tetap bawa bawaan Laravel
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};