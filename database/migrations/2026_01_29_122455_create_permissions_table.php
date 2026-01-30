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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., 'edit_posts'
            $table->string('label')->nullable(); // Human-readable label
            $table->timestamps();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->primary(['permission_id', 'role_id']); // Composite Primary Key
            $table->foreignId('permission_id')->constrained()->onDelete('cascade'); // Links to permissions
            $table->foreignId('role_id')->constrained()->onDelete('cascade'); // Links to roles
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('permission_role');
    }
};
