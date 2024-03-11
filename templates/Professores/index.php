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
            <th>CATEGORIA</th>
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
                    <?php if($professore->user->categoria == 'SUPREMO'): ?>
                        <span class="badge text-bg-danger">Supremo</span>
                    <?php else:?>
                        <?php if($professore->user->categoria == 'COORDENADOR'):?>
                            <span class="badge text-bg-success">Coordenador</span>
                        <?php else:?>
                            Professor
                        <?php endif;?>
                    <?php endif;?>
                </td>

                <td class="actions">
                    <?php
                        if($professore->user->categoria == 'PROFESSOR'){
                            echo $this->Html->link(__('<i class="fa-solid fa-key"></i> Promover'), ['controller'=>'users','action' => 'coordenar', $professore->user->id],['class'=>'btn btn-outline-success btn-sm', 'confirm'=>'Tem certeza que deseja promover '.$professore->nome.' para status de COORDENADOR?', 'escape'=>false]);
                        }else{
                            echo $this->Html->link(__('<i class="fa-solid fa-lock"></i> Revogar'), ['controller'=>'users','action' => 'revogar', $professore->user->id],['class'=>'btn btn-outline-danger btn-sm', 'confirm'=>'Tem certeza que deseja revogar acesso de '.$professore->nome.' como COORDENADOR?', 'escape'=>false]);
                        }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
