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

// Verifica se o formulário foi enviado (ajuste o método para POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['id'];  // Recebe o ID do usuário a ser atualizado
  $email = $_POST['email'];
  $senha = $_POST['senha']; // Opcional: se deseja permitir atualização da senha
  $data_nascimento = $_POST['data_nascimento']; // Opcional: se deseja permitir atualização da data de nascimento

  // Verificar se o usuário já existe (opcional, caso não permita atualização do email)
  /*
  $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND id <> ?");
  $stmt->bind_param("si", $email, $id);
  $stmt->execute();
  $result = $stmt->get_result();
  
  if ($result->num_rows > 0) {
    echo "<script>alert('E-mail já existe!');</script>";
    exit;
  }
  */

  // Atualizar usuário
  $stmt = $conn->prepare("UPDATE usuarios SET email = ?, data_nascimento = ? WHERE id = ?");
  $hashed_password = "";  // Se for atualizar a senha, modifique aqui
  if (!empty($senha)) {
    $hashed_password = password_hash($senha, PASSWORD_DEFAULT);
    $stmt->bind_param("ssss", $email, $hashed_password, $data_nascimento, $id);
  } else {
    $stmt->bind_param("sss", $email, $data_nascimento, $id);
  }
  $stmt->execute();

  echo "<script>alert('Usuário atualizado com sucesso!');</script>";
}

// Verifica se o ID do usuário foi passado via GET
$usuarioId = isset($_GET['id']) ? $_GET['id'] : null;

// Buscar informações do usuário (opcional, caso queira pré- preencher o formulário)
if ($usuarioId) {
  $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
  $stmt->bind_param("i", $usuarioId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
  } else {
    echo "Usuário não encontrado.";
    exit;
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
  <title>Atualizar Usuário</title>
</head>
<header>
  <nav>
    <ul>
      <li><a href="logout.php">Sair</a></li>
    </ul>
  </nav>
</header>
<body>
  <h1>Atualizar Usuário</h1>
  <form action="" method="POST">
    <?php if (isset($row)): ?>
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <?php endif; ?>

    <p>
      <label for="email">E-mail</label>
      <input type="text" name="email" id="email" value="<?php echo isset($row) ? $row['email'] : ''; ?>">
    </p>

    <p>
      <label for="senha">Senha</label>
      <input type="password" name="senha" id="senha">
    </p>

    <p>
      <label for="data_nascimento">Data de Nascimento</label>
      <input type="date" name="data_nascimento" id="data_nascimento" value="<?php echo isset($row) ? $row['data_nascimento'] : ''; ?>">
    </p>

    <p>
      <button type="submit">Atualizar</button>
    </p>
  </form>
</body>
</html>