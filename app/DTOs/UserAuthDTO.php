<?php

namespace App\DTOs;

use App\Models\User;
use \Illuminate\Contracts\Auth\Authenticatable;

/**
 * A subsystem containing the data required to authenticate users 
 * on various interfaces (Web, API, etc.).
 * 
 * I am using it because the ORM model is required for cookie-based 
 * login functionality in laravel.
 */
class UserAuthDTO 
{
    private Authenticatable $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Returns the object that can be used for cookie authentication
     */
    public function getObjectForCookieAuthentication() : Authenticatable
    {
        return $this->user;
    }
}
