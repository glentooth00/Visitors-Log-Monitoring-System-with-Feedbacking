<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_visitors', function (Blueprint $table) {
            $table->id();
            $table->string('client_type');
            $table->string('visitor_name')->nullable();
            $table->json('offices'); // JSON array of selected offices
            $table->date('visit_date')->nullable();
            $table->time('visit_time')->nullable();
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
        Schema::dropIfExists('office_visitors');
    }
}
