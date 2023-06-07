<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('project_title');
            $table->enum('task_type', ['web', 'mobile', 'ui/ux', 'desktop']);
            $table->string('stack');
            $table->text('project_description');
            $table->string('assigned_to');
            $table->date('deadline');
            $table->string('price');
            $table->enum('progress', ['to_do', 'on_progress', 'complete', 'reject']);
            $table->enum('admin',[1,2]);
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
        Schema::dropIfExists('projects');
    }
}
