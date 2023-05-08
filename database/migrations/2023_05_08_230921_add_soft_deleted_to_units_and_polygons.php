<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //add deleted_at column to polygons table and units table
        Schema::table('polygons', function (Blueprint $table) {
            $table->softDeletes();
            
        });
        Schema::table('units', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('units_and_polygons', function (Blueprint $table) {
            //
        });
    }
};
