<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenreIdToSongsTable extends Migration
{
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->unsignedBigInteger('genre_id')->nullable()->after('description'); // Adjust the position as needed

            // If you want to create a foreign key constraint
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->dropForeign(['genre_id']); // Drop foreign key constraint if exists
            $table->dropColumn('genre_id'); // Remove the column
        });
    }
}

