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
        Schema::create('workers', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('lastname')->nullable()->default(null);
            $table->string('nif')->unique();
            $table->string('phone')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);

            $table->string('address')->nullable()->default(null);
            $table->string('postal_code')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('province')->nullable()->default(null);

            $table->string('latitude')->nullable()->default(null);
            $table->string('longitude')->nullable()->default(null);

            $table->string('photo')->nullable()->default(null);
            $table->boolean('status')->default(true);
            $table->boolean('is_commercial')->default(0);

            $table->text('observations')->nullable()->default(null);

            $table->unsignedBigInteger('business_id')->nullable();
            $table->foreign('business_id')
                ->references('id')->on('businesses')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('country_id')->nullable()->default(null);
            $table->foreign('country_id')
                ->references('id')->on('countries')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('category_id')->nullable()->default(null);
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('user_id')->nullable()->default(null)->unique();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('workers');
    }
};
