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
        Schema::create('negotiations', function (Blueprint $table) {
            $table->id();
            $table->string('id_distributor');
            $table->string('id_penawaran');
            $table->string('price_submitted');
            $table->string('price_deal')->nullable();
            $table->string('quantity');
            $table->string('date_approve_petani')->nullable();
            $table->string('status_negotiation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negotiations');
    }
};
