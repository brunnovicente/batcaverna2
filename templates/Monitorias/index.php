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
            <th>PERÍODO</th>
            <th>MONITOR</th>
            <th>SUPERVISOR</th>
            <th>STATUS</th>
            <th>

            </th>
        </tr>
        <?php foreach ($monitorias as $monitoria): ?>
            <tr>
                <td><?= $this->Number->format($monitoria->id) ?></td>
                <td><?= h($monitoria->descricao) ?></td>
                <td><?= h($monitoria->periodo) ?></td>

                <td><?= $monitoria->has('aluno') ? $this->Html->link($monitoria->aluno->nome, ['controller' => 'Alunos', 'action' => 'view', $monitoria->aluno->id]) : '' ?></td>
                <td><?= $monitoria->has('professore') ? $this->Html->link($monitoria->professore->nome, ['controller' => 'Professores', 'action' => 'view', $monitoria->professore->id]) : '' ?></td>
                <td>
                    <?php
                    if($monitoria->status == 1){
                        echo 'Ativa';
                    }else{
                        echo 'Encerrada';
                    }
                    ?>
                </td>
                <td>
                    <?php if($user['categoria'] != 'MONITOR'):?>
                        <?php if($monitoria->status == 1):?>
                            <?= $this->Html->link('<i class="fa-solid fa-pen-to-square"></i> Editar', ['action'=>'edit', $monitoria->id],['class'=>'btn btn-sm btn-outline-primary', 'escape'=>false]) ?>
                            <?= $this->Html->link('<i class="fa-regular fa-rectangle-xmark"></i> Finalizar', ['action'=>'finalizar', $monitoria->id],['class'=>'btn btn-sm btn-outline-danger','confirm'=>'Tem certeza que deseja encerrar a monitoria?' ,'escape'=>false]) ?>
                        <?php endif;?>

                        <?= $this->Html->link('<i class="fa-solid fa-calendar-week"></i> Semanas',['controller'=>'semanas','action'=>'index', $monitoria->id],['class'=>'btn btn-sm btn-outline-secondary','escape'=>false]) ?>
                    <?php endif;?>
                    <?= $this->Html->link('<i class="fa-regular fa-calendar-days"></i> Frequencias',['controller'=>'frequencias','action'=>'index', $monitoria->id],['class'=>'btn btn-sm btn-outline-warning','escape'=>false]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
