<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Professore> $professores
 */
?>
<div class="">

    <nav class="navbar navbar-light bg-light">
        <h4><i class="fas fa-user-tie"></i><?= __(' Professores') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fas fa-plus-circle"></i> Cadastrar'), ['action' => 'add'], ['class' => 'btn btn-outline-success m-1 text-decoration-none', 'escape'=>false]) ?>
                <?= $this->Html->link(__('<i class="fas fa-angle-left"></i> Voltar'), ['controller'=>'principal','action' => 'index'], ['class' => 'btn btn-outline-secondary m-1', 'escape'=>false]) ?>
            </li>
        </ul>
    </nav>
    <div class="bg-light p-2 ">
        <?= $this->Form->create()?>
        <?php echo $this->Form->control('nome', ['class'=>'form-control my-2 w-25', 'label'=>'Busca por Nome']);?>
        <?= $this->Form->end()?>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>SIAPE</th>
            <th>NOME</th>
            <th>E-MAIL</th>
            
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($professores as $professore): ?>
            <tr>
                <td><?= $professore->id ?></td>
                <td><?= $professore->siape ?></td>
                <td><?= h($professore->nome) ?></td>
                <td><?= h($professore->email) ?></td>

                <td class="actions">
                    <?= $this->Html->link(__(' Abrir'), ['action' => 'view', $professore->id],['class'=>'btn btn-outline-secondary btn-sm']) ?>
                    <?= $this->Html->link(__(' Editar'), ['action' => 'edit', $professore->id],['class'=>'btn btn-outline-primary btn-sm']) ?>
                    <?= $this->Form->postLink(__(' Desvincular'), ['action' => 'delete', $professore->id], ['class'=>'btn btn-outline-danger btn-sm','confirm' => __('Are you sure you want to delete # {0}?', $professore->id)]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
