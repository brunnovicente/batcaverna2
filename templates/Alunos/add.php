<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Aluno $aluno
 * @var \Cake\Collection\CollectionInterface|string[] $cursos
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="container mx-auto">

    <nav class="navbar navbar-light bg-light">
        <h4><i class="fas fa-user-tie"></i><?= __(' Cadastro de Aluno') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fas fa-angle-left"></i> Voltar'), ['controller'=>'alunos','action' => 'index'], ['class' => 'btn btn-outline-secondary m-1', 'escape'=>false]) ?>
            </li>
        </ul>
    </nav>

    <div class="row shadow p-2">
        <?= $this->Form->create($aluno) ?>

        <div class="row">
            <div class="col-sm-3">
                <?= $this->Form->control('matricula', ['label'=>'MATRICULA','class'=>'form-control mb-3'])?>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <?= $this->Form->control('nome', ['label'=>'NOME','class'=>'form-control mb-3'])?>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <?= $this->Form->control('email', ['label'=>'E-MAIL','class'=>'form-control mb-3'])?>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <?= $this->Form->control('cursos_id', ['class'=>'form-select w-50', 'options' => $cursos])?>
            </div>
        </div>

        <?= $this->Form->button(__('Salvar'), ['class'=>'btn btn-success mt-2']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
