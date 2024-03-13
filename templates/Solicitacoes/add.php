<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Permuta $permuta
 * @var \Cake\Collection\CollectionInterface|string[] $turmas
 */

$dias = array(
    'Segunda'=>'Segunda',
    'Terça'=>'Terça',
    'Quarta'=>'Quarta',
    'Quinta'=>'Quinta',
    'Sexta'=>'Sexta',
    'Sábado'=>'Sábado'
);
$horarios = array('1','2','3','4','5','6');
$tipo = array(
    'Substituição'=>'Substituição',
    'Devolução' => 'Devolução',
    'Livre'=>'Livre',
    'Contra-Turno'=>'Contra-Turno',
    'Eventos' => 'Eventos',
    'Sábado' => 'Sábado'
);
//$permuta->turmas_id = $turma->id;
?>
<div class="col-md-5 mx-auto mb-2 shadow pb-2" id="formulario">
    <div class="row p-3">
        <h3 class="col-10">
            <?= __('Nova Solicitação de Abertura de Aula') ?>
        </h3>
        <div class="col-2 d-flex justify-content-end">
            <?php if(isset($user)):?>
                <?= $this->Html->link('Voltar', ['controller'=>'diarios','action'=>'index'],['class'=>'btn btn-outline-dark']) ?>
            <?php else:?>
                <?= $this->Html->link('Voltar', ['controller'=>'solicitacoes','action'=>'view'],['class'=>'btn btn-outline-dark']) ?>
            <?php endif;?>
        </div>
    </div>

    <div class="container">
        <?= $this->Form->create($solicitacao) ?>
        <label>PROFESSOR</label>
        <input class="form-control mb-3" type="text" disabled="disabled" value="<?=$diario->professore->nome?>">

        <label>CURSO</label>
        <input class="form-control mb-3" type="text" disabled="disabled" value="<?= $diario->turma->curso->descricao ?>">

        <label>TURMA</label>
        <input class="form-control mb-3" type="text" disabled="disabled" value="<?= $diario->turma->descricao ?>">

        <label>DIÁRIO</label>
        <input class="form-control mb-3"  type="text" disabled="disabled" value="<?= $diario->descricao ?>">

        <?php
        echo $this->Form->control('data', ['default'=>date('Y-m-d'),'class'=>'form-control mb-3 w-25']);
        //echo $this->Form->control('dia',['options'=>$dias,'class'=>'form-select mb-3 w-25']);
        ?>
        <div class="mb-3">
            <label>Horários</label>
            <input class="form-check-input" name="primeiro" type="checkbox" value="">
            <label class="form-check-label " for="primeiro" id="lprimeiro">
                1º
            </label>
            <input class="form-check-input ms-3" name="segundo" type="checkbox" value="" id="segundo">
            <label class="form-check-label " for="segundo" id="lsegundo">
                2º
            </label>
            <input class="form-check-input ms-3" name="terceiro" type="checkbox" value="" id="terceiro">
            <label class="form-check-label" for="terceiro" id="laterceiro">
                3º
            </label>
            <input class="form-check-input ms-3" name="quarto" type="checkbox" value="" id="quarto">
            <label class="form-check-label" for="quarto" id="lquarto">
                4º
            </label>
            <input class="form-check-input ms-3" name="quinto" type="checkbox" value="" id="quinto">
            <label class="form-check-label" for="quinto" id="lquinto">
                5º
            </label>
            <input class="form-check-input ms-3" name="sexto" type="checkbox" value="" id="sexto">
            <label class="form-check-label" for="sexto" id="lsexto">
                6º
            </label>
        </div>
        <?php
        echo $this->Form->control('justificativa',['class'=>'form-control mb-3']);
        echo $this->Form->control('tipo',['options'=>$tipo,'class'=>'form-select mb-3 w-25']);
        ?>
        <?= $this->Form->button(__('Solicitar'),['class'=>'btn btn-success']) ?>
        <?= $this->Form->end() ?>

    </div>
</div>

<div id="carregando" style="display: none">
    <?= $this->Html->image('acesso.gif', ['class'=>'d-block mx-auto', 'width'=>'500px']) ?>
    <h5 class="text-center">Enviando Solicitação ao Batcaverna...</h5>
</div>

<script>

    var formulario = document.getElementById('formulario');

    formulario.onsubmit = function (){
        var formulario = document.getElementById('formulario');
        var carregando = document.getElementById('carregando');
        formulario.style.display = 'none';
        carregando.style.display = 'block';
    }

</script>

