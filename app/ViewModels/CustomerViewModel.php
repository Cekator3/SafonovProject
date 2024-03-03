<?php

namespace App\ViewModels;

/**
 * Class for transferring customer's data 
 * from interfaces (views) 
 * to the application (Services and Repositories).
 */
class CustomerViewModel
{
    public string $login = '';
    public string $email = '';
    public string $phoneNumber = '';
    public string $profilePicture = '';
    public string $name = '';
    public string $surname = '';
    public string $patronymic = '';
    public string $password = '';
    public string $password_confirmation = '';
}
