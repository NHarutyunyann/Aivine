<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();

            $table->string('name', 255)->nullable();
            $table->string('alt', 255)->nullable();
            $table->string('path', 255)->nullable();

            $table->string('size')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();

            $table->string('format', 10);
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
