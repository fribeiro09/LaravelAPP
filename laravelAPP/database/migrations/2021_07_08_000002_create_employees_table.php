<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name', 100);
            $table->string('document_number', 11)->unique();
            $table->string('zipcode', 8);
            $table->string('address', 100);
            $table->string('complement')->nullable();
            $table->string('district', 100);
            $table->string('city', 100);
            $table->string('state', 2);
            $table->string('cellular', 11);
            $table->string('email', 100);
            $table->string('picture')->nullable();
            $table->enum('status', ['A', 'I'])->default('A');
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
        Schema::dropIfExists('employees');
    }
}
