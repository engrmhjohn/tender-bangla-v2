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
        Schema::create('tenders', function (Blueprint $table) {
            $table->id();
            
            // Change district_id to store multiple district IDs in JSON format
            $table->json('district_id'); 
            
            // Retain foreign key constraints for subcategory
            $table->foreignId('sub_category_id')->constrained('tender_sub_categories')->onDelete('cascade');
        
            $table->string('link_name');
            
            // Images and other fields
            $table->text('tender_image_one');
            $table->text('tender_image_two')->nullable();
            $table->text('tender_image_three')->nullable();
            $table->text('tender_image_four')->nullable();
            $table->text('tender_image_five')->nullable();
            
            $table->date('tender_validity');
            $table->string('tender_type'); //paid or free
            $table->string('status');
            $table->timestamps();
        });        
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenders');
    }
};
