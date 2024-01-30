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

    <div class="shadow p-2">
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

        <div class="row">
            <div class="col">
                <?= $this->Form->button(__('Salvar'), ['class'=>'btn btn-success mb-2']) ?>
            </div>
        </div>
    </div>



    <?= $this->Form->end() ?>
</div>
