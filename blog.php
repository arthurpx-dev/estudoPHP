<?php
// Inicializa variáveis para mensagens
$mensagem = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['titulo']) && isset($_POST['conteudo'])) {
        $titulo = htmlspecialchars(trim($_POST['titulo']));
        $conteudo = htmlspecialchars(trim($_POST['conteudo']));

        if (!empty($titulo) && !empty($conteudo)) {
            $post = "Título: $titulo\nConteúdo: $conteudo\n\n";
            file_put_contents('posts.txt', $post, FILE_APPEND);
            $mensagem = "Postagem adicionada com sucesso!";
        } else {
            $mensagem = "Todos os campos são obrigatórios.";
        }
    } elseif (isset($_POST['delete_post'])) {
        // Exclui um post
        $deleteIndex = intval($_POST['delete_post']);
        $posts = file_exists('posts.txt') ? file('posts.txt', FILE_IGNORE_NEW_LINES) : [];
        if (isset($posts[$deleteIndex])) {
            unset($posts[$deleteIndex]);
            // Reindexa os posts e salva novamente
            $posts = array_values($posts);
            file_put_contents('posts.txt', implode("\n", $posts) . "\n");
            $mensagem = "Postagem deletada com sucesso!";
        } else {
            $mensagem = "Erro ao deletar postagem.";
        }
    }
}

// Carrega posts existentes
$posts = file_exists('posts.txt') ? file('posts.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Simples</title>
    <link rel="icon" type="image/x-icon" href="assets/blog.ico" />
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

        h1 {
            color: #007bff;
            font-size: 1.8em;
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

        .postagem-bloco {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .postagem-bloco h3 {
            margin: 0;
        }

        .postagem-bloco p {
            margin: 5px 0;
        }

        .postagem-bloco button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }

        .postagem-bloco button:hover {
            background-color: #ff1a1a;
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

        <h1>Adicionar Postagem</h1>
        <form method="post" action="">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>
            <br>

            <label for="conteudo">Conteúdo:</label>
            <textarea id="conteudo" name="conteudo" rows="5" required></textarea>
            <br>

            <input type="submit" value="Adicionar Postagem">
        </form>

        <?php
        if ($mensagem) {
            $classeMensagem = strpos($mensagem, 'sucesso') !== false ? 'mensagem-sucesso' : 'mensagem-erro';
            echo "<div class='mensagem $classeMensagem'>$mensagem</div>";
        }
        ?>

        <h2>Postagens:</h2>
        <div>
            <?php
            // Verifica se $posts é um array e não está vazio
            if (is_array($posts) && count($posts) > 0) {
                $i = 0;
                foreach ($posts as $post) {
                    // Verifica se $post é um array e contém pelo menos dois elementos
                    if (is_array($post) && count($post) >= 2) {
                        $titulo = htmlspecialchars(trim($post[0]));
                        $conteudo = htmlspecialchars(trim($post[1]));
                        echo "<div class='postagem-bloco'>";
                        echo "<h3>$titulo</h3>";
                        echo "<p>$conteudo</p>";
                        echo "<form method='post' style='display:inline;'>";
                        echo "<button type='submit' name='delete_post' value='$i'>Deletar</button>";
                        echo "</form>";
                        echo "</div>";
                    } else {
                        echo "<p>Postagem com menos de 2 elementos: ";
                        print_r($post);
                        echo "</p>";
                    }
                    $i++;
                }
            } else {
                echo "<p>Nenhuma postagem encontrada.</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>