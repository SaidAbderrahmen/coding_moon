<?php

namespace App\Policies;

use App\Models\User;
use App\Models\History;
use Illuminate\Auth\Access\HandlesAuthorization;

class HistoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the history can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the history can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\History  $model
     * @return mixed
     */
    public function view(User $user, History $model)
    {
        return true;
    }

    /**
     * Determine whether the history can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the history can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\History  $model
     * @return mixed
     */
    public function update(User $user, History $model)
    {
        return true;
    }

    /**
     * Determine whether the history can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\History  $model
     * @return mixed
     */
    public function delete(User $user, History $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\History  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the history can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\History  $model
     * @return mixed
     */
    public function restore(User $user, History $model)
    {
        return false;
    }

    /**
     * Determine whether the history can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\History  $model
     * @return mixed
     */
    public function forceDelete(User $user, History $model)
    {
        return false;
    }
}
