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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('staff_roles')->nullable();
            $table->foreign('staff_roles')->references('id')->on('staff_roles')->onDelete('cascade');
            $table->string('email');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->tinyInteger('gender');
            $table->tinyInteger('status')->default(0);
            $table->string('password');
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
        Schema::dropIfExists('staff');
    }
};
