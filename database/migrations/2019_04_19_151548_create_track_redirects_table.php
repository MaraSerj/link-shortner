<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackRedirectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_redirects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('short_url_id')->nullable();
            $table->foreign('short_url_id')
                ->references('id')
                ->on('short_urls')
                ->onUpdate('NO ACTION')
                ->onDelete('SET NULL');
            $table->string('user_agent')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->string('referer')->nullable();
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
        Schema::dropIfExists('track_redirects');
    }
}
