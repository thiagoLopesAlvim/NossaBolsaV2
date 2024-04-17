<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="icon" type="image/png" href="faesa_favicon.png">
    <style>
        body {
            background-color: #ebebeb;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            position: relative;
        }

        img {
            margin-top: 20px;
        }

        nav {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 200px;
            background-color: #107ed8;
            background-image: url();
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-bottom: 20px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: calc(100% - 40px);
        }

        nav li {
            text-align: center;
        }

        nav li a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 14px 16px;
            box-sizing: border-box;
            text-align: center;
        }

        nav li a:hover {
            background-color: #524545;
            color: black;
        }

        .logout-link {
            font-size: 16px;
            text-align: left;
            padding-left: 16px;
            cursor: pointer;
            color: white;
        }
    </style>
</head>

<body>
    <nav>
        <img src="faesa.png">
        <ul>
            <li>
                <hr><a href="{{ route('Processar') }}">Importar alunos Nossa Bolsa</a>

                <hr><a href="{{ route('Exportar') }}">Exportar Disciplinas Matriculadas</a>


                <hr><a href="{{ route('Exportar2') }}">Exportar Notas</a>
                <hr>
            </li>
        </ul>

        <a href="{{ route('logout') }}" class="logout-link">Logout</a>

    </nav>
</body>

</html>
