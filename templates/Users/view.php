<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container mt-2">

    <nav class="navbar navbar-light bg-light">
        <h4><i class="fa-regular fa-id-card"></i><?= __(' Dados do Usuário') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fa-solid fa-pen-to-square"></i> Editar'), ['controller'=>'professores', 'action' => 'edit', $user['professor']->id], ['class' => 'mx-2 btn btn-sm btn-outline-primary', 'escape'=>false]) ?>
                <?= $this->Html->link(__('<i class="fa-solid fa-chevron-left"></i> Voltar'), ['controller'=>'cursos', 'action' => 'index'], ['class' => 'mx-2 btn btn-sm btn-outline-secondary float-end', 'escape'=>false]) ?>
            </li>
        </ul>
    </nav>

    <div class="row">

        <div class="col-3">
            <img src="<?= $professor->user->foto ?>" alt="Sem Foto" width="300" class="rounded rounded-2">

<!--            <div id="previewFoto" class="bg-success p-0 m-0" style="height: 400px">-->
<!--                -->
<!--            </div>-->
<!---->
<!--            <div class="mt-2">-->
<!--                <input type="file" id="inputFoto" accept="image/*">-->
<!--            </div>-->
<!---->
<!--            <button onclick="recortarFoto()" class="btn btn-success">Recortar Foto</button>-->
<!---->
<!--            <img src="" id="foto-final">-->


        </div>


        <div class="col-9 shadow p-2">
            <h5>Meus Dados</h5>

            <label>SIAP</label>
            <input type="text" disabled="disabled" class="form-control mb-3 w-25" value="<?= $professor->siape ?>">

            <label>NOME</label>
            <input type="text" disabled="disabled" class="form-control mb-3" value="<?= $professor->nome ?>">

            <label>E-MAIL</label>
            <input type="text" disabled="disabled" class="form-control" value="<?= $professor->email ?>">


            <h5 class="mt-3">Dados de Usuário</h5>

            <label>USUÁRIO</label>
            <input type="text" disabled="disabled" class="form-control mb-3" value="<?= $professor->user->username ?>">

            <label>CATEGORIA</label>
            <input type="text" disabled="disabled" class="form-control w-50" value="<?= $professor->user->categoria ?>">

        </div>

    </div>

</div>

<script src="../../webroot/js/preview.js"></script>
