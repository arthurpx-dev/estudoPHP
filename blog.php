<?php
// Inicializa variáveis para mensagens
$mensagem = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = isset($_POST['titulo']) ? htmlspecialchars($_POST['titulo']) : '';
    $conteudo = isset($_POST['conteudo']) ? htmlspecialchars($_POST['conteudo']) : '';

    if (!empty($titulo) && !empty($conteudo)) {
        $post = "Título: $titulo\nConteúdo: $conteudo\n\n";
        file_put_contents('posts.txt', $post, FILE_APPEND);
        $mensagem = "Postagem adicionada com sucesso!";
    } else {
        $mensagem = "Todos os campos são obrigatórios.";
    }
}

// Carrega posts existentes
$posts = file_exists('posts.txt') ? file('posts.txt', FILE_IGNORE_NEW_LINES) : [];

echo "<a href='primeiroCodigo.php'>Clique aqui para ir para primeiro código</a>";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Simples</title>
</head>

<body>
    <h1>Adicionar Postagem</h1>
    <form method="post" action="">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>
        <br><br>

        <label for="conteudo">Conteúdo:</label>
        <textarea id="conteudo" name="conteudo" rows="5" required></textarea>
        <br><br>

        <input type="submit" value="Adicionar Postagem">
    </form>

    <?php
    if ($mensagem) {
        echo "<p>$mensagem</p>";
    }
    ?>

    <h2>Postagens:</h2>
    <div>
        <?php
        foreach ($posts as $post) {
            echo "<p>" . nl2br(htmlspecialchars($post)) . "</p>";
        }
        ?>
    </div>
</body>

</html>