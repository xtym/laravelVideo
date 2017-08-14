<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',80)->comment('文件名');
            $table->string('filename')->comment('文件名');
            $table->string('path')->comment('相对路径');
            $table->integer('createtime')->comment('上传时间');
            $table->string('extension',10)->default('')->comment('文件类型');
            $table->mediumInteger('size')->comment('文件大小');
            $table->tinyInteger('status')->unsigned()->comment('状态');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}
