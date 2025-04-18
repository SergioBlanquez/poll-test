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
        Schema::create('polls', function (Blueprint $table) {
            $table->id();

            $table->foreignId('poll_creator_id')->constrained('users')->where('poll_creator', true);

            $table->string('title');
            $table->text('description')->nullable();

            $table->tinyInteger('status')->default(0); // boolean

            $table->timestamp('start_date');
            $table->timestamp('end_date');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polls');
    }
};
