<?php
// 1. Configurações de acesso ao Banco de Dados
$host = 'localhost';
$dbname = 'projeto_site';
$usuario = 'root'; // Usuário padrão do XAMPP
$senha = ''; // Senha padrão do XAMPP geralmente é vazia

// 2. Tentativa de Conexão usando PDO (Boas práticas)
try {
    $conexao = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);
    // Configura o PDO para mostrar erros caso algo de errado
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}
    catch (PDOException $e) {
    // Se der erro na conexão, o sistema para e avisa
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());}

// 3. Recebendo os dados do formulário HTML (os names dos inputs)
// o 'if' garante que só vai tentar salvar se o formulário realmente foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_recebido = $_POST['nome'];
    $email_recebido = $_POST['email'];
    $mensagem_recebida = $_POST['mensagem'];

// 4. Preparando o comando SQL (O INSERT)
// Usamos nome, email e mensagem como "coringas" por segurança
$sql = "INSERT INTO contatos (nome, email, mensagem) VALUES (:nome, :email, :mensagem)";
$stmt = $conexao->prepare($sql);

//5. Substituindo os coringas pelos dados reais que vieram do formulário
$stmt->bindParam(':nome', $nome_recebido);
$stmt->bindParam(':email', $email_recebido);
$stmt->bindParam(':mensagem', $mensagem_recebida);

// 6. Executando e verificando se deu certo
if ($stmt->execute()) {
    echo "<h1>Sucesso!</h1>";
    echo "<p>Dados salvos no banco de dados.</p>";
    echo "<a href='index.html'>Voltar</a>";
    } else {
    echo "Erro ao tentar salvar os dados.";
    }
    }
?>