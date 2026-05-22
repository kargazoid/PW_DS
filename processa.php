<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1. Configurações de acesso ao Banco de Dados
$host = 'localhost';
$dbname = 'projeto_site';
$usuario = 'root';    // usuário padrão do XAMPP
$senha = '';          // senha padrão do XAMPP geralmente é vazia

// 2. Tentativa de Conexão usando PDO (Boas práticas)
try {
    $conexao = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());
}

// 3. Recebendo os dados do formulário HTML (os names dos inputs)
// o 'if' garante que só vai tentar salvar se o formulário realmente foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_recebido     = $_POST['nome'];
    $email_recebido    = $_POST['email'];
    $mensagem_recebida = $_POST['mensagem'];

    // 4. Preparando o comando SQL (O INSERT)
    // Usamos :nome, :email e :mensagem como coringas por segurança
    $sql = "INSERT INTO contatos (nome, email, mensagem) VALUES (:nome, :email, :mensagem)";
    $stmt = $conexao->prepare($sql);

    // 5. Substituindo os coringas pelos dados reais que vieram do formulário
    $stmt->bindParam(':nome',     $nome_recebido);
    $stmt->bindParam(':email',    $email_recebido);
    $stmt->bindParam(':mensagem', $mensagem_recebida);

    // 6. Executando e verificando se deu certo
    if ($stmt->execute()) {
        echo "
        <style>
            * { margin:0; padding:0; box-sizing:border-box; }
            body {
                font-family: Arial, sans-serif;
                min-height: 100vh;
                display: flex; align-items: center; justify-content: center;
                background: linear-gradient(135deg, #0d2144, #1a3a6e);
            }
            .container {
                background: rgba(255,255,255,0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255,255,255,0.2);
                border-radius: 10px;
                padding: 30px;
                text-align: center;
                color: #fff;
            }
            p { color: rgba(255,255,255,0.6); margin: 10px 0 20px; font-size: 13px; }
            a {
                color: rgba(180,220,255,0.8); font-size: 13px;
                margin: 0 8px; text-decoration: none;
            }
            a:hover { color: #fff; }
        </style>
        <div class='container'>
            <h2>✅ Dados salvos!</h2>
            <p>Mensagem registrada no banco de dados.</p>
            <a href='index.html'>← voltar</a>
            <a href='listar.php'>ver mensagens</a>
        </div>";
    } else {
        echo "Erro ao tentar salvar os dados.";
    }
}
?>
