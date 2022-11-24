<?php

use App\Domain\JobOffer\Enums\Contract\ContractPer;
use App\Domain\JobOffer\Enums\Contract\ContractType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_salaries', function (Blueprint $table) {
            $table->foreignId('job_offer_id');
            $table->enum('type', array_map(fn (ContractType $type) => $type->value, ContractType::cases()));
            $table->integer('from');
            $table->integer('to');
            $table->enum('per', array_map(fn (ContractPer $per) => $per->value, ContractPer::cases()));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_salaries');
    }
};
