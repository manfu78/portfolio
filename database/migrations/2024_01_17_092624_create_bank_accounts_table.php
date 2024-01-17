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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('ncc')->nullable()->default(null); //numero cuenta contable
            $table->string('bic')->nullable()->default(null);
            $table->string('iban')->nullable()->default(null);

            $table->string('address')->nullable()->default(null);
            $table->string('postal_code')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('province')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);

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
        Schema::dropIfExists('bank_accounts');
    }
};
