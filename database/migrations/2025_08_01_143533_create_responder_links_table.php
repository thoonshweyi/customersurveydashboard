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
        Schema::create('responder_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("form_id");
            $table->unsignedBigInteger("branch_id");
            $table->string('url');
            $table->string('image');
            $table->unsignedBigInteger("status_id");
            $table->unsignedBigInteger("user_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responder_links');
    }
};
