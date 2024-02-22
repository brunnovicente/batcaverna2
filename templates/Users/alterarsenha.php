<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Materiai $materiai
 * @var \Cake\Collection\CollectionInterface|string[] $disciplinas
 */
?>

<div class="container p-0 mt-1">
    <nav class="navbar navbar-light bg-light">
        <h5><i class="fa fa-tags"> </i><?= __(' Alterar Senha') ?></h5>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link('<i class="fas fa-angle-left"></i> Voltar', ['controller'=>'principal','action' => 'index'], ['class' => 'btn btn-outline-dark m-1','escape'=>false]) ?>
            </li>
        </ul>
    </nav>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-5 mx-auto shadow p-3 mt-3 rounded">
            <?= $this->Form->create()?>

            <div class="form-group">
                <?php echo $this->Form->control('senha1', ['class'=>'form-control','type'=>'password', 'label'=>'DIGITE A NOVA SENHA']);?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->control('senha2', ['class'=>'form-control','type'=>'password','label'=>'REPITA A NOVA SENHA']);?>
            </div>
            <div>
                <?= $this->Form->button(' Alterar', ['class'=>'btn btn-success btn-block mt-3'])?>
            </div>
            <?= $this->Form->end()?>
        </div>
    </div>
</div>
