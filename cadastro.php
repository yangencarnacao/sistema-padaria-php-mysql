<?php
include 'protect.php';





if(isset($_POST['email'])){
    include('conexao.php');
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $query = "INSERT INTO usuarios (email, senha) VALUES ('$email', '$senha')";
    if ($mysqli->query($query)) {
        // Usuário cadastrado com sucesso
        echo '<script>alert("Usuário cadastrado com sucesso!");</script>';
    } else {
        // Erro ao cadastrar o usuário
        echo '<script>alert("Erro ao cadastrar o usuário. Tente novamente mais tarde.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Cadastro de Funcionário</title>
</head>
<header>
    <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
        <img src="logo.svg" alt="Logo Padaria Mama Lucas" class="logo">
    </a>
    <nav>
        <ul>          
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </nav>
</header>
<body>
    <h1>Cadastro o Funcionário</h1>
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
            <button type="submit">Cadastrar</button>
        </p>
    </form>
</body>
<?php
include 'footer.php';
?>
</html>

