<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // 用户扩展表
    public function up(): void
    {
        Schema::create('user_extends', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->unsignedInteger('view_nums')->default(0)->comment('浏览次数');
            $table->unsignedInteger('fans_nums')->default(0)->comment('粉丝数');
            $table->unsignedInteger('follow_nums')->default(0)->comment('关注人数');
            $table->string('admin_role', 20)->nullable()->comment('后台角色，用户可自由切换');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_extends');
    }
};
