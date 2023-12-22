<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Diario $diario
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Diario'), ['action' => 'edit', $diario->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Diario'), ['action' => 'delete', $diario->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diario->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Diarios'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Diario'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="diarios view content">
            <h3><?= h($diario->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Descricao') ?></th>
                    <td><?= h($diario->descricao) ?></td>
                </tr>
                <tr>
                    <th><?= __('Link') ?></th>
                    <td><?= h($diario->link) ?></td>
                </tr>
                <tr>
                    <th><?= __('Turma') ?></th>
                    <td><?= $diario->has('turma') ? $this->Html->link($diario->turma->id, ['controller' => 'Turmas', 'action' => 'view', $diario->turma->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Professore') ?></th>
                    <td><?= $diario->has('professore') ? $this->Html->link($diario->professore->nome, ['controller' => 'Professores', 'action' => 'view', $diario->professore->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($diario->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Codigo') ?></th>
                    <td><?= $diario->codigo === null ? '' : $this->Number->format($diario->codigo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $diario->status === null ? '' : $this->Number->format($diario->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($diario->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($diario->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
