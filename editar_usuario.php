<?php
// Conexão com o banco de dados (ajuste as informações)

$username = 'root';
$password = '';
$dbname = 'login';
$servername = 'localhost';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

include 'pagina_restrita.php';


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

    // Exibe um formulário para edição
    echo "<h2>Editar Usuário</h2>";
    echo "<form action='' method='post'>";
    echo "<label for='email'>Email:</label>";
    echo "<input type='email' name='email' value='" . $row['email'] . "'><br>";
    // Adicione aqui outros campos que você deseja editar
    echo "<input type='submit' value='Salvar'>";
    echo "</form>";
} else {
    echo "Usuário não encontrado.";
}

// Se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Atualiza os dados do usuário no banco de dados
    $novoEmail = $_POST['email'];

    $sql = "UPDATE usuarios SET email = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $novoEmail, $email);
    $stmt->execute();

    echo "Usuário atualizado com sucesso!";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
</body>
</html>