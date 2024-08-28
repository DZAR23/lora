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
        Schema::create('conductores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('movil');
            $table->string('categoria');
            $table->string('imagen');
            $table->string('email');
            $table->string('telefono');
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con la tabla 'users'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conductores');
    }
};
