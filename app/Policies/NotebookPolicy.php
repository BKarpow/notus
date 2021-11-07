<?php

namespace App\Policies;

use App\Models\Notebook;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotebookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->id > 0;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Notebook $notebook)
    {
        return (int)$user->id === (int)$notebook->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->id > 0;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Notebook $notebook)
    {
        logger()->debug('Update notebook, user: '.$user->name);
        return (int)$user->id === (int)$notebook->user_id;

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Notebook $notebook)
    {
        logger()->debug("Delete {$notebook->title}({$notebook->id}), user: {$user->id}");
        return (int)$user->id === (int)$notebook->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Notebook $notebook)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Notebook $notebook)
    {
        return $this->create();
    }
}
