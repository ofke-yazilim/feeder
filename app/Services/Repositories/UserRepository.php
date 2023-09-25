<?php
namespace App\Services\Repositories;

use App\Models\User;
use App\Services\Interfaces\UserInterface;

class UserRepository implements UserInterface {

    public function store(User $user){
        return $user->save();
    }

    public function show(){
        return array_diff_key(\Auth::user()->toArray(), array_flip(["password", "access_token", "validate_token","session_id","remember_token","updated_at"]));
    }
}
