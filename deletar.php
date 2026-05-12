<?php
// 1. A mesma conexão da aula anterior
$host = 'localhost';
$dbname = 'projeto_site';
$usuario = 'root';
$senha = '';

try {
    $conexao = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Verifica se o ID foi passado pela URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // 2. O comando SQL de exclusão (DELETE)
        $sql = "DELETE FROM contatos WHERE id = :id";
        $stmt = $conexao->prepare($sql);

        // Passando o ID de forma segura contra o SQL Injection
        $stmt->bindParam (':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    // 3. Redireciona de volta para a lista após deletar
    header("Location: listar.php");
    exit();

} catch (PDOException $e) {
    die("Erro ao tentar deletar: " . $e->getMessage());
}
?>