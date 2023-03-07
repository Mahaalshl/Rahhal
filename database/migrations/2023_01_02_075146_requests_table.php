<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('picture');
            $table->foreignId('created_by')->constrained('users');
            $table->dateTime('event_date')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->enum('request_type',['place','event']);
            $table->enum('state',['pending','accepted','rejected']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
};
