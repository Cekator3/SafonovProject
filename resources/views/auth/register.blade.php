@extends('layouts.guest')    

@section('title', 'Зарегистрироваться')

@section('styles')
<link href="/assets/css/customer/auth/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/customer/auth/actions.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
<header>
    <ul class="actions">
        <li class="action another"><a href="{{ route('login') }}">Вход</a></li>
        <li class="action separator"></li>
        <li class="action current">Регистрация</li>
    </ul>
</header>

<form action="{{ route('register') }}" method="post">
    @csrf

    <x-forms.inputs.text :type=" 'text' "
                         :name=" 'login' " 
                         :placeholder=" 'Логин' " 
                         required="" 
                         autofocus="" 
                         autocomplete="username" 
    />

    <x-forms.inputs.text :type=" 'email' "
                         :name=" 'email' " 
                         :placeholder=" 'Почта' " 
                         required="" 
                         autocomplete="email" 
    />

    <x-forms.inputs.text :type=" 'tel' "
                         :name=" 'phone_number' " 
                         :placeholder=" 'Телефон' " 
                         required="" 
                         autocomplete="tel" 
    />

    <x-forms.inputs.text :type=" 'text' "
                         :name=" 'name' " 
                         :placeholder=" 'Имя' " 
                         autocomplete="given-name" 
    />

    <x-forms.inputs.text :type=" 'text' "
                         :name=" 'surname' " 
                         :placeholder=" 'Фамилия' " 
                         required=""
                         autocomplete="family-name" 
    />

    <x-forms.inputs.text :type=" 'text' "
                         :name=" 'patronymic' " 
                         :placeholder=" 'Отчество' " 
                         autocomplete="additional-name" 
    />

    <x-forms.inputs.text :type=" 'password' "
                         :name=" 'password' " 
                         :placeholder=" 'Пароль' "
                          required=""
                          autocomplete="current-password"
    />

    <x-forms.inputs.text :type=" 'password' "
                         :name=" 'password_confirmation' " 
                         :placeholder=" 'Подтверждение пароля' "
                          required=""
                          autocomplete="current-password"
    />

    {{-- Remember me --}}
    <x-forms.inputs.checkbox-radio :name=" 'remember_me' " 
                                    :placeholder=" 'Запомнить меня' " 
    />

    <x-forms.submit :placeholder=" 'Войти' " />
</form>
@endsection
