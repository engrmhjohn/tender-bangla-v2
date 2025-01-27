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
        Schema::create('tender_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('tender_categories')->onDelete('cascade');
            $table->string('sub_category_name');
            $table->text('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tender_sub_categories');
    }
};
