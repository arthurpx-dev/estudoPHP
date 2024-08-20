<?php
// Função para inicializar o tabuleiro
function inicializarTabuleiro()
{
    return [
        [' ', ' ', ' '],
        [' ', ' ', ' '],
        [' ', ' ', ' ']
    ];
}

// Função para salvar o tabuleiro e o próximo jogador
function salvarEstado($tabuleiro, $proximoJogador)
{
    $filename = 'estado_tabuleiro.txt';
    $conteudo = '';
    foreach ($tabuleiro as $linha) {
        $conteudo .= implode(',', $linha) . "\n";
    }
    $conteudo .= $proximoJogador;
    file_put_contents($filename, $conteudo);
}

// Função para carregar o tabuleiro e o próximo jogador
function carregarEstado()
{
    $filename = 'estado_tabuleiro.txt';
    if (file_exists($filename)) {
        $conteudo = file($filename, FILE_IGNORE_NEW_LINES);
        $tabuleiro = [];
        for ($i = 0; $i < 3; $i++) {
            $tabuleiro[] = explode(',', $conteudo[$i]);
        }
        $proximoJogador = end($conteudo);
        return [$tabuleiro, $proximoJogador];
    } else {
        return [inicializarTabuleiro(), 'X'];
    }
}

// Função para verificar o vencedor
function verificarVencedor($tabuleiro)
{
    $vencedor = null;
    // Checar linhas e colunas
    for ($i = 0; $i < 3; $i++) {
        if ($tabuleiro[$i][0] === $tabuleiro[$i][1] && $tabuleiro[$i][1] === $tabuleiro[$i][2] && $tabuleiro[$i][0] !== ' ') {
            $vencedor = $tabuleiro[$i][0];
        }
        if ($tabuleiro[0][$i] === $tabuleiro[1][$i] && $tabuleiro[1][$i] === $tabuleiro[2][$i] && $tabuleiro[0][$i] !== ' ') {
            $vencedor = $tabuleiro[0][$i];
        }
    }
    // Checar diagonais
    if ($tabuleiro[0][0] === $tabuleiro[1][1] && $tabuleiro[1][1] === $tabuleiro[2][2] && $tabuleiro[0][0] !== ' ') {
        $vencedor = $tabuleiro[0][0];
    }
    if ($tabuleiro[0][2] === $tabuleiro[1][1] && $tabuleiro[1][1] === $tabuleiro[2][0] && $tabuleiro[0][2] !== ' ') {
        $vencedor = $tabuleiro[0][2];
    }
    return $vencedor;
}

// Função para verificar se o tabuleiro está cheio
function verificarEmpate($tabuleiro)
{
    foreach ($tabuleiro as $linha) {
        foreach ($linha as $casa) {
            if ($casa === ' ') {
                return false;
            }
        }
    }
    return true;
}

// Inicializa ou carrega o tabuleiro e próximo jogador
list($tabuleiro, $proximoJogador) = carregarEstado();
$mensagem = '';

// Processa o movimento
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['jogar'])) {
        $linha = intval($_POST['linha']);
        $coluna = intval($_POST['coluna']);
        if ($tabuleiro[$linha][$coluna] === ' ') {
            $tabuleiro[$linha][$coluna] = $proximoJogador;
            $vencedor = verificarVencedor($tabuleiro);
            if ($vencedor) {
                $mensagem = "Jogador $vencedor ganhou!";
                $tabuleiro = inicializarTabuleiro();
                $proximoJogador = 'X'; // Reinicia o jogo com 'X' como próximo jogador
            } elseif (verificarEmpate($tabuleiro)) {
                $mensagem = "Empate!";
                $tabuleiro = inicializarTabuleiro();
                $proximoJogador = 'X'; // Reinicia o jogo com 'X' como próximo jogador
            } else {
                $proximoJogador = $proximoJogador === 'X' ? 'O' : 'X';
            }
            salvarEstado($tabuleiro, $proximoJogador);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo da Velha</title>
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
            max-width: 400px;
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

        .tabuleiro {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
        }

        .casa {
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2em;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .casa:hover {
            background-color: #e9ecef;
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
        <h1>Jogo da Velha</h1>
        <?php if ($mensagem) : ?>
            <div class="mensagem mensagem-sucesso"><?php echo htmlspecialchars($mensagem); ?></div>
        <?php endif; ?>

        <div class="tabuleiro">
            <?php for ($linha = 0; $linha < 3; $linha++) : ?>
                <?php for ($coluna = 0; $coluna < 3; $coluna++) : ?>
                    <div class="casa" onclick="document.getElementById('linha').value = <?php echo $linha; ?>; document.getElementById('coluna').value = <?php echo $coluna; ?>; document.getElementById('form-jogo').submit();">
                        <?php echo htmlspecialchars($tabuleiro[$linha][$coluna]); ?>
                    </div>
                <?php endfor; ?>
            <?php endfor; ?>
        </div>

        <form id="form-jogo" method="post" action="">
            <input type="hidden" id="linha" name="linha">
            <input type="hidden" id="coluna" name="coluna">
            <input type="hidden" name="jogar" value="true">
        </form>
    </div>

    <div class="links">
        <a href="primeiroCodigo.php">Clique aqui para ir para o primeiro código</a>
    </div>
</body>

</html>