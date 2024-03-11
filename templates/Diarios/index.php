<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Turma> $turmas
 */
?>
<div>
    <nav class="navbar navbar-light bg-light">
        <h4><i class="fa-solid fa-book"></i><?= __(' Diários') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fa-solid fa-plus"></i> Novo'), ['action' => 'add'], ['class' => 'btn btn-sm btn-outline-success', 'escape'=>false]) ?>
                <?= $this->Html->link(__('<i class="fa-solid fa-chevron-left"></i> Voltar'), ['controller'=>'principal', 'action' => 'index'], ['class' => 'ms-2 btn btn-sm btn-outline-secondary float-end', 'escape'=>false]) ?>
            </li>
        </ul>
    </nav>

    <div class="bg-light p-2 ">
        <?= $this->Form->create()?>
        <?php echo $this->Form->control('nome', ['class'=>'form-control my-2 w-25', 'label'=>'Busca por Professor ou Descrição']);?>
        <?= $this->Form->end()?>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>CÓDIGO</th>
            <th>DESCRIÇÃO</th>
            <th>TURMA</th>
            <th>CURSO</th>
            <th>PROFESSOR</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($diarios as $diario): ?>
            <tr>

                <td><?= h($diario->codigo) ?></td>
                <td><?= h($diario->descricao) ?></td>
                <td><?= $diario->turma->descricao ?></td>
                <td><?= $diario->turma->curso->descricao ?></td>
                <td><?= $diario->professore->nome ?></td>


                <td class="actions">
                    <?= $this->Html->link(__('<i class="fas fa-unlock"></i> Solicitar'), ['controller'=>'solicitacoes','action' => 'add', $diario->id],['class'=>'btn btn-outline-dark btn-sm m-1', 'escape'=>false]) ?>
                    <?= $this->Html->link(__('<i class="fa-solid fa-pen-to-square"></i> Editar'), ['action' => 'edit', $diario->id], ['class'=>'btn btn-sm btn-outline-primary', 'escape'=>false]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
