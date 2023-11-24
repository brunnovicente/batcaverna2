<div class="container">
    <div class="row">
        <div class="col-md-5 mx-auto shadow p-3 mt-3 rounded">
            <?= $this->Form->create()?>

            <div class="container mb-4">
                <a href="/principal">
                    <?= $this->Html->image('batman.png', ['class'=>'d-block mx-auto w-50']) ?>
                </a>
            </div>

            <div class="logo mb-3">
                <div class="col-md-12 text-center text-dark">
                    <h4>Acesso à Batcaverna</h4><br>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->control('username', ['class'=>'form-control my-2', 'label'=>'USUÁRIO','placeholder'=>'Somente números']);?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->control('password', ['class'=>'form-control my-2', 'label'=>'SENHA']);?>
            </div>
            <div class="row">
                <div class="col-sm-12 mb-2">
                <?= $this->Form->button('Entrar', ['class'=>'btn btn-dark w-100'])?>
                <?= $this->Form->end()?>
                </div>
                <div class="col-sm-6">
<!--                    <a class="btn btn-outline-success btn-block w-100" href="/users/primeiro">Primeiro Acesso</a>-->
                </div>
            </div>
            <p class="text-center"><a href="/">Voltar ao Site</a></p>
        </div>

    </div>

</div>

<!--<div class="container-fluid">

    <div class="container mb-4">
        <a href="/"><img src="/img/logo.png" class="d-block mx-auto w-25"/></a>
    </div>
    <h4 class="text-center"> Câmara de Vereadores - CN<br>Coelho Neto - MA</h4>

    <?//= $this->Form->create()?>
    <div class="container-sm d-block mx-auto">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <?php //echo $this->Form->control('username', ['class'=>'form-control', 'label'=>'LOGIN']);?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <?php //echo $this->Form->control('password', ['class'=>'form-control', 'label'=>'SENHA']);?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?//= $this->Form->button('Entrar', ['class'=>'btn btn-success btn-block'])?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a class="btn btn-light btn-block mt-2" href="/">Voltar</a>
            </div>
        </div>

    </div>
    <?//= $this->Form->end()?>

</div>
-->
