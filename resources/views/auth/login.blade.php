@extends('layouts.guest')    

@section('title', 'Войти')

@section('styles')
<link href="/assets/css/customer/auth/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/customer/auth/actions.css" rel="stylesheet" type="text/css">
<link href="/assets/css/customer/auth/login.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
<header>
    <ul class="actions">
        <li class="action current">Вход</li>
        <li class="action separator"></li>
        <li class="action another"><a href="{{ route('register') }}">Регистрация</a></li>
    </ul>
</header>

<form action="{{ route('login') }}" method="post">
    @csrf

    {{-- Login --}}
    <x-forms.inputs.text :type=" 'text' "
                         :name=" 'login' " 
                         :placeholder=" 'Логин' " 
                          required="" 
                          autofocus="" 
                          autocomplete="username" 
    />

    {{-- Password --}}
    <x-forms.inputs.text :type=" 'password' "
                         :name=" 'password' " 
                         :placeholder=" 'Пароль' "
                          required=""
                          autocomplete="current-password"
    />

    <div class="input-field options">
        {{-- Remember me --}}
        <x-forms.inputs.checkbox-radio :name=" 'remember_me' " 
                                       :placeholder=" 'Запомнить меня' " 
        />

        {{-- Forgot password --}}
        <div class="forgot-password">
            <a href="{{ route('password.request') }}">Восстановить пароль</a>
        </div>
    </div>

    {{-- Submit --}}
    <x-forms.submit :placeholder=" 'Войти' " />
</form>
@endsection
