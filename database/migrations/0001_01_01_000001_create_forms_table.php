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
        Schema::create('form_builder_forms', function (Blueprint $table) {

            $table->uuid('id')->primary(); // UUID untuk kunci utama
            $table->string('title');
            $table->text('descriptions')->nullable();
            $table->json('config')->nullable();
            $table->json('elements'); // Lajur JSON untuk struktur borang
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Jalankan rollback migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_builder_forms');
    }
};
