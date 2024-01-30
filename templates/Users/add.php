<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container">
    <nav class="navbar navbar-light bg-light">
        <h4><i class="fa-regular fa-id-card"></i><?= __(' Dados do Usuário') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fa-solid fa-pen-to-square"></i> Editar'), ['controller'=>'users', 'action' => 'edit', $user['id']], ['class' => 'mx-2 btn btn-sm btn-outline-primary', 'escape'=>false]) ?>
                <?= $this->Html->link(__('<i class="fa-solid fa-chevron-left"></i> Voltar'), ['controller'=>'cursos', 'action' => 'index'], ['class' => 'mx-2 btn btn-sm btn-outline-secondary float-end', 'escape'=>false]) ?>
            </li>
        </ul>
    </nav>

    <div class="users form content">
        <?= $this->Form->create($user) ?>

        <div>

        </div>


        <fieldset>
            <legend><?= __('Add User') ?></legend>
            <?php
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('categoria');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
