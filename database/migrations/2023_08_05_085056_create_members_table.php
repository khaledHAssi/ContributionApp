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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['subscriber', 'contributor'])->default('contributor');
            $table->string('phone', 12);
            $table->integer('identification_number');
            $table->integer('salary');
            // $table->integer('family_members_number');
            $table->integer('contributions');
            $table->date('birthday');
            $table->string('job');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
