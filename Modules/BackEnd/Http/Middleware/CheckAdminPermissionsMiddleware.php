<?php

namespace Modules\BackEnd\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\BackEnd\Entities\AdminUsers;
class CheckAdminPermissionsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$permission = null)
    {
        
        $AdminUsers = AdminUsers::with('get_permissions')->where('id',\Auth::guard(admin_guard)->user()->id)->first();
        
        if($AdminUsers && $AdminUsers->get_permissions->isNotEmpty()):
            $permissions = $AdminUsers->get_permissions;
            $permission = $permissions->where('slug',$permission)->first();
          
            if($permission):
               return $next($request);
            else:
                if(\Request::ajax()): 
                    \Request::session()->flash('flash-error-message','Permission Denied !.');
                    return response()->json(['error','Permission Denied !.'], 200); 
                else:   
                    abort(403,'Permission Denied !.');
                endif; 
            endif;
        else: 
            if(\Request::ajax()): 
                \Request::session()->flash('flash-error-message','Permission Denied !.');
                return response()->json(['error','Permission Denied !.'], 200);
            else:
                abort(403,'Permission Denied !.'); 
            endif;
            
        endif;

    }
}
