<?php
// Conexão com o banco de dados (ajuste as informações)
include 'pagina_restrita.php';

$username = 'root';
$password = '';
$dbname = 'login';
$servername = 'localhost';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Hash da senha para segurança (recomendado usar um algoritmo mais forte como bcrypt)
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Insere os dados no banco de dados
    $sql = "INSERT INTO usuarios (email, senha) VALUES ('$email', '$senha_hash')";

    if ($conn->query($sql) === TRUE) {
        echo "Novo usuário criado com sucesso";
    } else {
        echo "Erro ao criar usuário: " . $conn->error;
    }
}

// Fecha a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Login</title>
</head>
<header>
    <nav>
        <ul>          
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </nav>
</header>
<body>
    <h1>Cadastro do Funcionário</h1>
    <form action="" method="POST">
        <p>
            <label>E-mail</label>
            <input type="text" name="email">
        </p>
        <p>
            <label>Senha</label>
            <input type="password" name="senha">
        </p>
        <p>
            <button type="submit">Entrar</button>
        </p>
    </form>

    
</body>
<?php
include('footer.php');
?>

</html>