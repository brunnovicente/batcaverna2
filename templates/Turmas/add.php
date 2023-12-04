<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Turma $turma
 */
?>
<div class="row">
    <nav class="navbar navbar-light bg-light">
        <h4><i class="fa-solid fa-layer-group"></i><?= __(' Cadastro de Turma') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fa-solid fa-chevron-left"></i> Voltar'), ['controller'=>'turmas', 'action' => 'index'], ['class' => 'mx-2 btn btn-sm btn-outline-secondary float-end', 'escape'=>false]) ?>
            </li>
        </ul>
    </nav>

    <div class="shadow mx-auto w-50">
        <?= $this->Form->create($turma) ?>
        <fieldset>
            <legend><?= __('Dados da Turma') ?></legend>
            <?php
            echo $this->Form->control('nome', ['class'=>'form-control mb-3', 'label'=>'NOME']);
            echo $this->Form->control('descricao', ['class'=>'form-control mb-3', 'label'=>'DESCRIÇÃO']);
            echo $this->Form->control('ano', ['class'=>'form-control w-25 mb-3', 'label'=>'ANO']);
            echo $this->Form->control('cursos_id', ['class'=>'form-select w-25 mb-3', 'label'=>'CURSO','options' => $cursos,]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Salvar'), ['class'=>'btn btn-success my-2']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
