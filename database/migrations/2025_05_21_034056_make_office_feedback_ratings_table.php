<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeOfficeFeedbackRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('office_feedback_ratings', function (Blueprint $table) {
    $table->id();
    $table->foreignId('office_visitor_id')->constrained('office_visitors')->onDelete('cascade');
    $table->string('office_name');
    $table->tinyInteger('rating'); // rating from 1 to 5
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
        //
    }
}
