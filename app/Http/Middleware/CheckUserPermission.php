<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;

class CheckUserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $role            = Role::find(session()->get('role_id'));
        $permissions     = $role->permissions;
        $userpermission  = [];

        foreach ($permissions as $perm){
            array_push( $userpermission , $perm->key );
        }
       
        if(!in_array($permission, $userpermission)){
            abort('403','You do not have permission to execute !');
        }
        return $next($request);
    }
}
