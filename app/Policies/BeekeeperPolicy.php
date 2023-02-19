<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Beekeeper;
use Illuminate\Auth\Access\HandlesAuthorization;

class BeekeeperPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the beekeeper can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the beekeeper can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Beekeeper  $model
     * @return mixed
     */
    public function view(User $user, Beekeeper $model)
    {
        return true;
    }

    /**
     * Determine whether the beekeeper can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the beekeeper can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Beekeeper  $model
     * @return mixed
     */
    public function update(User $user, Beekeeper $model)
    {
        return true;
    }

    /**
     * Determine whether the beekeeper can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Beekeeper  $model
     * @return mixed
     */
    public function delete(User $user, Beekeeper $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Beekeeper  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the beekeeper can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Beekeeper  $model
     * @return mixed
     */
    public function restore(User $user, Beekeeper $model)
    {
        return false;
    }

    /**
     * Determine whether the beekeeper can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Beekeeper  $model
     * @return mixed
     */
    public function forceDelete(User $user, Beekeeper $model)
    {
        return false;
    }
}
