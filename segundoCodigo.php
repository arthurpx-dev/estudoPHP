<?php
// Exibindo o conteúdo da página com HTML e PHP
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Segundo Código</title>
    <link rel="icon" type="image/x-icon" href="/assets/home.ico" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .container {
            width: 80%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: #007bff;
            font-size: 2em;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.1em;
        }

        .result {
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 20px;
        }

        .links {
            margin-top: 20px;
        }

        .links a {
            display: inline-block;
            margin: 5px 0;
            padding: 10px 15px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .links a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Segundo Código</h1>

        <p>linha de instrução 1</p>
        <?php
        $num = 152;
        $numB = 91;
        $divisao = $num / $numB;
        ?>
        <div class="result">
            <p>Resultado da divisão: <?php echo $divisao; ?></p>
            <p>linha de instrução 2</p>
        </div>

        <div class="links">
            <a href="primeiroCodigo.php">Clique aqui para ir para o primeiro código</a>
            <a href="calculadora.php">Clique aqui para ir para calculadora</a>
        </div>
    </div>
</body>

</html>