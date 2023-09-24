<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class BackendBaseModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function createdBy(){

        if (auth()->check()) {
            $user = auth()->user();
            $role = auth()->user()->roles ? auth()->user()->roles->first():auth()->user()->role;

            if( $role->key !== 'admin' && $role->key !== 'admins' &&  $role->key !== 'super-admin' && $role->key !== 'super-admins' ){
                if ($user instanceof ReferenceInformation) {
                    return ReferenceInformation::find($this->created_by);
                } elseif ($user instanceof User) {
                    // If the logged-in user is a regular user, return the relationship
                    return User::find($this->created_by);
                }
            }else{
                if ($this->created_type == 'reference_agents'){
                    $created_by = ReferenceInformation::find($this->created_by);
                }else{
                    $created_by =  User::find($this->created_by);
                }
                return $created_by;
            }

        }

        // Default fallback value if no user is authenticated
        return null;
    }

    public function updatedBy(){

        if (auth()->check()) {
            $user = auth()->user();
            $role = auth()->user()->roles ? auth()->user()->roles->first():auth()->user()->role;

            if( $role->key !== 'admin' && $role->key !== 'admins' &&  $role->key !== 'super-admin' && $role->key !== 'super-admins' ){
                if ($user instanceof ReferenceInformation) {
                    return ReferenceInformation::find($this->updated_by);
                } elseif ($user instanceof User) {
                    // If the logged-in user is a regular user, return the relationship
                    return User::find($this->updated_by);
                }
            }else{
                if ($this->created_type == 'reference_agents'){
                    $created_by = ReferenceInformation::find($this->updated_by);
                }else{
                    $created_by =  User::find($this->updated_by);
                }
                return $created_by;
            }
        }

        return null;
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('status', 1);
    }

    public function scopeDescending(Builder $query): void
    {
        $query->orderBy('created_at', 'DESC');
    }

}
