<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->unique();
            $table->string('status', 100)->default('draft');
            $table->string('image', 200)->nullable();
            $table->string('content', 5000)->nullable();
            $table->text('categories', 200)->nullable();
            $table->string('github_link', 100)->nullable();
            $table->integer('read_time')->nullable();
            $table->string('slug', 200)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
