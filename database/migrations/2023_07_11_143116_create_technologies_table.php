<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('technologies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            // $table->string('slug', 100)->unique();
            $table->text('description', 3000);
        });
    }

    public function down()
    {
        Schema::dropIfExists('technologies');
    }
};
