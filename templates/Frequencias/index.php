<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Frequencia> $frequencias
 */
?>
<div class="">
    <nav class="navbar navbar-light bg-light">
        <h4><i class="fa-solid fa-layer-group"></i><?= __(' Frequencias') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fa-solid fa-door-open"></i> Entrada'), ['action' => 'add', $monitoria->id], ['class' => 'btn btn-sm btn-outline-success', 'escape'=>false]) ?>
                <?= $this->Html->link(__('<i class="fa-solid fa-chevron-left"></i> Voltar'), ['controller'=>'monitorias', 'action' => 'index'], ['class' => 'ms-2 btn btn-sm btn-outline-secondary float-end', 'escape'=>false]) ?>
            </li>
        </ul>
    </nav>
    <div class="row py-3 bg-light">
        <div class="col-sm">
            <h5><strong>MONITORIA: </strong> <?= $monitoria->descricao ?></h5>
        </div>
        <div class="col-sm">
            <h5><strong>SUPERVISOR: </strong> <?= $monitoria->professore->nome ?></h5>
        </div>
        <div class="col-sm">
            <h5><strong>MONITOR: </strong> <?= $monitoria->aluno->nome ?></h5>
        </div>
    </div>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>DIA</th>
            <th>HORAS</th>
            <th>ENTRADA</th>
            <th>SAÍDA</th>
            <th>STATUS</th>
            <th></th>
        </tr>
        <?php foreach ($frequencias as $frequencia): ?>
            <tr>
                <td><?= $this->Number->format($frequencia->id) ?></td>
                <td><?= h($frequencia->dia) ?></td>
                <td><?= $this->Number->format($frequencia->horas) ?></td>
                <td><?= h($frequencia->created) ?></td>
                <td>
                    <?php
                        if($frequencia->status == 1){
                            echo $frequencia->modified;
                        }
                   ?></td>
                <td>
                    <?php if($frequencia->status == 1):?>
                        <span class="text-primary">Fechado</span>
                    <?php else:?>
                        <span class="text-danger">Aberto</span>
                    <?php endif;?>
                </td>
                <td>
                    <?php if($frequencia->status == 0):?>
                        <?= $this->Html->link('<i class="fa-solid fa-outdent"></i> Saída', ['action' => 'edit', $frequencia->id],['class'=>'btn btn-sm btn-outline-success', 'escape'=>false]) ?>
                    <?php endif;?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
