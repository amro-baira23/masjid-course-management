<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateUserRequest;
use App\Http\Services\AuthService;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AuthController implements HasMiddleware
{
    public function __construct(private AuthService $authService)
    {
    }

    public static function middleware(): array
    {
        return [
            new Middleware('auth:api', except: ['login']),
            new Middleware("is_active_user", except: ['login'])
        ];
    }
    
    public function login(AuthenticateUserRequest $request){
        $data = $this->authService->login($request);
        return $data;
    }

        
    public function refresh(){
        $data = $this->authService->refresh();
        return $data;
    }

    public function logout(){
        $data = $this->authService->logout();
        return $data;
    }

}
