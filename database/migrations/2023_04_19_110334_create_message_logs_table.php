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
        Schema::create('message_logs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->on('users')->references("id")->onDelete("CASCADE");

            $table->unsignedBigInteger("brooker_id")->nullable();
            $table->foreign("brooker_id")->on('brookers')->references("id")->onDelete("SET NULL");

            $table->string("title");
            $table->string("body");
            $table->unsignedBigInteger("unit");
            $table->unsignedBigInteger("total_cost")->default(0);
            $table->enum("status",["pending","delivered","failed"])->default("delivered");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_logs');
    }
};
