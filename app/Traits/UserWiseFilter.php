<?php

namespace App\Traits;

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
                $role = auth()->user()->roles->first();

                if( $role->key !== 'admin' && $role->key !== 'admins' &&  $role->key !== 'super-admin' && $role->key !== 'super-admins' ){
                    $builder->where('created_by', auth()->id());
                }
                // Apply a where clause to filter data for this user
            }
        });
    }

}
