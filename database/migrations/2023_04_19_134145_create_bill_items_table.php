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
        Schema::create('bill_items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->on("users")->references("id")->onDelete("CASCADE");


            $table->unsignedBigInteger("bill_id")->nullable();
            $table->foreign("bill_id")->on("bills")->references("id")->onDelete("CASCADE");

            $table->morphs("bill_itemable");
            $table->unsignedBigInteger("total_cost");
            $table->unsignedBigInteger("status")->default(0);
            $table->tinyInteger("month");
            $table->tinyInteger("year");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_items');
    }
};
