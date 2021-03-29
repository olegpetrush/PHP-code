<?php

namespace App\Policies;

use App\Models\Nutrient;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NutrientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Nutrient  $nutrient
     * @return mixed
     */
    public function view(User $user, Nutrient $nutrient)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Nutrient  $nutrient
     * @return mixed
     */
    public function update(User $user, Nutrient $nutrient)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Nutrient  $nutrient
     * @return mixed
     */
    public function delete(User $user, Nutrient $nutrient)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Nutrient  $nutrient
     * @return mixed
     */
    public function restore(User $user, Nutrient $nutrient)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Nutrient  $nutrient
     * @return mixed
     */
    public function forceDelete(User $user, Nutrient $nutrient)
    {
        return true;
    }
}
