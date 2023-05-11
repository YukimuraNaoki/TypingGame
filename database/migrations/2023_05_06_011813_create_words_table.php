<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->integer('score');
            $table->string('word',50);
            $table->foreignId('stage_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('words');
    }
    
    public function type()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
};
