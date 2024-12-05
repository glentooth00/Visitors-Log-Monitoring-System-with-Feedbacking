<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visitor_id'); // Visitor reference
            $table->unsignedInteger('attentiveness')->nullable();
            $table->unsignedInteger('courtesy')->nullable();
            $table->unsignedInteger('friendliness')->nullable();
            $table->unsignedInteger('helpfulness')->nullable();
            $table->unsignedInteger('knowledge')->nullable();
            $table->unsignedInteger('promptness')->nullable();
            $table->unsignedInteger('quality_of_service')->nullable();
            $table->unsignedInteger('speed_of_service')->nullable();
            $table->unsignedInteger('quality_of_facilities')->nullable();
            $table->unsignedInteger('availability_of_facilities')->nullable();
            $table->unsignedInteger('cleanliness')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
