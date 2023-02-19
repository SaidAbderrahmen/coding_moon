<?php

namespace App\Policies;

use App\Models\Tip;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TipPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the tip can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the tip can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Tip  $model
     * @return mixed
     */
    public function view(User $user, Tip $model)
    {
        return true;
    }

    /**
     * Determine whether the tip can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the tip can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Tip  $model
     * @return mixed
     */
    public function update(User $user, Tip $model)
    {
        return true;
    }

    /**
     * Determine whether the tip can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Tip  $model
     * @return mixed
     */
    public function delete(User $user, Tip $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Tip  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the tip can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Tip  $model
     * @return mixed
     */
    public function restore(User $user, Tip $model)
    {
        return false;
    }

    /**
     * Determine whether the tip can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Tip  $model
     * @return mixed
     */
    public function forceDelete(User $user, Tip $model)
    {
        return false;
    }
}
