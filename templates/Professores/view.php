<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Professore $professore
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Professore'), ['action' => 'edit', $professore->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Professore'), ['action' => 'delete', $professore->id], ['confirm' => __('Are you sure you want to delete # {0}?', $professore->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Professores'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Professore'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="professores view content">
            <h3><?= h($professore->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nome') ?></th>
                    <td><?= h($professore->nome) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($professore->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $professore->has('user') ? $this->Html->link($professore->user->id, ['controller' => 'Users', 'action' => 'view', $professore->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($professore->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Siape') ?></th>
                    <td><?= $professore->siape === null ? '' : $this->Number->format($professore->siape) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($professore->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($professore->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
