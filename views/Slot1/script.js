
let maxValor = document.getElementById("ganho_input").value;
let contador = 0.00;

// Função para formatar como moeda brasileira
function formatarMoeda(valor) {
    return valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
}
let body2 = document.getElementById("body");
body2.addEventListener("click", function(){
    document.getElementById("win").style.display = "none";
});

// Função para atualizar o contador
function atualizarContador() {
    document.getElementById('win').style.display = "flex";
    if (contador <= maxValor) {
        document.getElementById('contador').innerText = formatarMoeda(contador);
        contador += 0.20;
        setTimeout(atualizarContador, 0.1); // Atualiza a cada 10 milissegundos
    } 
}
function remover(){
    document.getElementById("win").style.display = "none";
}
function body(){
    document.getElementById("win").style.display = "none";
}

