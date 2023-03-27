function goPage(pPage) {
    window.location.href = pPage;
}

function setVisible() {
    var oSelect = document.getElementById("tipo-pagamento"),
        oLabel = document.getElementById("lbdescr"),
        oInput = document.getElementById("descricao");

    var vValue = oSelect.value;

    if (vValue == 6) {
        oLabel.classList.remove('hidden');
        oLabel.classList.add('visible');

        oInput.classList.remove('hidden');
        oInput.classList.add('visible');
    } else {
        oLabel.classList.remove('visible');
        oLabel.classList.add('hidden');

        oInput.classList.remove('visible');
        oInput.classList.add('hidden');

        oInput.value = "";
    }
}

function getDate() {
    var vData = new Date();

    return vData;
}