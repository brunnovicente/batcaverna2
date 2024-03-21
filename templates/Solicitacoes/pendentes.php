<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Turma> $turmas
 */
?>

<style>
    .linha:hover{
        background-color: #DCDCDC;
    }
</style>

<div class="container-fluid m-0 p-0">
    <nav class="navbar navbar-light bg-light">
        <h4 class="text-danger"><i class="fas fa-folder"></i><?= __(' Solicitações Pendentes') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fa-solid fa-chevron-left"></i> Voltar'), ['controller'=>'principal', 'action' => 'index'], ['class' => 'ms-2 btn btn-sm btn-outline-secondary', 'escape'=>false]) ?>
            </li>
        </ul>
    </nav>

    <?php foreach ($pendentes as $solicitacao):?>
        <?php

        $status = '';
        if ($solicitacao->status == 0) {
            $status = '<span class="text-danger">Pendente</span>';
        } else if ($solicitacao->status == 1) {
            $status = '<span class="text-primary">Aberta</span>';
        } else {
            $status = '<span class="text-success">Fechada</span>';
        }
        ?>

    <div class="container-fluid border border-1 rounded rounded-2 my-3 p-2 linha shadow">
        <div class="row">
            <div class="col-4">
                <STRONG>DIÁRIO: </STRONG>
                <h5><?= $solicitacao->diario->descricao ?></h5>
            </div>
            <div class="col-2">
                <STRONG>TURMA: </STRONG>
                <h5><?= $solicitacao->diario->turma->descricao ?></h5>
            </div>
            <div class="col-3">
                <STRONG>PROFESSOR: </STRONG>
                <h5><?= $solicitacao->diario->professore->nome ?></h5>
            </div>
            <div class="col-1">
                <STRONG>STATUS: </STRONG>
                <h5><?= $status ?></h5>
            </div>
            <div class="col-1">
                <?php
                $dias = ((new DateTime())->diff(new DateTime(''.$solicitacao->data->format('y-m-d'))))->d;
                ?>
                <?php //if($dias < 1):?>
                <h3><span class="badge bg-success">Abrir</span></h3>
                <?php //endif;?>
            </div>
            <div class="col-1 d-flex justify-content-end">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <?= $this->Html->link('<i class="fab fa-speakap"></i> SUAP', $solicitacao->diario->link, ['target'=>'_blank','class'=>'dropdown-item', 'escape'=>false]) ?>
                        </li>
                        <li>
                            <?= $this->Html->link('<i class="fa-solid fa-lock-open"></i> Abrir', ['controller'=>'solicitacoes','action'=>'abrir', $solicitacao->id],['class'=>'dropdown-item text-success','escape'=>false,'confirm'=>'Tem certeza que deseja ABRIR esta Solicitação?']) ?>
                        </li>
                        <li>
                            <?= $this->Html->link( '<i class="fa-solid fa-trash-can"></i> Excluir', ['controller'=>'solicitacoes','action' => 'delete', $solicitacao->id], ['class'=>'text-danger dropdown-item','escape'=>false,'confirm' => __('Tem certeza que deseja remover a Solicitação?', $solicitacao->id)]) ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <strong>DATA: </strong>
                <?= $solicitacao->data ?>
            </div>
            <div class="col">
                <strong>SOLICITADA: </strong>
                <?= $solicitacao->created ?>
            </div>
            <div class="col">
                <strong>DIA: </strong>
                <?= $solicitacao->dia ?>
            </div>
            <div class="col">
                <strong>HORÁRIO: </strong> <?= $solicitacao->horarios ?>
            </div>
            <div class="col">
                <strong>TIPO: </strong> <?= $solicitacao->tipo ?>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <strong>JUSTIFICATIVA: </strong> <?= $solicitacao->justificativa ?>
            </div>
        </div>
    </div>


    <?php endforeach;?>

</div>
