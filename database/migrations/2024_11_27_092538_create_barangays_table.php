<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangays', function (Blueprint $table) {
            $table->id();
            $table->string('barangay_name', 255);
            $table->unsignedBigInteger('municipality_id');
            $table->unsignedBigInteger('province_id'); // Add province_id column
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('municipality_id')
                ->references('id')
                ->on('municipalities')
                ->onDelete('cascade'); // Cascade deletes if municipality is deleted

            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
                ->onDelete('cascade'); // Cascade deletes if province is deleted
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangays');
    }
}
