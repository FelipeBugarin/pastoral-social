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
        Schema::create('alimentos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('paroquia_id')->constrained(); // Vincula à paróquia
            $table->string('nome');
            $table->decimal('quantidade', 10, 2); // Ex: 10.5 kg
            $table->string('unidade'); // kg, unidade, litro
            $table->boolean('excedente')->default(false); // Define se sobra para doação entre paróquias
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alimentos');
    }
};
