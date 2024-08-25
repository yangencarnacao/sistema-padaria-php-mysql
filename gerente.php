<!DOCTYPE html>
<html>
<head>
    <title>Gestão Funcionários</title>
</head>
<body>

<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para buscar todos os usuários (adapte a consulta conforme sua tabela)
$sql = "SELECT id,  email FROM usuarios";
$result = $conn->query($sql);

// Criar o dropdownlist
echo "<select name='usuario' id='usuario'>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["id"] . "'>" . $row["email"] . "</option>";
    }
} else {
    echo "<option value=''>Nenhum usuário encontrado</option>";
}
echo "</select>";

$conn->close();
?>

<button id="editar">Editar</button>
<button id="apagar">Apagar</button>

<script>
document.getElementById('usuario').addEventListener('change', function() {
    var usuarioSelecionado = this.value;
    // Armazena o ID do usuário selecionado em um campo oculto para envio ao servidor
    document.getElementById('usuarioId').value = usuarioSelecionado;
});

document.getElementById('editar').addEventListener('click', function() {
    // Envia os dados para um arquivo PHP que processa a edição
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'editar_usuario.php';
    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'usuarioId';
    input.value = document.getElementById('usuarioId').value;
    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
});

document.getElementById('apagar').addEventListener('click', function() {
    // Confirmação de exclusão
    if (confirm("Tem certeza que deseja apagar o usuário?")) {
        // Envia os dados para um arquivo PHP que processa a exclusão
        // ... (código similar ao botão de editar)
    }
});
</script>

<input type="hidden" id="usuarioId">
</body>
</html>