<?php

use Cake\I18n\FrozenTime;

?>
<nav class="navbar navbar-light bg-light">
    <h4>Bem Vindo à Batcaverna, <?= $user['professor']->nome ?></h4>
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <?= $this->Html->link(__('<i class="fas fa-folder"></i> Solicitações'), ['controller'=>'permutas','action' => 'index'], ['class' => 'btn btn-outline-dark btn-sm m-1', 'escape'=>false]) ?>
            <?= $this->Html->link(__('<i class="fas fa-user-tie"></i> Professores'), ['controller'=>'professores','action' => 'index'], ['class' => 'btn btn-outline-dark btn-sm m-1', 'escape'=>false]) ?>
            <?= $this->Html->link(__('<i class="fas fa-layer-group"></i> Turmas'), ['controller'=>'turmas','action' => 'index'], ['class' => 'btn btn-outline-dark btn-sm m-1', 'escape'=>false]) ?>
            <?= $this->Html->link(__('<i class="fas fa-graduation-cap"></i> Cursos'), ['controller'=>'cursos','action' => 'index'], ['class' => 'btn btn-outline-dark btn-sm m-1', 'escape'=>false]) ?>
        </li>
    </ul>
</nav>
