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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_role')->default(1);
            $table->tinyInteger('gender')->default(0)->comment('0: Nam; 1: Nữ;');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('avatar')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->date('vip_start_date')->nullable();
            $table->date('vip_end_date')->nullable();
            $table->date('ban_start_date')->nullable();
            $table->date('ban_end_date')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0: Bình Thường; 1: Bị Ban Comment; 2: Bị Khóa Tài Khoản;');
            $table->timestamps();
            $table->tinyInteger('is_vip')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
