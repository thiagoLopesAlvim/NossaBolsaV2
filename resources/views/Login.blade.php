<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="faesa_favicon.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #107ed8;
        }

        .container {
            width: 280px;
            margin: 50px auto;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container img {
            display: block;
            margin: 0 auto 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: calc(100% - 20px);
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 3px;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

    </style>
</head>

<body>
    <div class="container">
        <img src="faesa.png" width="150">
        <form action="{{ route('login.post') }}" method="POST">
            @csrf <!-- evitar erros de token -->
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" required>
            @error('login')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            @error('senha')
                <div class="error">{{ $message }}</div>
            @enderror

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <input type="submit" value="Entrar">
        </form>
    </div>
</body>

</html>
