<div class="mb-4 text-sm text-gray-600">
    'Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
</div>        

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Session Status -->
<div>{{ session('status') }}</div>

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <!-- Email Address -->
    <div>
        <label for="email" value="Email" />
        <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required autofocus />
    </div>

    <div class="flex items-center justify-end mt-4">
        <button>Email Password Reset Link</button>
    </div>
</form>
