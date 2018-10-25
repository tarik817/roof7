<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use App\User;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::orderBy('created_at', 'desc')->paginate(10));
    }
}
