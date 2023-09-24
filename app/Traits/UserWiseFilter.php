<?php

namespace App\Traits;

use App\Models\ReferenceInformation;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;


trait UserWiseFilter {

    protected static function boot()
    {
        parent::boot();

        $table = (new static)->getTable();

        // Apply a global scope to filter data for the currently logged-in user
        static::addGlobalScope($table, function (Builder $builder) {

            // Check if a user is logged in
            if (auth()->check()) {
                $user = auth()->user();
                $type = '';

                if ($user instanceof User) {
                    $role = auth()->user()->roles->first();
                    $type = 'users';
                }else if($user instanceof ReferenceInformation){
                    $role = auth()->user()->role;
                    $type = 'reference_agents';
                }

                if( $role->key !== 'admin' && $role->key !== 'admins' &&  $role->key !== 'super-admin' && $role->key !== 'super-admins' ){
                    $builder->where('created_by', auth()->id())->where('created_type', $type);
                }
                // Apply a where clause to filter data for this user
            }
        });

        static::creating(function ($model) {
            $user = Auth::user(); // Get the currently authenticated user or agent
            $model->created_by = $user->id;

            if ($user instanceof User) {
                $model->created_type = 'users';
            }else if($user instanceof ReferenceInformation){
                $model->created_type = 'reference_agents';
            }
        });

        static::updating(function ($model) {
            $user = Auth::user(); // Get the currently authenticated user or agent
            $model->updated_by = $user->id;

            if ($user instanceof User) {
                $model->created_type = 'users';
            }else if($user instanceof ReferenceInformation){
                $model->created_type = 'reference_agents';
            }
        });
    }

}
