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
                    <h4>Primeiro Acesso à Batcaverna</h4><br>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->control('siape', ['class'=>'form-control my-2', 'label'=>'SIAPE','placeholder'=>'Somente números']);?>
            </div>

            <div class="row">
                <div class="col-sm-12 mb-2">
                    <?= $this->Form->button('Solicitar', ['class'=>'btn btn-dark w-100'])?>
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
