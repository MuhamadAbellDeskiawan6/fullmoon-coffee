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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained('menus')->cascadeOnDelete();
            $table->integer('jumlah')->default(1);
            $table->enum('payment', ['qris', 'cash']);
            $table->enum('status', ['menunggu', 'diproses', 'selesai'])->default('menunggu');
            $table->string('preferensi_rasa')->nullable();
            $table->boolean('feedback_consent')->default(false);
            $table->boolean('feedback_agreement')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
