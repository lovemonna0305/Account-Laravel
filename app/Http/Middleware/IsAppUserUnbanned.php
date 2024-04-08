<?php

namespace App\Http\Middleware;

use Closure;

class IsAppUserUnbanned
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        if($user->banned == 1){
            $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

            return response()->json([
                'result' => false,
                'result_key' => 'banned',
                'message' => translate('user is banned')
            ]);
        }
        return $next($request);
    }
}
