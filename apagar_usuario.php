<?php
// Conexão com o banco de dados
$username = 'root';
$password = '';
$dbname = 'login';
$servername = 'localhost';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recebe o email do usuário a ser editado pela URL
$email = $_GET['email'];

// Consulta para buscar os dados do usuário
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validação do novo email (adicione mais validações se necessário)
        $novoEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if (!filter_var($novoEmail, FILTER_VALIDATE_EMAIL)) {
            echo "Email inválido.";
            exit;
        }

        // Verifica se o novo email já existe
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $novoEmail);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            echo "Email já cadastrado.";
            exit;
        }

        // Atualiza os dados do usuário
        $sql = "UPDATE usuarios SET email = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $novoEmail, $email);
        $stmt->execute();

        header("Location: listar_usuarios.php"); // Redireciona para a página de listagem
        exit;
    } else {
        // Exibe um formulário para edição
        // ... (restante do código do formulário)
    }
} else {
    echo "Usuário não encontrado.";
}

$conn->close();
?>