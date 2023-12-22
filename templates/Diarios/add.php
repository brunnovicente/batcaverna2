<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Diario $diario
 * @var \Cake\Collection\CollectionInterface|string[] $turmas
 * @var \Cake\Collection\CollectionInterface|string[] $professores
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Diarios'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="diarios form content">
            <?= $this->Form->create($diario) ?>
            <fieldset>
                <legend><?= __('Add Diario') ?></legend>
                <?php
                    echo $this->Form->control('codigo');
                    echo $this->Form->control('descricao');
                    echo $this->Form->control('link');
                    echo $this->Form->control('status');
                    echo $this->Form->control('turmas_id', ['options' => $turmas]);
                    echo $this->Form->control('professores_id', ['options' => $professores]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
