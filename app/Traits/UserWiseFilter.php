<?php

namespace App\Traits;

use App\Models\ReferenceInformation;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;


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

                if ($user instanceof User) {
                    $role = auth()->user()->roles->first();
                }else if($user instanceof ReferenceInformation){
                    $role = auth()->user()->role;
                }


                if( $role->key !== 'admin' && $role->key !== 'admins' &&  $role->key !== 'super-admin' && $role->key !== 'super-admins' ){
                    $builder->where('created_by', auth()->id());
                }
                // Apply a where clause to filter data for this user
            }
        });
    }

}
