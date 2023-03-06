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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('名前');
            $table->string('email')->nullable()->comment('メールアドレス');
            $table->string('password')->nullable()->comment('パスワード');
            $table->rememberToken()->nullable()->comment('ログイン省略トークン');
            $table->timestamp('email_verified_at')->nullable()->comment('メール認証日時');
            $table->integer('status')->default(0)->comment('状態');
            $table->integer('delete_flg')->default(0)->comment('削除フラグ');
            $table->dateTime('post_at')->nullable()->comment('最終投稿時間');
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
        Schema::dropIfExists('members');
    }
};
