<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 255);
            $table->string('mother_name', 255);
            $table->string('family_name', 255);
            $table->string('national_id', 20)->unique();
            // $table->string('email')->unique();
            $table->string('phone', 20);
            $table->decimal('baccalaureate_score', 5, 2);
            $table->string('certificate_image')->nullable();
            $table->enum('status', ['Pending', 'Accepted', 'Rejected', 'Waiting', 'Final Accepted'])->default('Pending');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
