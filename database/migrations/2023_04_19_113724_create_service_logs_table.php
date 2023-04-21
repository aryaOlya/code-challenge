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
        Schema::create('service_logs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->on('users')->references("id")->onDelete("CASCADE");

            $table->unsignedBigInteger("service_id")->nullable();
            $table->foreign("service_id")->on('services')->references("id")->onDelete("SET NULL");

            $table->unsignedBigInteger("unit");
            $table->unsignedBigInteger("total_cost");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_logs');
    }
};
