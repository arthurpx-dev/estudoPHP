<?php
// Inicializa variáveis para mensagens
$mensagemSucesso = "";
$mensagemErro = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $mensagem = isset($_POST['mensagem']) ? htmlspecialchars($_POST['mensagem']) : '';

    if (!empty($nome) && !empty($email) && !empty($mensagem)) {
        $para = "seu-email@dominio.com";
        $assunto = "Mensagem do Formulário de Contato";
        $corpo = "Nome: $nome\nEmail: $email\n\nMensagem:\n$mensagem";
        $cabecalhos = "From: $email";

        if (mail($para, $assunto, $corpo, $cabecalhos)) {
            $mensagemSucesso = "Mensagem enviada com sucesso!";
        } else {
            $mensagemErro = "Erro ao enviar a mensagem.";
        }
    } else {
        $mensagemErro = "Todos os campos são obrigatórios.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Contato</title>
    <link rel="icon" type="image/x-icon" href="assets/formulario.ico" />
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
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
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
        input[type="email"],
        textarea {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        textarea {
            resize: vertical;
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

        .mensagem {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .mensagem-sucesso {
            background-color: #e7f4e4;
            border: 1px solid #b2d8b2;
            color: #2a7f2a;
        }

        .mensagem-erro {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
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

        <h1>Formulário de Contato</h1>
        <form method="post" action="">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            <br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>

            <label for="mensagem">Mensagem:</label>
            <textarea id="mensagem" name="mensagem" rows="4" required></textarea>
            <br>

            <input type="submit" value="Enviar">
        </form>

        <?php
        if ($mensagemSucesso) {
            echo "<div class='mensagem mensagem-sucesso'>$mensagemSucesso</div>";
        }
        if ($mensagemErro) {
            echo "<div class='mensagem mensagem-erro'>$mensagemErro</div>";
        }
        ?>
    </div>
</body>

</html>