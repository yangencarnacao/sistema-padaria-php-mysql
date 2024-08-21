<?php
session_start();

if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] !== true) {
    header("Location: protect.php");

    exit();
}

// Conteúdo da página restrita
echo "Bem-vindo, você está logado!";
?>