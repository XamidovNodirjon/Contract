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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('individual')->change(); // 'individual' yoki 'legal_entity'
            $table->string('first_name')->nullable(); // Faqat jismoniy shaxslar uchun
            $table->string('last_name')->nullable(); // Faqat jismoniy shaxslar uchun
            $table->string('passport_number')->nullable(); // Faqat jismoniy shaxslar uchun
            $table->string('phone')->nullable(); // Faqat jismoniy shaxslar uchun
            $table->string('signature_path'); // Faqat jismoniy shaxslar uchun Imzo rasmning yo'li
            $table->text('additional_info')->nullable();  // Qoshimcha ma'lumot uchun textarea
            $table->string('company_name')->nullable(); // Faqat yuridik shaxslar uchun
            $table->string('inn')->nullable(); // Faqat yuridik shaxslar uchun
            $table->string('director_name')->nullable(); // Faqat yuridik shaxslar uchun
            $table->string('email')->nullable(); // Faqat yuridik shaxslar uchun
            $table->string('e_signature')->nullable(); // Yuridik shaxslar uchun elektron imzo fayli
            $table->boolean('offer_accepted')->default(false); // Ommaviy ofertani qabul qilish
            $table->string('image')->nullable(); //imzoni yuklash uchun imzoni rasmga oladi
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
