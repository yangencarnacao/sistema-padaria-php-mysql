<?php
// Conexão com o banco de dados (ajuste as informações)
include('header.php');

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

    // Consulta o usuário no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verifica se a senha está correta
        if (password_verify($senha, $row['senha'])) {
            // Login bem-sucedido (aqui você pode iniciar uma sessão, por exemplo)
            session_start();
            $_SESSION['usuario_logado'] = true;
            header("Location: administrativo.php");
            exit();
        } else {
            echo "Senha incorreta";
        }
    } else {
        echo "Usuário não encontrado";
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
<body>
    <h1>Acesse sua conta</h1>
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