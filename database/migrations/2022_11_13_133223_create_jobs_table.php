<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('type')->nullable();
            $table->string('hierarchical')->nullable();
            $table->integer('salary')->nullable();
            $table->string('address')->nullable();
            $table->string('experience')->nullable();
            $table->string('description')->nullable();
            $table->string('requirement');
            $table->enum('status', ['Opened', 'Closed'])->default('Pending')->default('Opened');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('image');
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
        Schema::dropIfExists('jobs');
    }
}
