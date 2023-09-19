<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYoutubeChannelVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youtube_channel_videos', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('link');
            $table->string('title');
            $table->text('description');
            $table->string('thumbnail');
            $table->unsignedBigInteger('youtube_channel_id');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('youtube_channel_id')
                ->references('id')
                ->on('youtube_channels')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('youtube_channel_videos');
    }
}
