<?php
// Inicializa variáveis para mensagens
$mensagem = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['evento']) && isset($_POST['data'])) {
        // Adiciona um evento
        $evento = htmlspecialchars($_POST['evento']);
        $data = htmlspecialchars($_POST['data']);

        if (!empty($evento) && !empty($data)) {
            $eventoText = "Evento: $evento | Data: $data";
            file_put_contents('agenda.txt', $eventoText . "\n", FILE_APPEND);
            $mensagem = "Evento adicionado com sucesso!";
        } else {
            $mensagem = "Todos os campos são obrigatórios.";
        }
    } elseif (isset($_POST['delete_event'])) {
        // Exclui um evento
        $deleteIndex = intval($_POST['delete_event']);
        $eventos = file_exists('agenda.txt') ? file('agenda.txt', FILE_IGNORE_NEW_LINES) : [];
        if (isset($eventos[$deleteIndex])) {
            unset($eventos[$deleteIndex]);
            file_put_contents('agenda.txt', implode("\n", $eventos) . "\n");
            $mensagem = "Evento deletado com sucesso!";
        } else {
            $mensagem = "Erro ao deletar evento.";
        }
    }
}

// Carrega eventos existentes
$eventos = file_exists('agenda.txt') ? file('agenda.txt', FILE_IGNORE_NEW_LINES) : [];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link rel="icon" type="image/x-icon" href="assets/agenda.ico" />
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
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2 {
            color: #007bff;
            font-size: 1.5em;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"] {
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

        .evento-bloco {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            background-color: #f9f9f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .evento-bloco p {
            margin: 0;
        }

        .evento-bloco button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
            transition: background-color 0.3s;
        }

        .evento-bloco button:hover {
            background-color: #ff1a1a;
        }

        .message {
            background-color: #e7f4e4;
            padding: 10px;
            border: 1px solid #b2d8b2;
            border-radius: 5px;
            margin-bottom: 20px;
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

        <h1>Adicionar Evento</h1>
        <form method="post" action="">
            <label for="evento">Evento:</label>
            <input type="text" id="evento" name="evento" required>
            <br>

            <label for="data">Data:</label>
            <input type="date" id="data" name="data" required>
            <br>

            <input type="submit" value="Adicionar Evento">
        </form>

        <?php
        if ($mensagem) {
            echo "<div class='message'>$mensagem</div>";
        }
        ?>

        <h2>Eventos:</h2>
        <div>
            <?php
            foreach ($eventos as $index => $evento) {
                echo "<div class='evento-bloco'>";
                echo "<p>" . htmlspecialchars($evento) . "</p>";
                echo "<form method='post' style='display:inline;'>";
                echo "<button type='submit' name='delete_event' value='$index'>Deletar</button>";
                echo "</form>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>

</html>