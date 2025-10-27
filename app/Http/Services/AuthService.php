<?php
namespace App\Http\Services;

use App\Http\Requests\AuthenticateUserRequest;
use App\Http\Resources\SessionResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService{

	public function authinticateUser(User $user){
		$token = Auth::tokenById($user->id);
		return $token;
	}

	public function login(AuthenticateUserRequest $request){
		if (!Auth::attempt($request->all())){
			return response(
				["message" => "incorrect password or username"],
				401
			);
		}
		$user = request()->user();
		$user->access_token = $this->authinticateUser($user);
		return SessionResource::make($user);
	}

	public function refresh(){
		$user = Auth::user();
		$user->access_token = Auth::refresh();
		return SessionResource::make($user);
	}

	public function logout(){
		Auth::invalidate();
				
		return response(["message" => "User Tokens been invalidated successfully"]);
	}
}