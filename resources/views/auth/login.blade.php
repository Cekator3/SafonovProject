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
        <a class="company-logo" href="{{ route('home') }}">
            <span class="company-logo-3d">3D</span>
            <span class="company-logo-text">models</span>
        </a>

        {{-- <nav>
            <li>lol</li>
            <li>lol</li>
            <li>lol</li>
            <li>lol</li>
            <li>lol</li>
        </nav> --}}
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="input-field text">
                <input type="text" 
                       id="login" 
                       name="login" 
                       value='{{ old('login') }}' 
                       required 
                       autofocus 
                       autocomplete="username"
                >
                <label for="login">Логин</label>
            </div>

            <div class="input-field text">
                <input type="password" 
                       id="password"
                       name="password" 
                       required 
                       autocomplete="current-password"
                >
                <label for="password">Пароль</label>
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
