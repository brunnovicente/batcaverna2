<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Aluno> $alunos
 */
?>
<div class="alunos index content">

    <nav class="navbar navbar-light bg-light">
        <h4><i class="fa-solid fa-user-graduate"></i><?= __(' Alunos') ?></h4>
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
       <tr>
           <th>MATRÍCULA</th>
           <th>NOME</th>
           <th>E-MAIL</th>
           <th>SITUAÇÃO</th>
           <th>CURSO</th>
           <th></th>
       </tr>
       <tbody>
        <?php foreach ($alunos as $aluno): ?>
            <tr>
                <td><?= h($aluno->matricula) ?></td>
                <td><?= h($aluno->nome) ?></td>
                <td><?= h($aluno->email) ?></td>
                <td><?= h($aluno->situacao) ?></td>
                <td><?= $aluno->has('curso') ? $this->Html->link($aluno->curso->sigla, ['controller' => 'Cursos', 'action' => 'view', $aluno->curso->id]) : '' ?></td>
                <td class="">
                    <?php
                        if($aluno->user){
                            if($aluno->user->categoria == 'ALUNO'){
                                echo $this->Html->link(__('<i class="fa-solid fa-key"></i> Promover'), ['controller' => 'users', 'action' => 'promoveraluno', $aluno->id], ['class' => 'btn btn-outline-success btn-sm', 'confirm' => 'Tem certeza que deseja promover ' . $aluno->nome . ' para status de MONITOR?', 'escape' => false]);
                            }else{
                                echo $this->Html->link(__('<i class="fa-solid fa-lock"></i> Revogar'), ['controller' => 'users', 'action' => 'revogaraluno', $aluno->user->id], ['class' => 'btn btn-outline-danger btn-sm', 'confirm' => 'Tem certeza que deseja revogar acesso de ' . $aluno->nome . ' como MONITOR?', 'escape' => false]);
                            }

                        }else{
                            echo $this->Html->link(__('<i class="fa-solid fa-key"></i> Promover'), ['controller' => 'users', 'action' => 'promoveraluno', $aluno->id], ['class' => 'btn btn-outline-success btn-sm', 'confirm' => 'Tem certeza que deseja promover ' . $aluno->nome . ' para status de MONITOR?', 'escape' => false]);
                        }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
