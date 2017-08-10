<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVediosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vedios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('视频名称');
            $table->string('introduce')->comment('视频介绍');
            $table->string('preview')->comment('视频预览图');
            $table->tinyInteger('iscommend')->comment('是否推荐');
            $table->tinyInteger('ishot')->comment('是否是热门');
            $table->smallInteger('click')->comment('点击次数');
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
        Schema::dropIfExists('vedios');
    }
}
