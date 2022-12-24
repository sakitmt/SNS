<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 以下追加2022/12/18
        Schema::create('follows', function (Blueprint $table) {
            $table->integer('id')->autoIncrement(); // integer = 入力値が整数で構成された文字列か数値であることをバリデートする
            $table->integer('following_id'); //フォローした人
            $table->integer('followed_id'); //フォローされた人
            $table->timestamp('created_at')->useCurrent(); //登録日
            $table->timestamp('updated_at')->default(DB::raw('current_timestamp on update current_timestamp')); //更新日
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
