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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., 'admin', 'editor'
            $table->string('label')->nullable(); // Human-readable name
            $table->timestamps();
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->primary(['user_id', 'role_id']); // Composite Primary Key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Links to users
            $table->foreignId('role_id')->constrained()->onDelete('cascade'); // Links to roles
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('role_user');
    }
};
