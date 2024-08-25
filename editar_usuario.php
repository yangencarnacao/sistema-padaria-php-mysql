<?php
// Conexão com o banco de dados (ajuste as credenciais)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Receber o ID do usuário a ser editado
$usuarioId = $_POST['id']; // Assumindo que o ID é passado via GET

// Buscar as informações do usuário
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $usuarioId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Formulário para edição
    echo "<h2>Editar Usuário</h2>";
    echo "<form method='post' action='atualizar_usuario.php'>";
    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
    echo "<label for='nome'>Nome:</label>";
    echo "<input type='text' name='nome' value='" . $row['nome'] . "' required><br>";
    echo "<label for='email'>Email:</label>";
    echo "<input type='email' name='email' value='" . $row['email'] . "' required><br>";
    // Adicione aqui outros campos que você deseja editar
    echo "<button type='submit'>Salvar</button>";
    echo "</form>";
} else {
    echo "Usuário não encontrado.";
}

$conn->close();
?>