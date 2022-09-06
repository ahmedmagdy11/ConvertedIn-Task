<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("description");
            $table->unsignedBigInteger("assigned_to_id")->nullable();
            $table->unsignedBigInteger("assigned_by_id")->nullable();
            $table->timestamps();
            $table->foreign("assigned_to_id")->references("id")->on("users")->nullOnDelete();
            $table->foreign("assigned_by_id")->references("id")->on("users")->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
