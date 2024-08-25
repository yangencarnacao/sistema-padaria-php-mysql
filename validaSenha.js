function validarSenha() {
    var senha = document.getElementById("senha").value;
    var min_password_length = 8;
    var error_messages = [];

    if (senha.length < min_password_length) {
        error_messages.push("A senha deve ter no mínimo 8 caracteres.");
    }

    // Outras validações (ex: letras maiúsculas, minúsculas, números, caracteres especiais)
    if (!/[A-Z]/.test(senha)) {
        error_messages.push("A senha deve conter pelo menos uma letra maiúscula.");
    }
    if (!/[a-z]/.test(senha)) {
        error_messages.push("A senha deve conter pelo menos uma letra minúscula.");
    }
    if (!/\d/.test(senha)) {
        error_messages.push("A senha deve conter pelo menos um número.");
    }
    if (!/[^\w\s]/.test(senha)) {
        error_messages.push("A senha deve conter pelo menos um caractere especial.");
    }

    if (error_messages.length > 0) {
        // Exibir as mensagens de erro em uma notificação (você pode usar SweetAlert2 ou outra biblioteca)
        alert(error_messages.join("\n"));
        return false;
    } else {
        // Se não houver erros, pode enviar o formulário
        return true;
    }
}