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
            <th>SIAPE</th>
            <th>NOME</th>
            <th>E-MAIL</th>
            <th>STATUS</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($professores as $professore): ?>
            <tr>
                <td><?= $professore->siape ?></td>
                <td><?= h($professore->nome) ?></td>
                <td><?= h($professore->email) ?></td>

                <td>
                    <?php if($professore->user->status == 1): ?>
                        <span class="badge text-bg-success">Ativo</span>
                    <?php else:?>
                        <span class="badge text-bg-warning">Ativo</span>
                    <?php endif;?>
                </td>

                <td class="actions">
                    <?php
                        if($professore->user->status == 0){
                            echo $this->Html->link(__('<i class="fa-solid fa-key"></i> Acesso'), ['controller'=>'users','action' => 'acesso', $professore->user->id],['class'=>'btn btn-outline-success btn-sm', 'confirm'=>'Tem certeza que deseja ativar '.$professore->nome, 'escape'=>false]);
                        }else{
                            echo $this->Html->link(__(' Desativar'), ['action' => 'desativar', $professore->id],['class'=>'btn btn-outline-danger btn-sm', 'confirm'=>'Tem certeza que deseja desativar '.$professore->nome]);
                        }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
