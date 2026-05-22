<?php
// 1. Feito na aula 13, atualizado na aula 14 (deletar) e aula 15 (editar)
// basicamente esse arquivo ta sofrendo mais que eu na prova
$host = 'localhost';
$dbname = 'projeto_site';
$usuario = 'root';
$senha = ''; // senha vazia igual minha vontade de estudar php

try {
    $conexao = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

// 2. O comando SELECT do SQL
$sql = "SELECT id, nome, email, mensagem FROM contatos";
$stmt = $conexao->prepare($sql);
$stmt->execute();

// 3. Guardando o resultado
// (antes eu escrevia FETCH_slaoq e funcionava na minha cabeça mas nao no codigo)
$mensagens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel de Mensagens</title>
    <style>
        /* css glass pra ficar gostosinho - obrigado Célide */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            padding: 30px;
            background: linear-gradient(135deg, #0d2144, #1a3a6e);
        }

        .container {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 10px;
            padding: 30px;
        }

        h2 { color: #fff; margin-bottom: 20px; }

        table { width: 100%; border-collapse: collapse; }

        th, td { padding: 10px; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.1); }

        th { color: rgba(255,255,255,0.5); font-size: 12px; text-transform: uppercase; }

        td { color: rgba(255,255,255,0.8); font-size: 14px; }

        .btn-editar { color: rgba(120,200,255,0.9); margin-right: 8px; }
        .btn-excluir { color: rgba(255,100,100,0.9); }

        a { color: rgba(180,220,255,0.7); font-size: 13px; }
        a:hover { color: #fff; }

        .footer { margin-top: 20px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Mensagens Interceptadas (Banco de Dados)</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome/Sobrevivente</th>
            <th>E-mail de contato</th>
            <th>Conteúdo da Mensagem</th>
            <th>Ação</th>
        </tr>

        <?php foreach ($mensagens as $linha) : ?>
        <tr>
            <td><?php echo $linha['id']; ?></td>
            <td><?php echo $linha['nome']; ?></td>
            <td><?php echo $linha['email']; ?></td>
            <td><?php echo $linha['mensagem']; ?></td>
            <!-- aula 14: deletar / aula 15: editar — CRUD finalmente completo -->
            <td>
                <a href="editar.php?id=<?php echo $linha['id']; ?>" class="btn-editar">Editar</a>
                <a href="deletar.php?id=<?php echo $linha['id']; ?>" class="btn-excluir" onclick="return confirm('Tem certeza que deseja excluir este sobrevivente/mensagem?');">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <div class="footer">
        <a href="index.html">Voltar para o Formulário</a>
    </div>
</div>
</body>
</html>
