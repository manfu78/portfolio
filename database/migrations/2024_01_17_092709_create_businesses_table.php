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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('tradename')->nullable()->default(null);//nombre comercial
            $table->string('cif')->unique();
            $table->string('phone')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);

            $table->string('address')->nullable()->default(null);
            $table->string('postal_code')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('province')->nullable()->default(null);

            $table->string('logo')->nullable()->default(null);
            $table->boolean('default')->default(false);

            $table->unsignedBigInteger('country_id')->nullable()->default(null);
            $table->foreign('country_id')
                ->references('id')->on('countries')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('vat_id')->nullable()->default(null);
            $table->foreign('vat_id')
                ->references('id')->on('vats')
                ->onDelete('set null')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('businesses');
    }
};
