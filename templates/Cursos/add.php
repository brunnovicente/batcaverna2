<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Curso $curso
 * @var \Cake\Collection\CollectionInterface|string[] $professores
 */
?>
<div class="row">

    <nav class="navbar navbar-light bg-light">
        <h4><i class="fa-solid fa-graduation-cap"></i><?= __(' Cadastro Cursos') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fa-solid fa-chevron-left"></i> Voltar'), ['controller'=>'cursos', 'action' => 'index'], ['class' => 'mx-2 btn btn-sm btn-outline-secondary float-end', 'escape'=>false]) ?>
            </li>
        </ul>
    </nav>

    <div class="shadow mx-auto w-50">
        <?= $this->Form->create($curso) ?>
        <fieldset>
            <legend><?= __('Dados do Curso') ?></legend>
            <?php
            echo $this->Form->control('descricao', ['class'=>'form-control mb-2']);
            echo $this->Form->control('sigla', ['class'=>'form-control mb-2']);
            echo $this->Form->control('professores_id', ['class'=>'form-select mb-2','options' => $professores, 'label'=>'COORDENADOR', 'empty' => true]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Salvar'), ['class'=>'btn btn-success my-2']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
