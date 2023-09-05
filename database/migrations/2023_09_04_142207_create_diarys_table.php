<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diarys', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('date');
            $table->string('content',4000);
            $table->string('img_id',2000);
            $table->string('delete_flg',1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diarys');
    }
};
