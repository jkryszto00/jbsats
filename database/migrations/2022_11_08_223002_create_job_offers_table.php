<?php

use App\Domain\JobOffer\Enums\JobOfferLevel;
use App\Domain\JobOffer\Enums\JobOfferStatus;
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
        Schema::create('job_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->string('title');
            $table->text('description');
            $table->enum('level', array_map(fn (JobOfferLevel $level) => $level->value, JobOfferLevel::cases()));
            $table->json('contract');
            $table->json('salary');
            $table->enum('status', array_map(fn (JobOfferStatus $status) => $status->value, JobOfferStatus::cases()));
            $table->timestamp('expired_at')->nullable();
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
        Schema::dropIfExists('job_offers');
    }
};
