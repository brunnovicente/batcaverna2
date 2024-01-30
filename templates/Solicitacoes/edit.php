<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitaco $solicitaco
 * @var string[]|\Cake\Collection\CollectionInterface $diarios
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $solicitaco->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $solicitaco->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Solicitacoes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="solicitacoes form content">
            <?= $this->Form->create($solicitaco) ?>
            <fieldset>
                <legend><?= __('Edit Solicitaco') ?></legend>
                <?php
                    echo $this->Form->control('data', ['empty' => true]);
                    echo $this->Form->control('dia');
                    echo $this->Form->control('horarios');
                    echo $this->Form->control('justificativa');
                    echo $this->Form->control('tipo');
                    echo $this->Form->control('status');
                    echo $this->Form->control('registro');
                    echo $this->Form->control('diarios_id', ['options' => $diarios]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
