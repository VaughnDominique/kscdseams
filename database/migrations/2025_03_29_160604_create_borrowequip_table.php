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
        Schema::create('borrowequip', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->unsignedBigInteger('equipid');
            $table->string('equiptype');
            $table->integer('equipqty');
            $table->string('borrowerid');
            $table->string('department');
            $table->string('borrowertype');
            $table->date('dateborrowed');
            $table->date('dateretured')->nullable();
            $table->integer('borrowedspan');
            $table->string('stat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrowequip');
    }
};
