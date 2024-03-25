<?php

use Cake\I18n\FrozenTime;

?>
<nav class="navbar navbar-light bg-light">
    <h4>Bem Vindo à Batcaverna</h4>
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <?= $this->Html->link(__('<i class="fas fa-folder"></i> Solicitações'), ['controller'=>'solicitacoes','action' => 'index'], ['class' => 'btn btn-outline-dark btn-sm m-1', 'escape'=>false]) ?>
            <?= $this->Html->link(__('<i class="fa-solid fa-person-shelter"></i> Monitorias'), ['controller'=>'monitorias','action' => 'index'], ['class' => 'btn btn-outline-dark btn-sm m-1', 'escape'=>false]) ?>
            <?= $this->Html->link(__('<i class="fa-solid fa-book"></i> Diários'), ['controller'=>'diarios','action' => 'index'], ['class' => 'btn btn-outline-dark btn-sm m-1', 'escape'=>false]) ?>
            <?= $this->Html->link(__('<i class="fas fa-user-tie"></i> Professores'), ['controller'=>'professores','action' => 'index'], ['class' => 'btn btn-outline-dark btn-sm m-1', 'escape'=>false]) ?>
            <?= $this->Html->link(__('<i class="fa-solid fa-user-graduate"></i> Alunos'), ['controller'=>'alunos','action' => 'index'], ['class' => 'btn btn-outline-dark btn-sm m-1', 'escape'=>false]) ?>
            <?= $this->Html->link(__('<i class="fas fa-layer-group"></i> Turmas'), ['controller'=>'turmas','action' => 'index'], ['class' => 'btn btn-outline-dark btn-sm m-1', 'escape'=>false]) ?>
            <?= $this->Html->link(__('<i class="fas fa-graduation-cap"></i> Cursos'), ['controller'=>'cursos','action' => 'index'], ['class' => 'btn btn-outline-dark btn-sm m-1', 'escape'=>false]) ?>
        </li>
    </ul>
</nav>

<div class="row mt-2">
    <div class="col-sm-3">
        <div class="border border-1 rounded-2 bg-light p-2">
            <img src="<?= $user['foto'] ?>" class="w-50 mx-auto rounded-circle d-flex align-content-center">
            <h4 class="text-center mt-3"><?= $user['professor']->nome ?></h4>
            <h5 class="text-center mt-2">SIAPE: <?= $user['professor']->siape ?></h5>
            <h5 class="text-center mt-2">E-MAIL: <?= $user['professor']->email ?></h5>
            <h5 class="text-center mt-2">CATEGORIA: <?= $user['categoria'] ?></h5>
        </div>

    </div>

    <div class="col-sm-6">
        <div class="bg-light p-3 border border-1 rounded-3">
            <h5>Solicitações Realizadas</h5>

            <div class="mt-2">
                <a class="btn btn-outline-danger mx-1" href="/solicitacoes/pendentes">
                    <div class="rounded rounded-3" style="width: 100px; height: 100px" >

                        <h1 class="text-center"><?= $pendentes ?>

                        <h5 class="text-center">
                             Pendentes
                            <?php if($abrir > 0):?>
                                <span class="badge text-bg-warning"><?= $abrir ?></span>
                            <?php endif;?>
                        </h5>
                    </div>
                </a>

                <a class="btn btn-outline-primary mx-1" href="/solicitacoes/abertas">
                    <div class="rounded rounded-3" style="width: 100px; height: 100px">
                        <h1 class="text-center"><?= $abertas ?></h1>
                        <h5 class="text-center">
                            Abertas
                            <?php if($fechar > 0):?>
                                <span class="badge text-bg-warning"><?= $fechar ?></span>
                            <?php endif;?>
                        </h5>
                    </div>
                </a>

            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="bg-light p-3 border border-1 rounded-3">
            <h5>Notificações</h5>
            <?php if($abrir > 0):?>
                <div class="alert alert-warning" role="alert">
                    <strong>ATENÇÃO!</strong> Existem solicitações que devem ser abertas imediatamente.
                </div>
            <?php endif;?>

            <?php if($fechar > 0):?>
                <div class="alert alert-warning" role="alert">
                    <strong>ATENÇÃO!</strong> Existem solicitações que devem ser fechadas imediatamente.
                </div>
            <?php endif;?>


        </div>

    </div>

</div>
