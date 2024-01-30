<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Professore $professore
 */
?>
<div class="container mx-auto">
    <?= $this->Form->create($professore) ?>
    <nav class="navbar navbar-light bg-light">
        <h4><i class="fas fa-user-tie"></i><?= __(' Cadastro de Professor') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fas fa-angle-left"></i> Voltar'), ['controller'=>'professores','action' => 'index'], ['class' => 'btn btn-outline-secondary m-1', 'escape'=>false]) ?>
            </li>
        </ul>
    </nav>

    <div class="shadow row p-2">

        <div class="col-3">

            <div id="croppie-container">
                <img src="<?= $professore->user->foto ?>" id="foto-autal"/>
            </div>
            <input type="file" id="input-imagem" accept="image/*">

            <div>
                <!-- Preview em tempo real -->
                <img id="preview-container" src=""">
            </div>
        </div>

        <div class="col-9">
            <div class="row">
                <div class="col-sm-3">
                    <?= $this->Form->control('siape', ['label'=>'SIAPE','class'=>'form-control mb-3'])?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?= $this->Form->control('nome', ['label'=>'NOME DO PROFESSOR','class'=>'form-control mb-3'])?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?= $this->Form->control('email', ['label'=>'E-MAIL PROFESSOR','class'=>'form-control mb-3'])?>
                </div>
            </div>
            <div class="row ">
                <div class="col justify-content-end d-flex">
                    <?= $this->Form->button(__('Salvar'), ['class'=>'btn btn-success mb-2']) ?>
                </div>
            </div>
        </div>


    </div>

    <?= $this->Form->end() ?>
</div>

<script>

    var croppie;

    // Função para inicializar o Croppie com a imagem selecionada
    function inicializarCroppie(imagem) {
        var fotoAtual = document.getElementById('foto-autal');
        fotoAtual.remove();
        croppie = new Croppie(document.getElementById('croppie-container'), {
            viewport: { width: 200, height: 200 },
            boundary: { width: 300, height: 300 },
        });

        croppie.bind({
            url: URL.createObjectURL(imagem), // URL.createObjectURL para converter o arquivo de imagem em uma URL de objeto
        });

        croppie.element.addEventListener('update', function (ev) {
            croppie.result('base64').then(function (result) {
                atualizarPreview(result);
            });
        });
    }

    function iniciar(imagem){
        var imagem = document.getElementById('croppie-container')
        imagem.src = imagem;
    }

    // Função para atualizar a outra div (preview) com a imagem recortada
    function atualizarPreview(base64String) {
        document.getElementById('preview-container').src = base64String;
    }

    // Adicionar um ouvinte de evento para o input de imagem
    document.getElementById('input-imagem').addEventListener('change', function (event) {
        var arquivo = event.target.files[0];

        if (arquivo) {
            inicializarCroppie(arquivo);
        }
    });
</script>
