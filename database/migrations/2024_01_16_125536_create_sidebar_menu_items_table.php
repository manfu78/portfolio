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
        Schema::create('sidebar_menu_items', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('route');
            $table->string('permission');
            $table->integer('order')->nullable()->default(null);

            $table->unsignedBigInteger('sidebar_menu_father_id')->nullable()->default(null);
            $table->foreign('sidebar_menu_father_id')
                ->references('id')->on('sidebar_menu_fathers')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('sidebar_menu_sub_father_id')->nullable()->default(null);
            $table->foreign('sidebar_menu_sub_father_id')
                ->references('id')->on('sidebar_menu_sub_fathers')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidebar_menu_items');
    }
};
