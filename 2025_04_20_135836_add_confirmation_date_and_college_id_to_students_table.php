<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->date('confirmation_date')->nullable()->after('status');
            $table->foreignId('college_id')->nullable()->constrained()->after('confirmation_date');
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('confirmation_date');
            $table->dropForeign(['college_id']);
            $table->dropColumn('college_id');
        });
    }
};
