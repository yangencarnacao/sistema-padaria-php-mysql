

function sanitizeInput(input) {
  // Remove tags HTML e escapa caracteres especiais
  return DOMPurify.sanitize(input, { ALLOWED_TAGS: [] });
}

document.getElementById("cep").addEventListener("input", consultarCEP);

async function consultarCEP() {
    const cepInput = document.getElementById("cep");
    const cep = cepInput.value.replace(/\D/g, ''); // Remove caracteres não numéricos

    try {
        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const data = await response.json();

        if (data.erro) {
            console.error("CEP não encontrado.");
            // Trate o erro conforme sua necessidade
        } else {
            console.log("Dados do endereço:", data);
            document.getElementById("logradouro").value = data.logradouro;
            document.getElementById("bairro").value = data.bairro;
            document.getElementById("cidade").value = data.localidade;

        }
    } catch (error) {
        console.error("Erro ao consultar o CEP:", error);
    }
}

document.getElementById("contact-form").addEventListener("submit", function (event) {
  event.preventDefault();

  // Sanitização e validação dos dados
  const nome = sanitizeInput(document.getElementById("nome").value);
  const cep = sanitizeInput(document.getElementById("cep").value);
  const logradouro = sanitizeInput(document.getElementById("logradouro").value);
  const bairro = sanitizeInput(document.getElementById("bairro").value);
  const numero = sanitizeInput(document.getElementById("numero").value);
  const complemento = sanitizeInput(document.getElementById("complemento").value);
  const mensagem = sanitizeInput(document.getElementById("mensagem").value);

  // Validação do CEP e número
  if (!/^\d+$/.test(cep)) {
    alert("Por favor, insira um CEP válido (apenas números).");
    return;
  }

  if (!/^\d+$/.test(numero)) {
    alert("Por favor, insira um NÚMERO válido (apenas números).");
    return;
  }

  // Cria a mensagem para o WhatsApp com os dados sanitizados e codificados
  const mensagemWhatsApp = `Cliente: ${encodeURIComponent(nome)}%0AEndereço: ${encodeURIComponent(logradouro)}, ${encodeURIComponent(bairro)}, ${encodeURIComponent(numero)}, ${encodeURIComponent(complemento)}, ${encodeURIComponent(cep)}%0AComplemento/Ponto de Referência: ${encodeURIComponent(complemento)}%0APedido: ${encodeURIComponent(mensagem)}`;

  // Abre a tela do WhatsApp
  window.open(`https://api.whatsapp.com/send?phone=+5521982533483&text=${mensagemWhatsApp}`, '_blank');
});
