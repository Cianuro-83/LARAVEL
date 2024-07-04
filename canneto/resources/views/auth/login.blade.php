<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    @vite(['resources/scss/login.scss'])
</head>
<body>
    <div class="login">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <h2>Accedi al Pannello di Amministrazione</h2>
            <div class="input">
                <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                <label for="email">Email</label>
                <span></span>
            </div>

            <div class="input">
                <input id="password" type="password" name="password" required minlength="8" autocomplete="current-password">
                <label for="password">Password</label>
                <span></span>
            </div>

            <div class="link">
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ __('Password dimenticata?') }}
                </a>
                @endif
            </div>

            <x-button class="ms-4">
                {{ __('Accedi') }}
            </x-button>

        </form>
    </div>
    @vite(['resources/js/login.js'])
</body>
</html>
