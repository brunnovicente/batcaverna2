<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Turma $turma
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $turma->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $turma->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Turmas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="turmas form content">
            <?= $this->Form->create($turma) ?>
            <fieldset>
                <legend><?= __('Edit Turma') ?></legend>
                <?php
                    echo $this->Form->control('nome');
                    echo $this->Form->control('descricao');
                    echo $this->Form->control('ano');
                    echo $this->Form->control('status');
                    echo $this->Form->control('cursos_id');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
