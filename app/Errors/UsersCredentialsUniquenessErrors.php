<?php

namespace App\Errors;

/**
 * A subsystem that stores errors
 * that occur when attempting to store 
 * non-unique user's credentials 
 * that should have been unique.
 */
class UsersCredentialsUniquenessErrors
{
    private bool $isLoginInUse;
    private bool $isEmailInUse;
    private bool $isPhoneNumberInUse;

    public function __construct($isLoginInUse = false, 
                                $isEmailInUse = false, 
                                $isPhoneNumberInUse = false)
    {
        $this->isLoginInUse = $isLoginInUse;
        $this->isEmailInUse = $isEmailInUse;
        $this->isPhoneNumberInUse = $isPhoneNumberInUse;
    }

    /**
     * Sets whether the login is already in use.
     */
    public function setLoginUniqueness(bool $isLoginInUse) : void
    {
        $this->isLoginInUse = $isLoginInUse;
    }

    /**
     * Sets whether the email is already in use.
     */
    public function setEmailUniqueness(bool $isEmailInUse) : void
    {
        $this->isEmailInUse = $isEmailInUse;
    }

    /**
     * Sets whether the phone number is already in use.
     */
    public function setPhoneNumberUniqueness(bool $isPhoneNumberInUse) : void
    {
        $this->isPhoneNumberInUse = $isPhoneNumberInUse;
    }

    /**
     * Returns true if login is already in use.
     */
    public function isLoginInUse() : bool
    {
        return $this->isLoginInUse;
    }

    /**
     * Returns true if email is already in use.
     */
    public function isEmailInUse() : bool
    {
        return $this->isEmailInUse;
    }

    /**
     * Returns true if phone number is already in use.
     */
    public function isPhoneNumberInUse() : bool
    {
        return $this->isPhoneNumberInUse;
    }

    /**
     * Returns true if any of the credentials are already in use.
     */
    public function hasAny() : bool
    {
        return $this->isLoginInUse || $this->isEmailInUse || $this->isPhoneNumberInUse;
    }
}
