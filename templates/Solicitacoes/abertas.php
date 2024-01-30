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
        <h4 class="text-primary"><i class="fas fa-folder"></i><?= __(' Solicitações Pendentes') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fa-solid fa-chevron-left"></i> Voltar'), ['controller'=>'principal', 'action' => 'index'], ['class' => 'ms-2 btn btn-sm btn-outline-secondary', 'escape'=>false]) ?>
            </li>
        </ul>
    </nav>

    <?php foreach ($pendentes as $solicitacao):?>
        <?php

        $status = '';
        if ($solicitacao->stauts == 0) {
            $status = '<span class="text-danger">Pendente</span>';
        } else if ($solicitacao->status == 1) {
            $status = '<span class="text-primary">Aberta</span>';
        } else {
            $status = '<span class="text-success">Fechada</span>';
        }

        ?>

        <div class="container-fluid border border-1 rounded rounded-2 my-3 p-2 linha shadow">
            <div class="row p-0">
                <div class="col-3">
                    <h5><strong>DIÁRIO: </strong> <?= $solicitacao->diario->descricao ?></h5>
                </div>

                <div class="col-2">
                    <h5><strong>DATA: </strong> <?= $solicitacao->data ?></h5>
                </div>

                <div class="col-1">
                    <h5><strong>DIA: </strong> <?= $solicitacao->dia ?></h5>
                </div>

                <div class="col-2">
                    <h5><strong>HORÁRIO: </strong> <?= $solicitacao->horarios ?></h5>
                </div>

                <div class="col-2">
                    <h5><strong>STATUS: </strong> <?= $status ?></h5>
                </div>
                <div class="col-2">
                    <nav class="navbar navbar-expand-lg">
                        <div class="container-fluid">
                            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <?= $this->Html->link('<i class="fab fa-speakap"></i> SUAP', $solicitacao->diario->link, ['target'=>'_blank','class'=>'btn btn-sm btn-outline-dark mx-2','escape'=>false]) ?>
                                    </li>
                                    <li class="nav-item">
                                        <?= $this->Html->link('<i class="fa-regular fa-circle-xmark"></i> Fechar', ['controller'=>'solicitacoes','action'=>'fechar', $solicitacao->id],['class'=>'btn btn-sm btn-outline-dark', 'confirm'=>'Tem certeza que FINALIZAR  a Solicitação?', 'escape'=>false]) ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="border-bottom my-1"></div>
            <div class="row p-2">
                <div class="col">
                    <strong>JUSTIFICATIVA</strong>
                    <p>
                        <?= $solicitacao->justificativa ?>
                    </p>
                </div>
                <div class="col">
                    <strong>PROFESSOR</strong>
                    <p>
                        <?= $solicitacao->diario->professore->nome ?>
                    </p>
                </div>

                <div class="col">
                    <strong>TIPO</strong>
                    <p>
                        <?= $solicitacao->tipo ?>
                    </p>
                </div>
                <div class="col">
                    <?php
                    $dias = (new DateTime(''.$solicitacao->data->format('y-m-d')))->diff((new DateTime()))->d
                    ?>
                    <?php if($dias > 3):?>
                        <h3><span class="badge bg-danger">Fechar</span></h3>
                    <?php endif;?>
                </div>

            </div>
        </div>
    <?php endforeach;?>

</div>
