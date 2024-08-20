<?php
// Exibindo o conteúdo da página com HTML e PHP
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Página PHP</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: #0056b3;
            font-size: 2em;
            border-bottom: 2px solid #0056b3;
            padding-bottom: 10px;
        }

        p {
            font-size: 1.1em;
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

        .result {
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Exemplo de Página PHP</h1>

        <p>O comando 'echo' apresenta dados na tela do navegador:</p>

        <div class="result">
            <p>linha de instrução 1</p>
            <?php
            $num = 15;
            $numB = 9;
            $soma = $num + $numB;
            ?>
            <p>Resultado da soma: <?php echo $soma; ?></p>
            <p>linha de instrução 2</p>
        </div>

        <div class="links">
            <a href="segundoCodigo.php">Clique aqui para ir para o segundo código</a>
            <a href="calculadora.php">Clique aqui para ir para calculadora</a>
            <a href="blog.php">Clique aqui para ir para blog</a>
            <a href="agenda.php">Clique aqui para ir para agenda</a>
            <a href="formulario.php">Clique aqui para ir para formulário</a>
            <a href="jogoDaVelha.php">Clique aqui para ir para jogo da velha</a>
        </div>
    </div>
</body>

</html>