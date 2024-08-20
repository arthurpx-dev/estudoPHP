<?php
// Inicializa variáveis para armazenar resultados e mensagens
$resultado = "";
$mensagem = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores dos campos do formulário
    $numero1 = isset($_POST['numero1']) ? (float)$_POST['numero1'] : 0;
    $numero2 = isset($_POST['numero2']) ? (float)$_POST['numero2'] : 0;
    $operacao = isset($_POST['operacao']) ? $_POST['operacao'] : '';

    // Realiza o cálculo baseado na operação selecionada
    switch ($operacao) {
        case '+':
            $resultado = $numero1 + $numero2;
            break;
        case '-':
            $resultado = $numero1 - $numero2;
            break;
        case '*':
            $resultado = $numero1 * $numero2;
            break;
        case '/':
            if ($numero2 != 0) {
                $resultado = $numero1 / $numero2;
            } else {
                $mensagem = "Não é possível dividir por zero.";
            }
            break;
        default:
            $mensagem = "Operação inválida.";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora PHP</title>
    <link rel="icon" type="image/x-icon" href="assets/calculadora.ico" />
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
            max-width: 800px;
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

        form {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .result,
        .message {
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        <div class="links">
            <a href="primeiroCodigo.php">Clique aqui para ir para o primeiro código</a>
        </div>

        <h1>Calculadora Simples</h1>

        <form method="post" action="">
            <label for="numero1">Primeiro Valor:</label>
            <input type="text" id="numero1" name="numero1" value="<?php echo isset($_POST['numero1']) ? htmlspecialchars($_POST['numero1']) : ''; ?>" required>
            <br>

            <label for="operacao">Operação:</label>
            <select id="operacao" name="operacao" required>
                <option value="">Selecione</option>
                <option value="+" <?php echo (isset($_POST['operacao']) && $_POST['operacao'] == '+') ? 'selected' : ''; ?>>Adição</option>
                <option value="-" <?php echo (isset($_POST['operacao']) && $_POST['operacao'] == '-') ? 'selected' : ''; ?>>Subtração</option>
                <option value="*" <?php echo (isset($_POST['operacao']) && $_POST['operacao'] == '*') ? 'selected' : ''; ?>>Multiplicação</option>
                <option value="/" <?php echo (isset($_POST['operacao']) && $_POST['operacao'] == '/') ? 'selected' : ''; ?>>Divisão</option>
            </select>
            <br>

            <label for="numero2">Segundo Valor:</label>
            <input type="text" id="numero2" name="numero2" value="<?php echo isset($_POST['numero2']) ? htmlspecialchars($_POST['numero2']) : ''; ?>" required>
            <br>

            <input type="submit" value="Calcular">
        </form>

        <?php
        if ($resultado !== "") {
            echo "<div class='result'><h2>Resultado: " . htmlspecialchars($resultado) . "</h2></div>";
        }
        if ($mensagem !== "") {
            echo "<div class='message'><h2>Mensagem: " . htmlspecialchars($mensagem) . "</h2></div>";
        }
        ?>
    </div>
</body>

</html>