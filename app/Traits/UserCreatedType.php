<?php

namespace App\Traits;


use App\Models\ReferenceInformation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


trait UserCreatedType {

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user(); // Get the currently authenticated user or agent
            $model->created_by = $user->id;

            if ($user instanceof User) {
                $model->type = 'users';
            }else if($user instanceof ReferenceInformation){
                $model->type = 'reference_agents';
            }
        });

        static::updating(function ($model) {
            $user = Auth::user(); // Get the currently authenticated user or agent
            $model->updated_by = $user->id;

            if ($user instanceof User) {
                $model->type = 'users';
            }else if($user instanceof ReferenceInformation){
                $model->type = 'reference_agents';
            }
        });
    }
}
