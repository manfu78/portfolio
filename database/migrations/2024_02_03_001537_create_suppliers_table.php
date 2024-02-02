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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('tradename')->nullable();//nombre comercial
            $table->string('cif');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();

            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->boolean('status')->default(true);

            $table->string('ncc')->nullable(); //numero cuenta contable
            $table->float('comercial_discount')->default(0.00)->nullable();
            $table->float('pront_payment_discount')->default(0.00)->nullable();

            $table->string('bic')->nullable();
            $table->string('iban')->nullable();

            $table->text('observations')->nullable();

            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')
                ->references('id')->on('countries')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('vat_id')->nullable();
            $table->foreign('vat_id')
                ->references('id')->on('vats')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->foreign('payment_method_id')
                ->references('id')->on('payment_methods')
                ->onDelete('set null')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('suppliers');
    }
};
