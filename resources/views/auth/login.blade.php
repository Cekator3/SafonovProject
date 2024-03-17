<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->

    <!-- Styles -->
    {{-- Common styles --}}
    <link href="/assets/css/common/normalize.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/common/themes.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/common/app.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/common/header.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/common/form.css" rel="stylesheet" type="text/css">
    {{-- Other styles --}}
    <link href="/assets/css/customer/login.css" rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        {{-- logo --}}
        <a class="company-logo" href="{{ route('home') }}"></a>

        <nav>
            <li>lol</li>
            <li>lol</li>
            <li>lol</li>
            <li>lol</li>
            <li>lol</li>
        </nav>
    </header>

    <main>
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
            <x-forms.inputs.text :name=" 'login' " 
                                 :placeholder=" 'Логин' " 
                                 required="" 
                                 autofocus="" 
                                 autocomplete="username" 
            />

            {{-- Password --}}
            <x-forms.inputs.text :name=" 'password' " 
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
    </main>
</body>
