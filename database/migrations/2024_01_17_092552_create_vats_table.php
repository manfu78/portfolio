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
        Schema::create('vats', function (Blueprint $table) {
            $table->id();

            $table->float('vat')->default(21.00);
            $table->float('surcharge')->default(0.00);
            $table->string('description')->nullable();

            $table->unsignedBigInteger('user_id_mod')->nullable()->default(null);
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
        Schema::dropIfExists('vats');
    }
};
