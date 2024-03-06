<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasFactory, Notifiable;

    /**
     * Because table don't have a created_at and updated_at columns
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'role' => UserRole::class,
    ];

    /**
     * Get logs that was fired by this user
     */
    public function application_events() : HasMany
    {
        return $this->hasMany(ApplicationEvent::class);
    }

    /**
     * Returns true if the user is a customer.
     */
    public function isCustomer() : bool
    {
        return $this->role === UserRole::Customer;
    }

    /**
     * Returns true if the user is a print master.
     */
    public function isPrintMaster() : bool
    {
        return $this->role === UserRole::PrintMaster;
    }

    /**
     * Returns true if the user is a admin.
     */
    public function isAdmin() : bool
    {
        return $this->role === UserRole::Admin;
    }

    /**
     * Returns true if the user is a superuser.
     */
    public function isSuperuser() : bool
    {
        return $this->role === UserRole::Superuser;
    }
}
