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
        Schema::create('homepage_c_m_s', function (Blueprint $table) {
            $table->id();
            $table->longText('logo'); 
            $table->longText('header_banner_image'); 
            $table->string('login_register_btn_text');
            $table->string('header_banner_text');
            $table->string('header_btn_text');
            $table->string('category_btn_text');
            $table->string('contact_header_text');
            $table->string('office_address');
            $table->string('contact_email_one');
            $table->string('contact_email_two')->nullable();
            $table->string('contact_phone_one');
            $table->string('contact_phone_two')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_c_m_s');
    }
};
