@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('password.store') }}">
    @csrf

    <!-- Password Reset Token -->
    <input type="hidden" name="token" value="{{ $token }}">

    <!-- Email Address -->
    <input id="email" hidden class="block mt-1 w-full" type="email" name="email" value="{{ old('email', $email) }}" required autofocus autocomplete="username" />

    <!-- Password -->
    <div class="mt-4">
        <label for="password" value="Password" />
        <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <label for="password_confirmation" value="Confirm Password" />

        <input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <button>Reset Password</button>
    </div>
</form>
