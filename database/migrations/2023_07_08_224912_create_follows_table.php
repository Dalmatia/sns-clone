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
        Schema::create('followers', function (Blueprint $table) {
            $table->unsignedInteger('following_id')->comment('フォローしているユーザーのID');
            $table->unsignedInteger('followed_id')->comment('フォローされているユーザーのID');

            $table->index('following_id');
            $table->index('followed_id');

            $table->unique([
                'following_id',
                'followed_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followers');
    }
};
