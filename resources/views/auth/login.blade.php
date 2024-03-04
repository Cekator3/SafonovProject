<!DOCTYPE html>

<body>
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
            <input type="text" name="login" value='{{ old('login') }}' placeholder="login">
        </div>

        <div>
            <input type="password" name="password" placeholder="password">
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    'Forgot your password?'
                </a>
            @endif

            <div>
                <input type="submit" value="1">
            </div>
        </div>

    </form>
</body>
