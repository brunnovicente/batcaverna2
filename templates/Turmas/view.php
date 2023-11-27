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
            <?= $this->Html->link(__('Edit Turma'), ['action' => 'edit', $turma->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Turma'), ['action' => 'delete', $turma->id], ['confirm' => __('Are you sure you want to delete # {0}?', $turma->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Turmas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Turma'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="turmas view content">
            <h3><?= h($turma->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nome') ?></th>
                    <td><?= h($turma->nome) ?></td>
                </tr>
                <tr>
                    <th><?= __('Descricao') ?></th>
                    <td><?= h($turma->descricao) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($turma->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ano') ?></th>
                    <td><?= $turma->ano === null ? '' : $this->Number->format($turma->ano) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $turma->status === null ? '' : $this->Number->format($turma->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cursos Id') ?></th>
                    <td><?= $turma->cursos_id === null ? '' : $this->Number->format($turma->cursos_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($turma->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($turma->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
