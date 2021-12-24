<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_applies', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('field');
            $table->string('position')->nullable();
            $table->string('experience');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('dob');
            $table->string('gender');
            $table->string('marital_status');
            $table->string('education');
            $table->string('nationality');
            $table->string('other_nationality')->nullable();
            $table->string('current_country');
            $table->string('address');
            $table->string('primary_email');
            $table->string('secondary_email')->nullable();
            $table->string('mobile');
            $table->string('land_line')->nullable();
            $table->string('time_to_receive_calls');
            $table->string('why_current_job');
            $table->string('termination');
            $table->string('governmental_permits');
            $table->string('nongovernmental_permits');
            $table->string('license');
            $table->string('certificate');
            $table->string('joining_date');
            $table->string('noc');
            $table->string('objections');
            $table->string('expected_salary');

            $table->string('employer_1')->nullable();
            $table->string('employer_2')->nullable();
            $table->string('employer_3')->nullable();
            
            $table->string('department_1')->nullable();
            $table->string('department_2')->nullable();
            $table->string('department_3')->nullable();
            
            
            $table->string('designation_1')->nullable();
            $table->string('designation_2')->nullable();
            $table->string('designation_3')->nullable();
            
            $table->string('in_line_manager_1')->nullable();
            $table->string('in_line_manager_2')->nullable();
            $table->string('in_line_manager_3')->nullable();
            
            $table->string('service_duration_1')->nullable();
            $table->string('service_duration_2')->nullable();
            $table->string('service_duration_3')->nullable();
            
            $table->string('salary_1')->nullable();
            $table->string('salary_2')->nullable();
            $table->string('salary_3')->nullable();
            
            $table->string('references_name_1')->nullable();
            $table->string('references_name_2')->nullable();
            $table->string('references_name_3')->nullable();
            
            $table->string('references_contact_1')->nullable();
            $table->string('references_contact_2')->nullable();
            $table->string('references_contact_3')->nullable();
            
            $table->string('references_email_1')->nullable();
            $table->string('references_email_2')->nullable();
            $table->string('references_email_3')->nullable();
            
            $table->string('references_relationship_1')->nullable();
            $table->string('references_relationship_2')->nullable();
            $table->string('references_relationship_3')->nullable();
            
            $table->string('updated_resume');
            $table->string('certficates');
            $table->string('other_doc')->nullable();
            
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
        Schema::dropIfExists('career_applies');
    }
}
