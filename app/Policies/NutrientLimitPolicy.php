<?php

namespace App\Policies;

use App\Models\NutrientLimit;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NutrientLimitPolicy
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
     * @param  \App\Models\NutrientLimit  $nutrientLimit
     * @return mixed
     */
    public function view(User $user, NutrientLimit $nutrientLimit)
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
     * @param  \App\Models\NutrientLimit  $nutrientLimit
     * @return mixed
     */
    public function update(User $user, NutrientLimit $nutrientLimit)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\NutrientLimit  $nutrientLimit
     * @return mixed
     */
    public function delete(User $user, NutrientLimit $nutrientLimit)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\NutrientLimit  $nutrientLimit
     * @return mixed
     */
    public function restore(User $user, NutrientLimit $nutrientLimit)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\NutrientLimit  $nutrientLimit
     * @return mixed
     */
    public function forceDelete(User $user, NutrientLimit $nutrientLimit)
    {
        return true;
    }
}
