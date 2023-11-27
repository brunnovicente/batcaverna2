<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Curso $curso
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Curso'), ['action' => 'edit', $curso->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Curso'), ['action' => 'delete', $curso->id], ['confirm' => __('Are you sure you want to delete # {0}?', $curso->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Cursos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Curso'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="cursos view content">
            <h3><?= h($curso->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Descricao') ?></th>
                    <td><?= h($curso->descricao) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sigla') ?></th>
                    <td><?= h($curso->sigla) ?></td>
                </tr>
                <tr>
                    <th><?= __('Professore') ?></th>
                    <td><?= $curso->has('professore') ? $this->Html->link($curso->professore->id, ['controller' => 'Professores', 'action' => 'view', $curso->professore->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($curso->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($curso->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($curso->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
