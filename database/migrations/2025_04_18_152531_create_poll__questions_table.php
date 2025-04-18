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
        Schema::create('poll__questions', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Poll::class)->constrained();

            $table->tinyInteger('type')->default(1); // enum

            $table->string('title');

            $table->boolean('required')->default(false);

            $table->text('options')->nullable(); // json

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poll__questions');
    }
};
