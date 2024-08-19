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

echo "<a href='primeiroCodigo.php'>Clique aqui para ir para o primeiro código</a><br>";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Contato</title>
</head>

<body>
    <h1>Formulário de Contato</h1>
    <form method="post" action="">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="mensagem">Mensagem:</label>
        <textarea id="mensagem" name="mensagem" rows="4" required></textarea>
        <br><br>

        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($mensagemSucesso) {
        echo "<p style='color: green;'>$mensagemSucesso</p>";
    }
    if ($mensagemErro) {
        echo "<p style='color: red;'>$mensagemErro</p>";
    }
    ?>
</body>

</html>