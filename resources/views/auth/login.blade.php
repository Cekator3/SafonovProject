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

            <div class="input-field text @error('login') has-errors @enderror">
                <input type="text" 
                       id="login" 
                       name="login" 
                       value='{{ old('login') }}' 
                       required 
                       autofocus 
                       autocomplete="username"
                >
                <label for="login">Логин</label>
                <ul class="errors">
                    @error('login')
                        <li>{{ $message }}</li>
                    @enderror
                </ul>
            </div>

            <div class="input-field text @error('password') has-errors @enderror">
                <input type="password" 
                       id="password"
                       name="password" 
                       required 
                       autocomplete="current-password"
                >
                <label for="password">Пароль</label>
                <ul class="errors">
                    @error('password')
                        <li>{{ $message }}</li>
                    @enderror
                </ul>
            </div>

            <div class="input-field options">
                {{-- Remember me --}}
                <div class="input-field checkbox-radio">
                    <input type="checkbox" 
                           name="remember_me" 
                           id="remember_me" 
                           @checked(old('remember_me'))
                    >
                    <label for="remember_me">Запомнить меня</label>
                </div>
                {{-- Forgot password --}}
                <div class="forgot-password">
                    <a href="{{ route('password.request') }}">Восстановить пароль</a>
                </div>
            </div>
            <div class="input-field submit">
                <button type="submit">Войти</button>
            </div>
        </form>
    </main>
</body>
