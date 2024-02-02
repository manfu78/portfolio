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
        Schema::create('coin_types', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('code',10);
            $table->string('sign',10)->nullable();
            $table->string('sign_html',10)->nullable();
            $table->float('equivalence')->default(1.00);
            $table->boolean('default')->default(0);

            $table->unsignedBigInteger('user_id_mod')->nullable();
            $table->foreign('user_id_mod')
                ->references('id')
                ->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coin_types');
    }
};
