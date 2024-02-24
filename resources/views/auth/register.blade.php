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
            <input type="text" name="login" value={{ old('login') }}>
        </div>

        <div>
            <input type="text" name="email" value={{ old('email') }}>
        </div>

        <div>
            <input type="text" name="phone_number" value={{ old('phone_number') }}>
        </div>

        <div>
            <input type="text" name="name" value={{ old('name') }}>
        </div>

        <div>
            <input type="text" name="surname" value={{ old('surname') }}>
        </div>

        <div>
            <input type="text" name="patronymic" value={{ old('patronymic') }}>
        </div>

        <div>
            <input type="password" name="password">
        </div>

        <div>
            <input type="password" name="password_confirmation">
        </div>

        <div>
            <input type="submit" value="1">
        </div>
    </form>
</body>
