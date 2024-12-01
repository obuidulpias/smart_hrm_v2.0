<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('card_number')->unique();
            $table->string('punch_number')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('father_name');
            $table->string('mother_name');
            $table->integer('gender');
            $table->date('birth_date');
            $table->string('nid')->unique();
            $table->integer('company_id');
            $table->integer('location_id');
            $table->integer('department_id');
            $table->integer('designation_id');
            $table->date('joining_date');
            $table->decimal('gross_salary', total: 8, places: 2);
            $table->integer('status')->default(1);
            $table->integer('is_deleted')->default(0);
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
