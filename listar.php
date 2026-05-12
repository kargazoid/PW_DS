<?php
// 1. Feito na aula 13
$host = 'localhost';
$dbname = 'projeto_site';
$usuario = 'root';
$senha = '';

try {
    $conexao = new PDO("mysql:host=$host;dbname;charset=utf8", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

// 2. O comando SELECT do SQL
// Aqui ele puxa as colunas da tabela de contatos
$sql = "SELECT id, nome, email, mensagem FROM contatos";
$stmt = $conexao->prepare($sql);
$stmt->execute();

// 3. Guardando o resultado
// O FETCH_slaoq faz os dados do banco de dados ficarem em formato de array que o php consegue ler
$mensagens = $stmt->fetchALL (PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
    <meta charset="UTF-8">
    <title>Painel de Mensagens</title>
    <style>
        /*css pra ficar gostosinho*/
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #333; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
    </head>

    <body>
        <h2>Mensagens Interceptadas (Banco de Dados)</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Nome/Sobrevivente</th>
                <th>E-mail de contato</th>
                <th>Conteúdo da Mensagem</th>
                <th>Ação</th> <!-- Nova coluna criada aqui -->
            </tr>

            <?php foreach ($mensagens as $linha) : ?>
            <tr>
                <td> <?php echo $linha ['id']; ?> </td>
                <td> <?php echo $linha ['nome']; ?> </td>
                <td> <?php echo $linha ['email']; ?> </td>
                <td> <?php echo $linha ['mensagem']; ?> </td>
                <!-- Novo código, aula 14 abaixo: -->
                 <td>
                    <a href="deletar.php?id=<?php echo $linha['id']; ?>" class="btn-excluir" onclick="return confirm('Tem certeza que deseja excluir este sobrevivente/mensagem?');">Excluir</a>
                 </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <a href="index.html">Voltar para o Formulário</a>
    </body>
</html>