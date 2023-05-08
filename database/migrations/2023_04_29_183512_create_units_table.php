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
    Schema::create('units', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('unit');
        $table->string('type');
        $table->string('lat', 255);
        $table->string('lng', 255);
        $table->timestamps();
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
        Schema::dropIfExists('units');
    }
};
