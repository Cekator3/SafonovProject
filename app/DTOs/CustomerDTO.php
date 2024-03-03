<?php

namespace App\DTOs;

/**
 * Subsystem for interacting with customer's data 
 * that was retrieved from the 
 * users repository (data storage).
 */
class CustomerDTO 
{
    private int $id;
    private string $login;
    private string $email;
    private string $phoneNumber;
    private string $name;
    private string $surname;
    private string $patronymic;
    private string $passwordHash;

    public function getPasswordHash() : string
    {
        return $this->passwordHash;
    }
}
