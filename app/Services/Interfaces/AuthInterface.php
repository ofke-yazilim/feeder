<?php
namespace App\Services\Interfaces;

use App\Helpers\Response;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;

interface AuthInterface
{
    /**
     * @param Request $request
     * @param Response $response
     */
    public function login(Request $request,Response $response,UserLoginRequest $login_request);

    public function logout();
}
