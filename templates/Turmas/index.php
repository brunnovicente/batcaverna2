<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Turma> $turmas
 */
?>
<div>
    <nav class="navbar navbar-light bg-light">
        <h4><i class="fa-solid fa-layer-group"></i><?= __(' Turmas') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fa-solid fa-plus"></i> Novo'), ['action' => 'add'], ['class' => 'btn btn-sm btn-outline-success', 'escape'=>false]) ?>
                <?= $this->Html->link(__('<i class="fa-solid fa-chevron-left"></i> Voltar'), ['controller'=>'principal', 'action' => 'index'], ['class' => 'ms-2 btn btn-sm btn-outline-secondary float-end', 'escape'=>false]) ?>
            </li>
        </ul>
    </nav>

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
                    <?= $this->Html->link(__('<i class="fa-solid fa-pen-to-square"></i> Editar'), ['action' => 'edit', $turma->id], ['class'=>'btn btn-sm btn-outline-primary', 'escape'=>false]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
