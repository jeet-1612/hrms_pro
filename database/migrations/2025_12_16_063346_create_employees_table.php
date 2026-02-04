<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('employee_code')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            
            // Personal Details
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->default('single');
            $table->string('nationality')->default('Indian');
            $table->string('religion')->nullable();
            
            // Contact Details
            $table->string('personal_email')->nullable();
            $table->string('personal_phone')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->text('current_address');
            $table->text('permanent_address')->nullable();
            
            // Job Details
            $table->foreignId('department_id')->constrained();
            $table->foreignId('designation_id')->constrained();
            $table->date('joining_date');
            $table->date('confirmation_date')->nullable();
            $table->enum('employment_type', ['permanent', 'contract', 'probation', 'trainee', 'intern'])->default('probation');
            $table->enum('employment_status', ['active', 'inactive', 'suspended', 'terminated', 'resigned'])->default('active');
            
            // Bank Details
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('aadhar_number')->nullable();
            $table->string('uan_number')->nullable();
            
            // Educational Details
            $table->string('highest_qualification')->nullable();
            $table->string('institute')->nullable();
            $table->year('passing_year')->nullable();
            
            // Documents
            $table->string('profile_photo')->nullable();
            $table->string('resume')->nullable();
            $table->string('offer_letter')->nullable();
            $table->string('joining_letter')->nullable();
            $table->string('contract_agreement')->nullable();
            
            // Work Details
            $table->foreignId('reporting_to')->nullable()->constrained('employees');
            $table->integer('leave_balance')->default(0);
            $table->decimal('basic_salary', 10, 2)->default(0);
            $table->decimal('gross_salary', 10, 2)->default(0);
            
            $table->timestamps();
            $table->softDeletes();
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
