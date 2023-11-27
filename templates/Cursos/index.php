<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Curso> $cursos
 */
?>
<div class="">


    <nav class="navbar navbar-light bg-light">
        <h4><i class="fa-solid fa-graduation-cap"></i><?= __(' Cursos') ?></h4>
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
            <th>SIGLA</th>
            <th>DESCRIÇÃO</th>
            <th>COORDENADOR</th>
            <th></th>
        </tr>


        <?php foreach ($cursos as $curso): ?>
            <tr>
                <td><?= $this->Number->format($curso->id) ?></td>
                <td><?= h($curso->sigla) ?></td>
                <td><?= h($curso->descricao) ?></td>
                <td><?= $curso->has('professore') ? $this->Html->link($curso->professore->nome, ['controller' => 'Professores', 'action' => 'view', $curso->professore->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<i class="fa-solid fa-pen-to-square"></i> Editar'), ['action' => 'edit', $curso->id], ['class'=>'btn btn-sm btn-outline-primary', 'escape'=>false]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
