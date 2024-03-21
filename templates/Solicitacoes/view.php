<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Permuta $permuta
 */

?>
<div class="col-md-8 p-2 mx-auto mb-3">
    <h4><i class="fas fa-folder"></i><?= __(' Solicitação de Abertura de Diário') ?></h4>

    <div class="border border-1 p-3 bg-light my-3">
        <p class="text-danger text-center h5">
            Solicite liberação de aulas ou transfira para outro professor.
        </p>
    </div>

    <div class="row">
        <div class="col-sm">
            <?= $this->Form->create()?>
                <?= $this->Form->control('siape', ['class'=>'form-control my-2 w-25', 'label'=>'DIGITE O SEU SIAPE AQUI E PRESSIONE ENTER','id'=>'busca']) ?>
            <?= $this->Form->end()?>
        </div>
    </div>


    <?php if(isset($diarios)):?>

        <!--    <div class="row mb-2 float-end">-->
        <!--        <p class="text-primary">-->
        <!--            Cadastre-se e acompanhe suas solicitações.-->
        <!--            --><?php //= $this->Html->link(__(' Cadastrar'), ['controller'=>'professores','action' => 'cadastrar',$professor->id],['class'=>'btn btn-outline-primary btn-sm m-1 <i fas fa-user-plus']) ?>
        <!--        </p>-->
        <!--    </div>-->
        <div class="bg-light my-3 py-2 px-1 d-flex justify-content-between">
            <h5>Prof. <?php echo $docente->nome;?></h5>
            <?= $this->Html->link('<i class="fas fa-folder"></i> Minhas Solicitações', ['controller'=>'solicitacoes','action'=>'listar', $docente->id],['class'=>'btn btn-sm btn-outline-dark', 'escape'=>false]) ?>
        </div>
        <table class="table table-striped">
            <tr>
                <th>CURSO</th>
                <th>TURMA</th>
                <th>DIÁRIO</th>
                <th>ANO</th>
                <th></th>
            </tr>
            <?php foreach($diarios as $diario):?>
                <tr>
                    <td><?= $diario->turma->curso->descricao ?></td>
                    <td><?= $diario->turma->descricao ?></td>
                    <td><?= $diario->descricao ?></td>
                    <td><?= $diario->turma->ano ?></td>
                    <td>
                        <?= $this->Html->link(__('<i class="fas fa-unlock"></i> Solicitar'), ['controller'=>'solicitacoes','action' => 'add', $diario->id],['class'=>'btn btn-outline-dark btn-sm m-1', 'escape'=>false]) ?>
                        <?= $this->Html->link(__('<i class="fa-solid fa-right-left"></i> Transferir'), ['controller'=>'solicitacoes','action' => 'transferir', $diario->turma->id],['class'=>'btn btn-outline-dark btn-sm m-1', 'escape'=>false]) ?>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>

    <?php endif;?>
</div>

<script>
    if ("geolocation" in navigator) {
        // Se o suporte estiver disponível, solicita a localização do usuário
        navigator.geolocation.getCurrentPosition(function(position) {
            // Obtém a latitude e a longitude do usuário
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            // Faz algo com a localização, como exibir no console
            console.log("Latitude: " + latitude + ", Longitude: " + longitude);
        }, function(error) {
            // Caso ocorra um erro ao obter a localização do usuário
            console.error("Erro ao obter localização: " + error.message);
        });
    } else {
        // Se o navegador não suportar a API de Geolocalização
        console.error("Geolocalização não suportada pelo navegador.");
    }
</script>
