<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Professore $professore
 */
?>
<div class="col-md-5 mx-auto">

    <nav class="navbar navbar-light bg-light">
        <h4><i class="fas fa-user-tie"></i><?= __(' Cadastro de Professor') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fas fa-angle-left"></i> Voltar'), ['controller'=>'professores','action' => 'index'], ['class' => 'btn btn-outline-secondary m-1', 'escape'=>false]) ?>
            </li>
        </ul>
    </nav>

    <div class="shadow p-2">
        <?= $this->Form->create($professore) ?>
        <?= $this->Form->control('siape', ['label'=>'SIAPE','class'=>'form-control mb-3 w-25'])?>
        <?= $this->Form->control('nome', ['label'=>'NOME DO PROFESSOR','class'=>'form-control mb-3'])?>
        <?= $this->Form->control('email', ['label'=>'E-MAIL PROFESSOR','class'=>'form-control mb-3'])?>
        <?= $this->Form->button(__('Salvar'), ['class'=>'btn btn-success mb-2']) ?>
        <?= $this->Form->end() ?>
    </div>

</div>
