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

echo "<a href='primeiroCodigo.php'>Clique aqui para ir para o primeiro código</a><br>";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora PHP</title>
</head>

<body>
    <h1>Calculadora Simples</h1>
    <form method="post" action="">
        <label for="numero1">Primeiro Valor:</label>
        <input type="text" id="numero1" name="numero1" value="<?php echo isset($_POST['numero1']) ? htmlspecialchars($_POST['numero1']) : ''; ?>" required>
        <br><br>

        <label for="operacao">Operação:</label>
        <select id="operacao" name="operacao" required>
            <option value="">Selecione</option>
            <option value="+" <?php echo (isset($_POST['operacao']) && $_POST['operacao'] == '+') ? 'selected' : ''; ?>>Adição</option>
            <option value="-" <?php echo (isset($_POST['operacao']) && $_POST['operacao'] == '-') ? 'selected' : ''; ?>>Subtração</option>
            <option value="*" <?php echo (isset($_POST['operacao']) && $_POST['operacao'] == '*') ? 'selected' : ''; ?>>Multiplicação</option>
            <option value="/" <?php echo (isset($_POST['operacao']) && $_POST['operacao'] == '/') ? 'selected' : ''; ?>>Divisão</option>
        </select>
        <br><br>

        <label for="numero2">Segundo Valor:</label>
        <input type="text" id="numero2" name="numero2" value="<?php echo isset($_POST['numero2']) ? htmlspecialchars($_POST['numero2']) : ''; ?>" required>
        <br><br>

        <input type="submit" value="Calcular">
    </form>

    <?php
    if ($resultado !== "") {
        echo "<h2>Resultado: " . htmlspecialchars($resultado) . "</h2>";
    }
    if ($mensagem !== "") {
        echo "<h2>Mensagem: " . htmlspecialchars($mensagem) . "</h2>";
    }
    ?>
</body>

</html>