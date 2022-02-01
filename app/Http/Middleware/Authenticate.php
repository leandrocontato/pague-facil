<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {            

            $prefixArray = explode('/', $request->route()->getPrefix());
            $prefix      = (empty($prefixArray[0])) ? ((isset($prefixArray[1])) ? $prefixArray[1] : "" ) : $prefixArray[0];
            
            switch ($prefix) {
                case 'sistema':
                    return route('dashboard-auth');
                break;
                default:
                 return route('customerarea-auth');
                break;
            }
        }
    }
}
