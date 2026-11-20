<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - RuangRona</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f1ec;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .login-box {
            background: white;
            padding: 35px;
            width: 350px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        h2 {
            text-align: center;
            color: #55483d;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #55483d;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #776453;
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>Login Admin</h2>
        <p style="text-align:center;">RuangRona Interior & Living Studio</p>

        @if ($errors->any())
            <p class="error">{{ $errors->first() }}</p>
        @endif

        <form action="{{ route('admin.login.store') }}" method="POST">
            @csrf

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>