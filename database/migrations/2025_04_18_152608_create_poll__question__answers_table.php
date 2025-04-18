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
        Schema::create('poll__question__answers', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Poll_Question::class)->constrained();
            $table->foreignIdFor(\App\Models\User::class)->constrained();

            $table->text('answer')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poll__question__answers');
    }
};
