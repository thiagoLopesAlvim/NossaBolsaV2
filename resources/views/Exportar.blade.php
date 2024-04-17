<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exportar Disciplinas</title>
    <link rel="icon" type="image/png" href="faesa_favicon.png">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #007bff;
        }

        .form-container {
            text-align: center;
            border: 2px solid black;
            padding: 50px;
            border-radius: 10px;
            background-color: #e6e6e6;
            color: black;
        }

        .input-group {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .input-group label {
            margin-right: 10px;
        }

        button {
            margin-top: 10px;
        }

        input[type="text"] {
            margin-bottom: -10px;
        }

        .input-ano {
            margin-right: 80px;
        }

        .input-semestre {
            margin-right: 63px;
        }

        img {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <img src="faesa.png" width="250">
        <form action="{{ route('RealizarExport') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input-ano">
                <label for="ano">Ano:</label>
                <input type="text" id="ano" name="ano" size="2"><br><br>
            </div>

            <div class="input-semestre">
                <label for="semestre">Semestre:</label>
                <select id="semestre" name="semestre">
                    <option value="1">1º </option>
                    <option value="2">2º </option>
                </select><br><br>
            </div>
            <label for="mantenedora">Mantenedora:</label>
            <select id="mantenedora" name="mantenedora">
                <option value="AEV">AEV</option>
                <option value="FAESA">FAESA</option>
                <option value="UNICAPE">Unicape</option>
            </select><br><br>

            <button type="submit">Exportar</button>

        </form>
        <button type="button" onclick="window.location.href='{{ route('voltar') }}'">Voltar para o menu</button>
    </div>

</body>

</html>
