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
        Schema::table('workers', function (Blueprint $table) {

            $table->unsignedBigInteger('department_id')->nullable()->default(null)->after('category_id');
            $table->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('area_id')->nullable()->default(null)->after('category_id');
            $table->foreign('area_id')
                ->references('id')
                ->on('areas')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workers', function (Blueprint $table) {
            $table->dropColumn('area_id');
            $table->dropColumn('department_id');
        });
    }
};
