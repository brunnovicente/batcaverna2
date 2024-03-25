<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Aluno $aluno
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Aluno'), ['action' => 'edit', $aluno->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Aluno'), ['action' => 'delete', $aluno->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aluno->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Alunos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Aluno'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="alunos view content">
            <h3><?= h($aluno->nome) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nome') ?></th>
                    <td><?= h($aluno->nome) ?></td>
                </tr>
                <tr>
                    <th><?= __('Matricula') ?></th>
                    <td><?= h($aluno->matricula) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($aluno->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Situacao') ?></th>
                    <td><?= h($aluno->situacao) ?></td>
                </tr>
                <tr>
                    <th><?= __('Curso') ?></th>
                    <td><?= $aluno->has('curso') ? $this->Html->link($aluno->curso->sigla, ['controller' => 'Cursos', 'action' => 'view', $aluno->curso->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $aluno->has('user') ? $this->Html->link($aluno->user->id, ['controller' => 'Users', 'action' => 'view', $aluno->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($aluno->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($aluno->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($aluno->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
