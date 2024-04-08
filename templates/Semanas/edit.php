<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Semana $semana
 * @var \Cake\Collection\CollectionInterface|string[] $monitorias
 */
?>
<div class="container mx-auto">
    <nav class="navbar navbar-light bg-light">
        <h4><i class="fa-solid fa-calendar-week"></i><?= __(' Editar Semana') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fas fa-angle-left"></i> Voltar'), ['controller'=>'semanas','action' => 'index', $semana->monitorias_id], ['class' => 'btn btn-outline-secondary m-1', 'escape'=>false]) ?>
            </li>
        </ul>
    </nav>
    <div class="row shadow p-2">
        <?= $this->Form->create($semana) ?>

        <div class="row">
            <div class="col-sm-10">
                <?= $this->Form->control('descricao', ['label'=>'DESCRIÇÃO','class'=>'form-control mb-3'])?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->control('carga', ['label'=>'CARGA HORÁRIA','class'=>'form-control mb-3'])?>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-3">
                <?= $this->Form->control('inicio', ['label'=>'INÍCIO','class'=>'form-control mb-3'])?>
            </div>
            <div class="col-sm-3">
                <?= $this->Form->control('fim', ['label'=>'FIM','class'=>'form-control mb-3'])?>
            </div>
        </div>

        <?= $this->Form->button(__('Salvar'), ['class'=>'btn btn-success mt-2']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
