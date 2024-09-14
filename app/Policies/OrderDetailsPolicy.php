<?php

namespace App\Policies;

use App\Models\OrderDetails;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrderDetailsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $Ability = ['Admin','markting','sales','owner'];
        $match = array_intersect($Ability, $user->role);
        if (!$match) {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, OrderDetails $orderDetails): bool
    {
        $Ability = ['Admin','markting','sales','owner'];
        $match = array_intersect($Ability, $user->role);
        if (!$match) {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, OrderDetails $orderDetails): bool
    {
        $Ability = ['Admin','markting','sales','owner'];
        $match = array_intersect($Ability, $user->role);
        if (!$match) {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, OrderDetails $orderDetails): bool
    {
        $Ability = ['Admin','markting','sales','owner'];
        $match = array_intersect($Ability, $user->role);
        if (!$match) {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, OrderDetails $orderDetails): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, OrderDetails $orderDetails): bool
    {
        //
    }
}
