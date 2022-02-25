<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('class_id')->constrained();
            $table->string('first_name',60);
            $table->string('surname',60);
            $table->string('last_name',60);
            $table->string('email',60)->unique();
            $table->string('phone',16)->unique();
            $table->string('alt_phone',16);
            $table->string('next_of_kin_name',60);
            $table->string('next_of_kin_email',60);
            $table->string('next_of_kin_phone',16);
            $table->string('address',60);
            $table->string('county',60);
            $table->string('constituency',60);
            $table->string('location',60);
            $table->string('sublocation',60);
            $table->string('village',60);
            $table->string('kcse_year',60);
            $table->string('kcse_index_no',60);
            $table->string('kcse_mean_grade');
            $table->string('kcse_certificate');
            $table->string('kcpe_year',60);
            $table->string('kcpe_index_no',60);
            $table->string('kcpe_mean_grade',60);
            $table->string('kcpe_certificate');
            $table->string('status',60)->nullable();
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
        Schema::dropIfExists('students');
    }
}
