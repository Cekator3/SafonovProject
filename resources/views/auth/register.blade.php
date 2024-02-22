<!DOCTYPE html>

<body>
    <form action="{{ route('register') }}" method="post">
        @csrf
        <input type="text" name="login">
        <input type="email" name="email">
        <input type="text" name="phone_number">
        <input type="text" name="name">
        <input type="text" name="surname">
        <input type="text" name="patronymic">
        <input type="password" name="password">
        <input type="password" name="password_confirmation">
    </form>
</body>
