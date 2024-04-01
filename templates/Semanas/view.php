<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Semana $semana
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Semana'), ['action' => 'edit', $semana->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Semana'), ['action' => 'delete', $semana->id], ['confirm' => __('Are you sure you want to delete # {0}?', $semana->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Semanas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Semana'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="semanas view content">
            <h3><?= h($semana->descricao) ?></h3>
            <table>
                <tr>
                    <th><?= __('Descricao') ?></th>
                    <td><?= h($semana->descricao) ?></td>
                </tr>
                <tr>
                    <th><?= __('Monitoria') ?></th>
                    <td><?= $semana->has('monitoria') ? $this->Html->link($semana->monitoria->id, ['controller' => 'Monitorias', 'action' => 'view', $semana->monitoria->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($semana->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Carga') ?></th>
                    <td><?= $this->Number->format($semana->carga) ?></td>
                </tr>
                <tr>
                    <th><?= __('Inicio') ?></th>
                    <td><?= h($semana->inicio) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fim') ?></th>
                    <td><?= h($semana->fim) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($semana->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($semana->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
