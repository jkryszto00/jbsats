<?php

namespace App\Policies;

use App\Domain\User\Models\User;
use App\Domain\JobOffer\Models\JobOffer;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobOfferPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Domain\User\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->isEmployer();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domain\User\Models\User  $user
     * @param  \App\JobOffer  $jobOffer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, JobOffer $jobOffer)
    {
        return $user->isEmployer() and $user->isCompanyOwner($jobOffer->company);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domain\User\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->isEmployer();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domain\User\Models\User  $user
     * @param  \App\JobOffer  $jobOffer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, JobOffer $jobOffer)
    {
        return $user->isEmployer() and $user->isCompanyOwner($jobOffer->company);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domain\User\Models\User  $user
     * @param  \App\JobOffer  $jobOffer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, JobOffer $jobOffer)
    {
        return $user->isEmployer() and $user->isCompanyOwner($jobOffer->company);
    }
}
