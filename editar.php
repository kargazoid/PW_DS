<?php
// editar.php - aula 15 - Prof Célide Tasso
// a letra U do CRUD. Create, Read, Delete a gente já tinha. faltava essa aqui

$host = 'localhost';
$dbname = 'projeto_site';
$usuario = 'root';
$senha = '';
$contato = null;

try {
    $conexao = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // busca o contato pelo ID da URL — is_numeric() pra nao deixar besteira entrar
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM contatos WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $contato = $stmt->fetch(PDO::FETCH_ASSOC);
    }

} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Mensagem</title>
    <style>
        /* mesmo css glass do index — consistência né */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0d2144, #1a3a6e);
        }

        .container {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 10px;
            padding: 30px;
            width: 320px;
        }

        h2 { color: #fff; margin-bottom: 20px; }

        form { display: flex; flex-direction: column; gap: 10px; }

        label { color: rgba(255,255,255,0.8); font-size: 13px; }

        input, textarea {
            padding: 8px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 6px;
            color: #fff;
            font-size: 14px;
            outline: none;
        }

        input:focus, textarea:focus { border-color: rgba(100,180,255,0.7); }

        button {
            padding: 10px;
            background: rgba(60,120,220,0.6);
            border: 1px solid rgba(100,160,255,0.4);
            border-radius: 6px;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
        }

        button:hover { background: rgba(80,140,240,0.8); }

        .erro {
            color: rgba(255,150,150,0.9);
            background: rgba(255,80,80,0.1);
            border: 1px solid rgba(255,80,80,0.3);
            border-radius: 6px;
            padding: 10px;
            font-size: 13px;
        }

        a { display: block; margin-top: 14px; color: rgba(180,220,255,0.7); font-size: 13px; }
        a:hover { color: #fff; }
    </style>
</head>
<body>
<div class="container">
    <h2>Editar Contato</h2>

    <?php if ($contato): ?>
        <form action="atualizar.php" method="POST">
            <!-- id escondido pra o atualizar.php saber qual linha mexer -->
            <input type="hidden" name="id" value="<?php echo $contato['id']; ?>">

            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($contato['nome']); ?>" required>

            <label>E-mail:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($contato['email']); ?>" required>

            <label>Mensagem:</label>
            <!-- textarea nao tem value, conteudo vai entre as tags -->
            <textarea name="mensagem" required><?php echo htmlspecialchars($contato['mensagem']); ?></textarea>

            <button type="submit">Salvar Alterações</button>
        </form>

    <?php else: ?>
        <div class="erro">
            <strong>Atenção:</strong> Contato não encontrado ou ID inválido.
            Verifique se a URL está correta (ex: editar.php?id=1).
        </div>
    <?php endif; ?>

    <a href="listar.php">Voltar para a lista</a>
</div>
</body>
</html>
