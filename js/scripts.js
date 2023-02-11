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

function dataHoraCorrida() {
    const dataAtual = new Date();
    const horaAtual = new Date();

    const dia = dataAtual.getDate();
    const mes = dataAtual.getMonth() + 1;
    const ano = dataAtual.getFullYear();
    const hora = horaAtual.getHours();
    const minutos = horaAtual.getMinutes();

    const dataFormatada = `${dia.toString().padStart(2, '0')}/${mes.toString().padStart(2, '0')}/${ano}`;
    const horaFormatada = `${hora.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}`;

    document.getElementById('data').value = dataFormatada;
    document.getElementById('hora').value = horaFormatada;
}

function gravarData() {
    const data = document.getElementById('data').value;
    const [dia, mes, ano] = data.split('/');
    const dataFormatada = `${ano}-${mes}-${dia}`;
    localStorage.setItem('data', dataFormatada);
}