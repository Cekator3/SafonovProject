<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->

    <!-- Styles -->
    <link href="/assets/css/normalize.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/themes.css" rel="stylesheet" type="text/css">
    {{-- Other styles --}}
    <link href="/assets/css/app.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/login.css" rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        {{-- logo --}}
        <a class="company-logo" href="{{ route('home') }}">
            <span class="company-logo-3d">3D</span>
            <span class="company-logo-text">models</span>
        </a>

        <nav><ul><li>lol</li></ul></nav>
    </header>

    <main>
        <header>
            <ul>
                <li><a href="{{ route('login') }}">Вход</a></li>
                <li>|</li>
                <li>Регистрация</li>
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

            <div>
                <label for="login">Логин</label>
                <input type="text" 
                       id="login" 
                       name="login" 
                       value='{{ old('login') }}' 
                       required 
                       autofocus 
                       autocomplete="username"
                >
            </div>

            <div>
                <label for="password">Пароль</label>
                <input type="password" 
                       id="password"
                       name="password" 
                       required 
                       autocomplete="current-password"
                >
            </div>

            <div>
                {{-- Remember me --}}
                <div>
                    <label for="remember_me">Запомнить меня</label>
                    <input type="checkbox" 
                        name="remember_me" 
                        id="remember_me" 
                        @checked(old('remember_me'))
                    >
                </div>
                {{-- Forgot password --}}
                <div>
                    <a href="{{ route('password.request') }}">Восстановить пароль</a>
                </div>
            </div>
            <div>
                <button type="submit">Войти</button>
            </div>
        </form>

    </main>
</body>
