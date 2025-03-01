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
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')
            ->constrained('users')
            ->onDelete('NO ACTION');
            $table->foreignId('livro_id')
            ->constrained('livros')
            ->onDelete('NO ACTION');
            $table->foreignId('situacao_id')
            ->constrained('situacao_emprestimos')
            ->onDelete('NO ACTION');
            $table->timestamp('data_devolucao')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprestimos');
    }
};
