<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // 用户表
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('account', 32)->nullable()->unique();
            $table->string('phone', 11)->nullable()->unique();
            $table->string('email', 64)->nullable()->unique();
            $table->string('password');
            $table->string('nickname');
            $table->string('avatar')->nullable()->comment('头像');
            $table->unsignedTinyInteger('gender')->default(0)->comment("性别 0 未知 1 男 2 女");
            $table->string('signature')->nullable()->comment('签名');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
