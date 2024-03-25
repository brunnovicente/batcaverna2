<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Aluno $aluno
 * @var string[]|\Cake\Collection\CollectionInterface $cursos
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $aluno->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $aluno->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Alunos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="alunos form content">
            <?= $this->Form->create($aluno) ?>
            <fieldset>
                <legend><?= __('Edit Aluno') ?></legend>
                <?php
                    echo $this->Form->control('nome');
                    echo $this->Form->control('matricula');
                    echo $this->Form->control('email');
                    echo $this->Form->control('situacao');
                    echo $this->Form->control('cursos_id', ['options' => $cursos]);
                    echo $this->Form->control('users_id', ['options' => $users, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
