// Configurar o Croppie
var croppie = new Croppie(document.getElementById('previewFoto'), {
    viewport: { width: 300, height: 300 },
    boundary: { width: 350, height: 350 },
});

// Manipular a seleção de arquivo
document.getElementById('inputFoto').addEventListener('change', function () {
    var input = this;
    var reader = new FileReader();
    var fotofinal = document.getElementById('foto-final');

    reader.onload = function (e) {
        // Carregar a imagem no Croppie para pré-visualização
        croppie.bind({
            url: e.target.result,
        })
    };

    // Ler o conteúdo do arquivo selecionado
    reader.readAsDataURL(input.files[0]);

});

// Função para recortar a foto
function recortarFoto() {
    var fotofinal = document.getElementById('foto-final');
    croppie.result('base64').then(function (result) {
        // 'result' contém a imagem recortada em formato base64
        //console.log(result);
        fotofinal.src = result;
        // Aqui você pode enviar 'result' para o servidor ou fazer o que precisar
    });
}

function fecharModal() {
    alert('Fechando...')
    var meuModal = new bootstrap.Modal(document.getElementById('modalImagem'));
    meuModal.hide();
}
