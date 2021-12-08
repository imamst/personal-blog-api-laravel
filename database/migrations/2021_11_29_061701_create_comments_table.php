<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('author_name');
            $table->string('author_email');
            $table->text('content');
            $table->foreignId('post_id');
            $table->datetime('time');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->tinyInteger('is_approved')->default(1);
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('comments');

            $table->index(['post_id', 'is_approved']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
