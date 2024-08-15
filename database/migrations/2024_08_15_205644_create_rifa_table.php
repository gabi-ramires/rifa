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
        Schema::create('rifas', function (Blueprint $table) {
            $table->id(); // Adiciona uma coluna auto-incrementável `id`
            $table->string('nome'); // Nome da rifa
            $table->text('descricao'); // Descrição da rifa
            $table->decimal('preco', 8, 2); // Preço da rifa
            $table->timestamps(); // Adiciona as colunas `created_at` e `updated_at`
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rifas');
    }
};
