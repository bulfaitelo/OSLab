<?php

namespace App\Policies;

use App\Models\OsLab\PaginaFavorita;
use App\Models\User;

class PaginaFavoritaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PaginaFavorita $paginaFavorita): bool
    {
        return $user->id === $paginaFavorita->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PaginaFavorita $paginaFavorita): bool
    {
        return $user->id === $paginaFavorita->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PaginaFavorita $paginaFavorita): bool
    {
        return $user->id === $paginaFavorita->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PaginaFavorita $paginaFavorita): bool
    {
        return $user->id === $paginaFavorita->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PaginaFavorita $paginaFavorita): bool
    {
        return $user->id === $paginaFavorita->user_id;
    }
}
