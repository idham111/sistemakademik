<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style> body { font-family: sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; } .login-box { background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 300px; } input { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; } button { width: 100%; padding: 10px; border: none; background-color: #007bff; color: white; border-radius: 4px; cursor: pointer; } .error { color: red; font-size: 0.9em; margin-top: -10px; margin-bottom: 10px; } </style>
</head>
<body>
    <div class="login-box">
        <h2>Login Sistem Akademik</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="username">Username</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus>
                @error('username') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>