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
        Schema::create('cesta_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paroquia_id')->constrained()->onDelete('cascade');
            $table->string('alimento_nome'); // Nome do alimento exigido (Ex: Arroz)
            $table->decimal('quantidade_necessaria', 10, 2); // Quanto vai na cesta (Ex: 5.0)
            $table->string('unidade'); // kg, un, pacote
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cesta_items');
    }
};
