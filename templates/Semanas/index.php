<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Semana> $semanas
 */
?>
<div class="semanas index content">
    <nav class="navbar navbar-light bg-light">
        <h4><i class="fa-solid fa-calendar-week"></i><?= __(' Semanas da Monitoria') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fa-solid fa-door-open"></i> Adicionar'), ['action' => 'add', $monitoria->id], ['class' => 'btn btn-sm btn-outline-success', 'escape'=>false]) ?>
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

    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>DESCRIÇÃO</th>
            <th>CARGA</th>
            <th>CUMPRIDA</th>
            <th>INÍCIO</th>
            <th>FIM</th>
            <th></th>
        </tr>
        <?php foreach ($semanas as $semana): ?>
            <tr>
                <td><?= $this->Number->format($semana->id) ?></td>
                <td><?= h($semana->descricao) ?></td>
                <td><?= $this->Number->format($semana->carga) ?></td>
                <td><?= $this->Number->format($semana->cumprido) ?></td>
                <td><?= h($semana->inicio) ?></td>
                <td><?= h($semana->fim) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $semana->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $semana->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $semana->id], ['confirm' => __('Are you sure you want to delete # {0}?', $semana->id)]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
