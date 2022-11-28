<?php

namespace App\Policies;

use App\Domain\Apply\Models\Apply;
use App\Domain\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplyPolicy
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
     * @param  \App\Apply  $apply
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Apply $apply)
    {
        return $user->isEmployer() and $user->isCompanyOwner($apply->jobOffer->company);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domain\User\Models\User  $user
     * @param  \App\Apply  $apply
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Apply $apply)
    {
        return $user->isEmployer() and $user->isCompanyOwner($apply->jobOffer->company);
    }
}
