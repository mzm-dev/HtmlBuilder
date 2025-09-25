<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {

        Schema::create('form_builder_responses', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID untuk kunci utama respons
            $table->uuid('form_id'); // Kunci asing untuk menghubungkan ke jadual `forms`
            $table->json('data'); // Lajur JSON untuk menyimpan data respons
            $table->timestamps();

            // Tetapkan kunci asing untuk jadual `forms`
            $table->foreign('form_id')->references('id')
                ->on('form_builder_forms')->onDelete('cascade');
        });
    }

    /**
     * Jalankan rollback migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_builder_responses');
    }
};
