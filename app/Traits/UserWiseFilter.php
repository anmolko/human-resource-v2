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
                $role = get_user_role();
                $type = '';

                if (auth()->user() instanceof User) {
                    $type = 'users';
                }else if(auth()->user() instanceof ReferenceInformation){
                    $type = 'reference_agents';
                }

                if( $role !== 'admin' && $role !== 'admins' &&  $role !== 'super-admin' && $role !== 'super-admins' ){
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
