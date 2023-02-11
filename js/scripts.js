const nomeUsuario = localStorage.getItem("nomeUsuario");
const boasVindas = document.getElementById("boas-vindas");
boasVindas.innerHTML = `Bem-vindo(a), ${nomeUsuario}!`;


const defaultUser = {
    username: 'admin',
    password: 'admin'
};
const loginForm = document.getElementById('login-form');

loginForm.addEventListener('submit', function (event) {
    event.preventDefault();

    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');

    const username = usernameInput.value;
    const password = passwordInput.value;

    if (username === defaultUser.username && password === defaultUser.password) {
        window.location.href = 'cadastro.html';
    } else {
        alert('Nome de usuário ou senha incorretos');
    }
});

function salvarDados() {
    const data = document.getElementById("data").value;
    const hora = document.getElementById("hora").value;
    const tipoPagamento = document.getElementById("tipo-pagamento").value;
    const valorCobrado = document.getElementById("valor-cobrado").value;

    const corrida = {
        data: data,
        hora: hora,
        tipoPagamento: tipoPagamento,
        valorCobrado: valorCobrado,
    };

    let corridas = localStorage.getItem("corridas");
    if (!corridas) {
        corridas = [];
    } else {
        corridas = JSON.parse(corridas);
    }

    corridas.push(corrida);
    localStorage.setItem("corridas", JSON.stringify(corridas));
}

const dataHoraAtual = new Date();