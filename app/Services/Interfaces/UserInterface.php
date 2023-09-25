<?php
namespace App\Services\Interfaces;

use App\Models\User;

interface UserInterface
{
    public function store(User $user);

    public function show();
}
