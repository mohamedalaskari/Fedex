<?php

namespace App\Policies;

use App\Models\EmployeeChildren;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EmployeeChildrenPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $Ability = ['Admin','HR','owner'];
        $match = array_intersect($Ability, $user->role);
        if (!$match) {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EmployeeChildren $employeeChildren): bool
    {
        $Ability = ['Admin','HR','owner'];
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
        $Ability = ['Admin','HR','owner',"employee"];
        $match = array_intersect($Ability, $user->role);
        if (!$match) {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EmployeeChildren $employeeChildren): bool
    {
        $Ability = ['Admin','HR','owner','employeeChildren'];
        $match = array_intersect($Ability, $user->role);
        if (!$match) {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EmployeeChildren $employeeChildren): bool
    {
        $Ability = ['Admin','HR','owner','employeeChildren'];
        $match = array_intersect($Ability, $user->role);
        if (!$match) {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, EmployeeChildren $employeeChildren): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, EmployeeChildren $employeeChildren): bool
    {
        //
    }
}
