<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Monitoria $monitoria
 * @var \Cake\Collection\CollectionInterface|string[] $alunos
 * @var \Cake\Collection\CollectionInterface|string[] $professores
 */
?>
<div class="container mx-auto">
    <nav class="navbar navbar-light bg-light">
        <h4><i class="fa-solid fa-person-shelter"></i><?= __(' Cadastro de Monitoria') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fas fa-angle-left"></i> Voltar'), ['controller'=>'monitorias','action' => 'index'], ['class' => 'btn btn-outline-secondary m-1', 'escape'=>false]) ?>
            </li>
        </ul>
    </nav>
    <div class="row shadow p-2">
        <?= $this->Form->create($monitoria) ?>

        <div class="row">
            <div class="col">
                <?= $this->Form->control('descricao', ['label'=>'DESCRIÇÃO DA MONITORIA (Qual Laboratório?)','class'=>'form-control mb-3'])?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <?= $this->Form->control('carga', ['label'=>'CARGA HORÁRIA','class'=>'form-control mb-3'])?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <?= $this->Form->control('periodo', ['label'=>'QUAL SEMESTRE LETIVO?','class'=>'form-control mb-3'])?>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <?= $this->Form->control('alunos_id', ['label'=>'ALUNO MONITOR','class'=>'form-select mb-3', 'options' => $alunos, 'empty' => true])?>
            </div>
        </div>

        <?= $this->Form->button(__('Salvar'), ['class'=>'btn btn-success mt-3']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
