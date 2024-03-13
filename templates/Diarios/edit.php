
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Turma $turma
 */
?>
<div class="row">
    <nav class="navbar navbar-light bg-light">
        <h4><i class="fa-solid fa-book"></i><?= __(' Editar de Diário') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fa-solid fa-chevron-left"></i> Voltar'), ['controller'=>'diarios', 'action' => 'index'], ['class' => 'mx-2 btn btn-sm btn-outline-secondary float-end', 'escape'=>false]) ?>
            </li>
        </ul>
    </nav>

    <div class="shadow mx-auto w-50">
        <?= $this->Form->create($diario) ?>
        <fieldset>
            <legend><?= __('Dados da Turma') ?></legend>
            <?php
            echo $this->Form->control('codigo', ['class'=>'form-control mb-3', 'label'=>'CÓDIGO']);
            echo $this->Form->control('descricao', ['class'=>'form-control mb-3', 'label'=>'DESCRIÇÃO']);
            echo $this->Form->control('turmas_id', ['class'=>'form-select w-50 mb-3','label'=>'TURMA','options' => $turmas]);
            echo $this->Form->control('professores_id', ['class'=>'form-select w-75 mb-3','label'=>'PROFESSOR','options' => $professores]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Salvar'), ['class'=>'btn btn-success my-2']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
