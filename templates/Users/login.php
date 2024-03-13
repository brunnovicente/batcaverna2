<div class="container">
    <div class="row">
        <div class="col-md-5 mx-auto shadow p-3 mt-3 rounded" id="conteudo-form">
            <?= $this->Form->create(null, ['id'=>'formulario'])?>


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

        <div id="carregando"  style="width: 100%;height: 100vh;position: absolute; top: 0; left: 0;display: none;align-items: center;margin-top: 100px;">

            <?= $this->Html->image('acesso.gif', ['class'=>'d-block mx-auto', 'width'=>'500px']) ?>

            <h5 class="text-center">Acessando no Batcaverna, por favor aguarde!...</h5>
        </div>

    </div>

</div>



<script>

    var formulario = document.getElementById('formulario');

    formulario.onsubmit = function (){
        var formulario = document.getElementById('conteudo-form');
        var carregando = document.getElementById('carregando');
        formulario.style.display = 'none';
        carregando.style.display = 'block';
    }

</script>
