<!DOCTYPE html>

<body>
    <form action="{{ route('register') }}" method="post">
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
            <input type="text" name="login" value='{{ old('login') }}' placeholder="login">
        </div>

        <div>
            <input type="text" name="email" value='{{ old('email') }}' placeholder="email">
        </div>

        <div>
            <input type="text" name="phone_number" value='{{ old('phone_number') }}' placeholder="phone_number">
        </div>

        <div>
            <input type="text" name="name" value='{{ old('name') }}' placeholder="name">
        </div>

        <div>
            <input type="text" name="surname" value='{{ old('surname') }}' placeholder="surname">
        </div>

        <div>
            <input type="text" name="patronymic" value='{{ old('patronymic') }}' placeholder="patronymic">
        </div>

        <div>
            <input type="password" name="password" placeholder="password">
        </div>

        <div>
            <input type="password" name="password_confirmation" placeholder="password_confirmation">
        </div>

        <div>
            <input type="submit" value="1">
        </div>
    </form>
</body>
