<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Turma> $turmas
 */
?>
<div class="turmas index content">
    <?= $this->Html->link(__('New Turma'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Turmas') ?></h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>CÓDIGO</th>
            <th>DESCRIÇÃO</th>
            <th>ANO</th>
            <th>STATUS</th>
            <th>CURSO</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($turmas as $turma): ?>
            <tr>
                <td><?= $this->Number->format($turma->id) ?></td>
                <td><?= h($turma->nome) ?></td>
                <td><?= h($turma->descricao) ?></td>
                <td><?= $turma->ano ?></td>
                <td><?= $turma->status ?></td>
                <td><?= $turma->curso->descricao ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $turma->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $turma->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $turma->id], ['confirm' => __('Are you sure you want to delete # {0}?', $turma->id)]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
