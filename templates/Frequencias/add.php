<div class="container">
    <nav class="navbar navbar-light bg-light">
        <h4><i class="fa-solid fa-layer-group"></i><?= __(' Registrar Frequencias') ?></h4>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fa-solid fa-chevron-left"></i> Voltar'), ['controller'=>'frequencias', 'action' => 'index', $monitoria->id], ['class' => 'ms-2 btn btn-sm btn-outline-secondary float-end', 'escape'=>false]) ?>
            </li>
        </ul>
    </nav>
    <div class="row shadow p-2">
        <?= $this->Form->create($frequencia) ?>
        <div class="row">
            <div class="col-2 mb-2">
                <?= $this->Form->control('codigo', ['label'=>'CODIGO','class'=>'form-control mb-3', 'value'=>$monitoria->id, 'disabled'=>'disabled'])?>
            </div>
            <div class="col-5 mb-2">
                <label>MONITORIA (DESCRIÇÃO) </label>
                <input value="<?= $monitoria->descricao ?>" disabled class="form-control">
            </div>
            <div class="col-5 mb-2">
                <label>ALUNO </label>
                <input value="<?= $monitoria->aluno->nome ?>" disabled class="form-control">
            </div>
        </div>

        <div class="row ">

            <div class="col-9 mb-2">
                <label>SUPERVISOR </label>
                <input value="<?= $monitoria->professore->nome ?>" disabled class="form-control">
            </div>
            <div class="col-3 mb-2">
                <label>PERIODO </label>
                <input value="<?= $monitoria->periodo ?>" disabled class="form-control">
            </div>
        </div>



        <div class="row mt-2">
            <div class="col-4">
                <?= $this->Form->control('created', ['label'=>'ENTRADA','class'=>'form-control mb-3'])?>
            </div>
            <div class="col-4">
                <?= $this->Form->control('saida', ['label'=>'SAÍDA','class'=>'form-control mb-3'])?>
            </div>
        </div>


        <?= $this->Form->button(__('Salvar'), ['class'=>'btn btn-success mt-1']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
