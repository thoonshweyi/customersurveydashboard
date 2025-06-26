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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_no')->nullable();
            $table->string('employee_id',12)->nullable();
            $table->bigInteger('branch_id')->nullable();
            $table->integer('status')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("phone_no");
            $table->dropColumn("employee_id");
            $table->dropColumn("branch_id");
            $table->dropColumn("status");
        });
    }
};
