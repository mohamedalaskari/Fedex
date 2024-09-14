<?php

namespace App\Policies;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Container\Attributes\Auth;

class BranchPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function all(User $user): bool
    {
        $Ability=['Admin','owner'];
        $match=array_intersect($Ability,$user->role);
          if(!$match){
            return false;
          }
          return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(User $user, Branch $branch): bool
    {
        $Ability=['Admin','owner'];
        $match=array_intersect($Ability,$user->role);
          if(!$match){
            return false;
          }
          return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $Ability=['Admin','owner'];
        $match=array_intersect($Ability,$user->role);
          if(!$match){
            return false;
          }
          return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Branch $branch): bool
    {
        $Ability=['Admin','owner'];
        $match=array_intersect($Ability,$user->role);
          if(!$match){
            return false;
          }
          return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Branch $branch): bool
    {
        $Ability=['Admin','owner'];
        $match=array_intersect($Ability,$user->role);
          if(!$match){
            return false;
          }
          return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Branch $branch): bool
    {
//
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Branch $branch): bool
    {
        //
    }
}
