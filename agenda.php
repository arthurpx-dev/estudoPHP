<?php
// Inicializa variáveis para mensagens
$mensagem = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $evento = isset($_POST['evento']) ? htmlspecialchars($_POST['evento']) : '';
    $data = isset($_POST['data']) ? htmlspecialchars($_POST['data']) : '';

    if (!empty($evento) && !empty($data)) {
        $eventoText = "Evento: $evento\nData: $data\n\n";
        file_put_contents('agenda.txt', $eventoText, FILE_APPEND);
        $mensagem = "Evento adicionado com sucesso!";
    } else {
        $mensagem = "Todos os campos são obrigatórios.";
    }
}

// Carrega eventos existentes
$eventos = file_exists('agenda.txt') ? file('agenda.txt', FILE_IGNORE_NEW_LINES) : [];

echo "<a href='primeiroCodigo.php'>Clique aqui para ir para primeiro código</a>";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
</head>

<body>
    <h1>Adicionar Evento</h1>
    <form method="post" action="">
        <label for="evento">Evento:</label>
        <input type="text" id="evento" name="evento" required>
        <br><br>

        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required>
        <br><br>

        <input type="submit" value="Adicionar Evento">
    </form>

    <?php
    if ($mensagem) {
        echo "<p>$mensagem</p>";
    }
    ?>

    <h2>Eventos:</h2>
    <div>
        <?php
        foreach ($eventos as $evento) {
            echo "<p>" . nl2br(htmlspecialchars($evento)) . "</p>";
        }
        ?>
    </div>
</body>

</html>