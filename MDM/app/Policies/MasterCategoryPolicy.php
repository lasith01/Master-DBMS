<?php

namespace App\Policies;

use App\Models\MasterCategory;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MasterCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MasterCategory $masterCategory): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MasterCategory $masterCategory)
    {
        return $user->is_admin || $user->id === $masterCategory->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MasterCategory $masterCategory)
    {
        return $user->is_admin || $user->id === $masterCategory->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MasterCategory $masterCategory): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MasterCategory $masterCategory): bool
    {
        return false;
    }
}
