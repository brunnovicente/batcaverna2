<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Diario> $diarios
 */
?>
<div class="diarios index content">
    <?= $this->Html->link(__('New Diario'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Diarios') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('codigo') ?></th>
                    <th><?= $this->Paginator->sort('descricao') ?></th>
                    <th><?= $this->Paginator->sort('link') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('turmas_id') ?></th>
                    <th><?= $this->Paginator->sort('professores_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($diarios as $diario): ?>
                <tr>
                    <td><?= $this->Number->format($diario->id) ?></td>
                    <td><?= $diario->codigo === null ? '' : $this->Number->format($diario->codigo) ?></td>
                    <td><?= h($diario->descricao) ?></td>
                    <td><?= h($diario->link) ?></td>
                    <td><?= $diario->status === null ? '' : $this->Number->format($diario->status) ?></td>
                    <td><?= h($diario->created) ?></td>
                    <td><?= h($diario->modified) ?></td>
                    <td><?= $diario->has('turma') ? $this->Html->link($diario->turma->id, ['controller' => 'Turmas', 'action' => 'view', $diario->turma->id]) : '' ?></td>
                    <td><?= $diario->has('professore') ? $this->Html->link($diario->professore->nome, ['controller' => 'Professores', 'action' => 'view', $diario->professore->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $diario->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $diario->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $diario->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diario->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
