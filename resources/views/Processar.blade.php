<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processamento</title>
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

        button {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <img src="faesa.png" width="250">
        <form action="{{ route('realizar') }}" method="post" enctype="multipart/form-data">
            <input type="hidden" value="{{ csrf_token() }}" name="_token"><br>
            <input type="file" name="arquivo" id="arquivo" accept=".xlsx"><br>
            <button type="submit">Processar</button>
            <br>
            <button type="button" onclick="window.location.href='{{ route('voltar') }}'">Voltar para o menu</button>
        </form>
    </div>

</body>

</html>
