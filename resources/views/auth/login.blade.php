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

        <div>
            <input type="submit" value="1">
        </div>
    </form>
</body>
