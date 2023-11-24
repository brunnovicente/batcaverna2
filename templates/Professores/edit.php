<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Professore $professore
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $professore->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $professore->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Professores'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="professores form content">
            <?= $this->Form->create($professore) ?>
            <fieldset>
                <legend><?= __('Edit Professore') ?></legend>
                <?php
                    echo $this->Form->control('siape');
                    echo $this->Form->control('nome');
                    echo $this->Form->control('email');
                    echo $this->Form->control('users_id', ['options' => $users]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
