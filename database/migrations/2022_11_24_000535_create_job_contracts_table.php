<?php

use App\Domain\JobOffer\Enums\Contract\ContractCurrency;
use App\Domain\JobOffer\Enums\Contract\ContractTime;
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
        Schema::create('job_contracts', function (Blueprint $table) {
            $table->foreignId('job_offer_id');
            $table->enum('time', array_map(fn (ContractTime $time) => $time->value, ContractTime::cases()));
            $table->enum('currency', array_map(fn (ContractCurrency $currency) => $currency->value, ContractCurrency::cases()));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_contracts');
    }
};
