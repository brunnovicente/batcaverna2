<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Monitoria> $monitorias
 */
?>
<div class="monitorias index content">
    <nav class="navbar navbar-light bg-light">
        <h4><i class="fa-solid fa-layer-group"></i><?= __(' Monitorias') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fa-solid fa-plus"></i> Novo'), ['action' => 'add'], ['class' => 'btn btn-sm btn-outline-success', 'escape'=>false]) ?>
                <?= $this->Html->link(__('<i class="fa-solid fa-chevron-left"></i> Voltar'), ['controller'=>'principal', 'action' => 'index'], ['class' => 'ms-2 btn btn-sm btn-outline-secondary float-end', 'escape'=>false]) ?>
            </li>
        </ul>
    </nav>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>DESCRIÇÃO</th>
            <th>CARGA</th>
            <th>PERÍODO</th>
            <th>STATUS</th>
            <th>MONITOR</th>
            <th>SUPERVISOR</th>
            <th>

            </th>
        </tr>
        <?php foreach ($monitorias as $monitoria): ?>
            <tr>
                <td><?= $this->Number->format($monitoria->id) ?></td>
                <td><?= h($monitoria->descricao) ?></td>
                <td><?= $monitoria->carga === null ? '' : $this->Number->format($monitoria->carga) ?></td>
                <td><?= h($monitoria->periodo) ?></td>
                <td><?= $monitoria->status === null ? '' : $this->Number->format($monitoria->status) ?></td>
                <td><?= $monitoria->has('aluno') ? $this->Html->link($monitoria->aluno->nome, ['controller' => 'Alunos', 'action' => 'view', $monitoria->aluno->id]) : '' ?></td>
                <td><?= $monitoria->has('professore') ? $this->Html->link($monitoria->professore->nome, ['controller' => 'Professores', 'action' => 'view', $monitoria->professore->id]) : '' ?></td>
                <td>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
