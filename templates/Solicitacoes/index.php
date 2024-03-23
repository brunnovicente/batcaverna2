<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Turma> $turmas
 */
    $status = array(
        0 => 'Pendente',
        1 => 'Aberta',
        2 => 'Fechada',
    );

?>

<style>
    .linha:hover{
        background-color: #DCDCDC;
    }
</style>

<div class="container-fluid m-0 p-0">
    <nav class="navbar navbar-light bg-light">
        <h4><i class="fas fa-folder"></i><?= __(' Solicitações') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fa-solid fa-chevron-left"></i> Voltar'), ['controller'=>'principal', 'action' => 'index'], ['class' => 'ms-2 btn btn-sm btn-outline-secondary', 'escape'=>false]) ?>
            </li>
        </ul>
    </nav>

    <div class="bg-light p-2 ">
        <?= $this->Form->create()?>
        <div class="row ">
            <div class="col-2">
                <?php echo $this->Form->control('busca', ['options'=>$status,'class'=>'form-select my-2 ', 'label'=>'Status']);?>
            </div>
            <div class="col-2 pt-4">
                <?= $this->Form->button('Filtrar', ['class'=>'btn btn-outline-secondary my-2', 'escape'=>false]) ?>
                <?= $this->Html->link('Limpar', ['controller'=>'solicitacoes'],['class'=>'btn btn-outline-secondary my-2']) ?>
            </div>
        </div>


        <?= $this->Form->end()?>
    </div>

    <?php foreach ($solicitacoes as $solicitacao):?>

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
        <div class="row p-0">
            <div class="col-sm-4">
                <STRONG>DIÁRIO: </STRONG>
                <h5><?= $solicitacao->diario->descricao ?></h5>
            </div>
            <div class="col-sm-2">
                <STRONG>TURMA: </STRONG>
                <h5><?= $solicitacao->diario->turma->descricao ?></h5>
            </div>
            <div class="col-sm-3">
                <STRONG>PROFESSOR: </STRONG>
                <h5><?= $solicitacao->diario->professore->nome ?></h5>
            </div>
            <div class="col-sm-1">
                <STRONG>STATUS: </STRONG>
                <h5><?= $status ?></h5>
            </div>
            <div class="col-2">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
                            <ul class="navbar-nav">

                                <?php if($solicitacao->status == 0):?>
                                    <li class="nav-item">
                                        <a class="btn btn-sm btn-outline-dark mx-2" href=""><i class="fab fa-speakap"></i> Suap</a>
                                    </li>
                                    <li class="nav-item">
                                        <?= $this->Html->link('<i class="fa-solid fa-lock-open"></i> Abrir', ['controller'=>'solicitacoes','action'=>'abrir', $solicitacao->id],['class'=>'btn btn-sm btn-outline-success ','escape'=>false,'confirm'=>'Tem certeza que deseja ABRIR esta Solicitação?']) ?>
                                    </li>
                                    <li class="nav-item">
                                        <?= $this->Html->link( '<i class="fa-solid fa-trash-can"></i> Excluir', ['controller'=>'solicitacoes','action' => 'delete', $solicitacao->id], ['class'=>'btn btn-outline-danger btn-sm mx-2','escape'=>false,'confirm' => __('Tem certeza que deseja remover a Solicitação?', $solicitacao->id)]) ?>
                                    </li>
                                <?php elseif ($solicitacao->status == 1):?>
                                    <li class="nav-item">
                                        <a class="btn btn-sm btn-outline-dark mx-2" href=""><i class="fab fa-speakap"></i> Suap</a>
                                    </li>
                                    <li class="nav-item">
                                        <?= $this->Html->link('<i class="fa-regular fa-circle-xmark"></i> Fechar', ['controller'=>'solicitacoes','action'=>'fechar', $solicitacao->id],['class'=>'btn btn-sm btn-outline-danger', 'confirm'=>'Tem certeza que FINALIZAR  a Solicitação?', 'escape'=>false]) ?>
                                    </li>
                                <?php else:?>
                                    <li class="nav-item">
                                        <?= $this->Html->link( '<i class="fa-solid fa-trash-can"></i> Excluir', ['controller'=>'solicitacoes','action' => 'delete', $solicitacao->id], ['class'=>'btn btn-outline-danger btn-sm mx-2','escape'=>false,'confirm' => __('Tem certeza que deseja remover a Solicitação?', $solicitacao->id)]) ?>
                                    </li>
                                <?php endif;?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="border-bottom my-1"></div>
        <div class="row">
            <div class="col-sm-1">
                <strong>DATA: </strong>
                <?= $solicitacao->data ?>
            </div>
            <div class="col-sm-2">
                <strong>SOLICITADA: </strong>
                <?= $solicitacao->created ?>
            </div>
            <div class="col-sm-3">
                <strong>SOLICITANTE: </strong>
                <?= $solicitacao->solicitante ?>
            </div>
            <div class="col-sm-2">
                <strong>DIA: </strong>
                <?= $solicitacao->dia ?>
            </div>
            <div class="col-sm-2">
                <strong>HORÁRIO: </strong> <?= $solicitacao->horarios ?>
            </div>
            <div class="col-sm-2">
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
