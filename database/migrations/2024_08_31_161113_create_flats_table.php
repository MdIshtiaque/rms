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
        Schema::create('flats', function (Blueprint $table) {
            $table->id();
            $table->string('ucode');
            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('description')->nullable();
            $table->foreignId('rent_by')->nullable()->constrained('users');
            $table->foreignId('rent_to')->nullable()->constrained('users');
            $table->foreignId('created_by')->constrained('users');
            $table->enum('type', ['Bachelor', 'Family', 'Couple', 'office']);
            $table->integer('member_no')->default(1);
            $table->decimal('rent', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flats');
    }
};
