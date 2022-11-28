<?php

namespace App\Providers;

use App\Domain\Apply\Models\Apply;
use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\Shared\Models\Media;
use App\Domain\User\Models\User;
use App\Policies\ApplyPolicy;
use App\Policies\JobOfferPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        JobOffer::class => JobOfferPolicy::class,
        Apply::class => ApplyPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('show-cv', function (User $user, Media $media) {
            return $user->isCompanyOwner($media->imageable->apply->jobOffer->company);
        });
    }
}
