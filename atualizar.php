<?php
// atualizar.php - aula 15 - Prof Célide Tasso
// recebe os dados do editar.php e manda o UPDATE pro banco
// se der certo, volta pra lista. se der errado, a culpa é do PHP que é cheio de frescura

$host = 'localhost';
$dbname = 'projeto_site';
$usuario = 'root';
$senha = '';

try {
    $conexao = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['mensagem'])) {
        $id       = $_POST['id'];
        $nome     = $_POST['nome'];
        $email    = $_POST['email'];
        $mensagem = $_POST['mensagem'];

        // UPDATE — o U do CRUD. SEM o WHERE ia atualizar tudo, seria uma catástrofe
        // colunas em minusculo igual ao sql.sql
        // (se o seu banco for maiusculo muda pra NOME, EMAIL, MENSAGEM — Célide já explicou isso)
        $sql = "UPDATE contatos SET nome = :nome, email = :email, mensagem = :mensagem WHERE id = :id";
        $stmt = $conexao->prepare($sql);

        $stmt->bindParam(':nome',     $nome);
        $stmt->bindParam(':email',    $email);
        $stmt->bindParam(':mensagem', $mensagem);
        $stmt->bindParam(':id',       $id, PDO::PARAM_INT);

        $stmt->execute();

        // redireciona pra lista depois de salvar
        header("Location: listar.php");
        exit();

    } else {
        echo "Acesso inválido ou dados incompletos. Volta pro formulário.";
    }

} catch (PDOException $e) {
    die("Erro ao atualizar: " . $e->getMessage());
}
?>
