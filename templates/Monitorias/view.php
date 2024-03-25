<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Monitoria $monitoria
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Monitoria'), ['action' => 'edit', $monitoria->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Monitoria'), ['action' => 'delete', $monitoria->id], ['confirm' => __('Are you sure you want to delete # {0}?', $monitoria->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Monitorias'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Monitoria'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="monitorias view content">
            <h3><?= h($monitoria->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Descricao') ?></th>
                    <td><?= h($monitoria->descricao) ?></td>
                </tr>
                <tr>
                    <th><?= __('Periodo') ?></th>
                    <td><?= h($monitoria->periodo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Aluno') ?></th>
                    <td><?= $monitoria->has('aluno') ? $this->Html->link($monitoria->aluno->nome, ['controller' => 'Alunos', 'action' => 'view', $monitoria->aluno->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Professore') ?></th>
                    <td><?= $monitoria->has('professore') ? $this->Html->link($monitoria->professore->nome, ['controller' => 'Professores', 'action' => 'view', $monitoria->professore->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($monitoria->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Carga') ?></th>
                    <td><?= $monitoria->carga === null ? '' : $this->Number->format($monitoria->carga) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $monitoria->status === null ? '' : $this->Number->format($monitoria->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($monitoria->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($monitoria->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
