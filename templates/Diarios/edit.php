<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Diario $diario
 * @var string[]|\Cake\Collection\CollectionInterface $turmas
 * @var string[]|\Cake\Collection\CollectionInterface $professores
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $diario->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $diario->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Diarios'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="diarios form content">
            <?= $this->Form->create($diario) ?>
            <fieldset>
                <legend><?= __('Edit Diario') ?></legend>
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
