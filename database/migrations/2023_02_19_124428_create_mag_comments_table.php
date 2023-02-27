<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mag_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->references('id')->on('mag_posts')->cascadeOnDelete();
            $table->bigInteger('customer_id')->default(0);
            $table->string('name');
            $table->string('email');
            $table->longText('body');
            $table->integer('like')->default(0);
            $table->integer('dislike')->default(0);
            $table->bigInteger('is_answer')->default(0);
            $table->tinyInteger('status');
            $table->bigInteger('createdBy')->nullable();
            $table->bigInteger('editedBy')->nullable();
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
        Schema::dropIfExists('mag_comments');
    }
}
