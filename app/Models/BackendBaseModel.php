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
        if (Auth::user() instanceof User) {
            return $this->hasOne(User::class,'created_by','id')->where('created_type', '=', 'users');
        }else if(Auth::user() instanceof ReferenceInformation){
            return $this->hasOne(ReferenceInformation::class,'created_by','id')->where('created_type', '=', 'reference_agents');
        }
    }

    public function updatedBy(){
        if (Auth::user() instanceof User) {
            return $this->hasOne(User::class,'updated_by','id')->where('created_type', '=', 'users');
        }else if(Auth::user() instanceof ReferenceInformation){
            return $this->hasOne(ReferenceInformation::class,'updated_by','id')->where('created_type', '=', 'reference_agents');
        }
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
