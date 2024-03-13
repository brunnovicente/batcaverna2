<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Mailer\Mailer;

/**
 * Solicitacoes Controller
 *
 * @property \App\Model\Table\SolicitacoesTable $Solicitacoes
 * @method \App\Model\Entity\Solicitaco[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SolicitacoesController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event); // TODO: Change the autogenerated stub
        $this->Auth->allow(['add','view','transferir','minhasturmas','listar','lembrete']);
    }

    public function isAuthorized($user)
    {
        if ($user['categoria'] == 'SUPREMO') {
            return true;
        } else {
            if (in_array($user['categoria'], ['COORDENADOR'])) {
                if (in_array($this->request->getParam('action'), ['index','pendentes','abertas','abrir','fechar','delete'])) {
                    return true;
                }
            } else {
                if (in_array($this->request->getParam('action'), ['index'])){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $user = $this->Auth->user();
        $user['professor'] = $this->getTableLocator()->get('Professores')->find()->where(['users_id'=>$user['id']])->first();

        if($this->request->is('post')){
            $dados = $this->request->getData();
            $sol = $this->Solicitacoes->find()
                ->contain(['Diarios.Turmas.Cursos','Diarios.Professores'])
                ->where(['Solicitacoes.status' => $dados['busca']]);
        }else{
            $sol = $this->Solicitacoes->find()->contain(['Diarios.Turmas.Cursos','Diarios.Professores']);
        }
        $solicitacoes = array();
        if($user['categoria'] == 'SUPREMO'){
            $solicitacoes = $sol;
        }else {
            $curso = $this->getTableLocator()->get('Cursos')->find()->where(['Cursos.professores_id' => $user['professor']->id])->first();
            foreach ($sol as $sol) {
                if ($sol->diario->turma->curso->id == $curso->id) {
                    $solicitacoes[] = $sol;
                }
            }
        }
        $this->set(compact('solicitacoes','user'));
    }

    public function pendentes()
    {
        $user = $this->Auth->user();
        $user['professor'] = $this->getTableLocator()->get('Professores')->find()->where(['users_id'=>$user['id']])->first();
        $curso = $this->getTableLocator()->get('Cursos')->find()->where(['Cursos.professores_id'=>$user['professor']->id])->first();

        $solicitacoes = $this->Solicitacoes->find()->contain(['Diarios.Turmas.Cursos','Diarios.Professores'])->where(['Solicitacoes.status'=>0])->order(['data']);
        $pendentes = [];
        foreach ($solicitacoes as $solicitacao){
            if($solicitacao->diario->turma->curso->id == $curso->id){
                $pendentes[] = $solicitacao;
            }
        }
        $this->set(compact('pendentes','user'));
    }


    public function listar($id){
        $this->viewBuilder()->setLayout('home');
        $professor = $this->getTableLocator()->get('Professores')->get($id);
        $solicitacoes = $this->Solicitacoes->find()->contain(['Diarios.Professores'])->where(['Professores.id'=>$id])->order(['data'])->all();
        $this->set(compact('solicitacoes','professor'));
    }

    public function abertas()
    {
        $user = $this->Auth->user();
        $user['professor'] = $this->getTableLocator()->get('Professores')->find()->where(['users_id'=>$user['id']])->first();
        $curso = $this->getTableLocator()->get('Cursos')->find()->where(['Cursos.professores_id'=>$user['professor']->id])->first();

        $solicitacoes = $this->Solicitacoes->find()->contain(['Diarios.Turmas.Cursos','Diarios.Professores'])->where(['Solicitacoes.status'=>1])->order(['data']);
        $pendentes = [];
        foreach ($solicitacoes as $solicitacao){
            if($solicitacao->diario->turma->curso->id == $curso->id){
                $pendentes[] = $solicitacao;
            }
        }
        $this->set(compact('pendentes','user'));
    }


    public function abrir($id){
        $solicitacao = $this->Solicitacoes->get($id, ['contain'=>['Diarios.Professores','Diarios.Turmas']]);
        $solicitacao->status = 1;
        if($this->Solicitacoes->save($solicitacao)){
            $this->Flash->success('Solicitação deferido com sucesso');
            $this->msg_abrir($solicitacao);
            $this->redirect(['controller'=>'principal','action'=>'index']);
        }
    }

    public function cancelar($id){
        $solicitacao = $this->Solicitacoes->get($id, ['contain'=>['Diarios.Turmas']]);
        $turma = $this->getTableLocator()->get('Turmas')->get($solicitacao->diario->turma->id, ['contain'=>'Cursos.Professores']);
        $solicitacao->status = -1;
        if($this->Solicitacoes->save($solicitacao)){
            $this->Flash->success('Solicitação de cancelamento realizada com sucesso');
            $this->aviso_cancelamento($solicitacao, $turma->curso->professore->email);
            $this->redirect(['controller'=>'principal','action'=>'index']);
        }
    }

    public function aviso_cancelamento($solicitacao, $email){
        $msg = new Mailer('default');
        $msg->setEmailFormat('html');
        $msg->setFrom(['brunovicente@brunovicente.tech'=>'BatCaverna'])
            ->setTo($solicitacao->diario->professore->email)
            ->setSubject('Abertura de Diário')
            ->deliver('Sua Solicitação de Abertura foi deferida. Você tem 3 (três) dias para registrar suas aulas, depois disso deverá solicitar novamente a abertura do diário.<br><br>'.
                'Dados da Solicitação <br>'.
                '<strong>TURMA: </strong>'.$solicitacao->diario->turma->descricao.'<br>'.
                '<strong>DIÁRIO: </strong>'.$solicitacao->diario->descricao.'<br>'.
                '<strong>DIA: </strong>'.$solicitacao->dia.'<br>'.
                '<strong>DATA: </strong>'.$solicitacao->data.'<br>'.
                '<strong>HORÁRIOS: </strong>'.$solicitacao->horarios.'<br>'.
                '<strong>TIPO: </strong>'.$solicitacao->tipo.'<br>'.
                '<strong>JUSTIFICATIVA: </strong> '.$solicitacao->justificativa.'<br>'
            );
    }//Fim de msg_abrir

    public function fechar($id){
        $solicitacao = $this->Solicitacoes->get($id);
        $solicitacao->status = 2;
        if($this->Solicitacoes->save($solicitacao)){
            $this->Flash->success('Solicitação finalizada com sucesso');
            $this->redirect(['controller'=>'solicitacoes','action'=>'abertas']);
        }
    }

    /**
     * View method
     *
     * @param string|null $id Solicitaco id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $this->viewBuilder()->setLayout('home');
        if($this->request->is('post')){
            $dados = $this->request->getData();
            $docente = $this->getTableLocator()->get('Professores')
                ->find()
                ->where(['Professores.siape'=>$dados['siape']])
                ->first();

            $diarios = $this->getTableLocator()->get('Diarios')
                ->find()
                ->contain(['Professores','Turmas.Cursos'])
                ->where(['Professores.siape'=>$dados['siape']])
                ->all();
            if($diarios->count() == 0){
                $this->Flash->error('Não foram encontrados diários para o SIAPE '.$dados['siape'].'.');
            }else{
                $this->set(compact('diarios'));
                $this->set(compact('docente'));
            }
        }//Fim do IF do Post
    }

    public function transferir($id)
    {
        $this->viewBuilder()->setLayout('home');



        $solicitacao = $this->Solicitacoes->newEmptyEntity();

        if($this->request->is('post')){

            $solicitaco = $this->Solicitacoes->patchEntity($solicitacao, $this->request->getData());
            $dados = $this->request->getData();

            $turma = $this->getTableLocator()->get('Turmas')->get($id, ['contain'=>['Cursos.Professores']]);
            $diario = $this->getTableLocator()->get('Diarios')->get($solicitaco->diarios_id, ['contain'=>['Turmas','Professores']]);
            //$solicitacao->diario = $diario;

            $existe = false;

            if(isset($dados['primeiro'])){
                $solicitacao->horarios = $solicitacao->horarios . '1º  ';
                $existe = true;
            }
            if(isset($dados['segundo'])){
                $solicitacao->horarios = $solicitacao->horarios . '2º  ';
                $existe = true;
            }
            if(isset($dados['terceiro'])){
                $solicitacao->horarios = $solicitacao->horarios . '3º  ';
                $existe = true;
            }
            if(isset($dados['quarto'])){
                $solicitacao->horarios = $solicitacao->horarios . '4º  ';
                $existe = true;
            }
            if(isset($dados['quinto'])){
                $solicitacao->horarios = $solicitacao->horarios . '5º  ';
                $existe = true;
            }
            if(isset($dados['sexto'])){
                $solicitacao->horarios = $solicitacao->horarios . '6º  ';
                $existe = true;
            }

            //Pegando o dia da semana
            $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
            $diasemana_numero = date('w', strtotime($dados['data']));
            $solicitacao->dia =  $diasemana[$diasemana_numero];

            $solicitacao->status = 0;
            $solicitacao->registro = 0;

            if(!$existe){
                $this->Flash->error(__('Selecione os dias!'));
            }elseif ($this->Solicitacoes->save($solicitacao)) {
                $solicitaco->diario = $diario;
                $this->mensagem($solicitacao);
                $this->lembrete_coordenador($solicitacao, $turma->curso->professore->email);
                $this->Flash->success(__('Solicitação realizada com sucesso!.'));
                if($this->Auth->user()== null){
                    return $this->redirect(['controller'=>'solicitacoes','action' => 'view']);
                }
                return $this->redirect(['controller'=>'solititacoes','action' => 'view']);
            }
            $this->Flash->error(__('Erro ao tentar solicitar a permuta.'));

        }//Fim da requisição do post

        $user = $this->Auth->user();
        $turma = $this->getTableLocator()->get('Turmas')->get($id,['contain'=>'Cursos']);
        $diarios = $this->getTableLocator()->get('Diarios')->find()->where(['turmas_id'=>$id])->contain(['Professores','Turmas.Cursos'])->find('list')->all();
        $diarios_dados = $this->getTableLocator()->get('Diarios')->find()->where(['turmas_id'=>$id])->contain(['Professores','Turmas.Cursos'])->all()->toList();

        $this->set(compact('user','solicitacao','diarios','diarios_dados','turma'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($id)
    {
        $user = $this->Auth->user();

        if(!$user) {
            $this->viewBuilder()->setLayout('home');
        }else{
            $user['professor'] = $this->getTableLocator()->get('Professores')->find()->where(['users_id'=>$user['id']])->first();
        }



        $diario = $this->getTableLocator()->get('Diarios')->get($id,['contain'=>['Professores', 'Turmas.Cursos.Professores']]);
        //$curso = $this->getTableLocator()->get('Cursos')->get($diario->turma->curso->id,['contain'=>['Professores', 'Turmas.Cursos']]);
        //$professores = $this->getTableLocator()->get('Professores')->find()->all();


        $solicitacao = $this->Solicitacoes->newEmptyEntity();

        if ($this->request->is('post')) {
            $solicitaco = $this->Solicitacoes->patchEntity($solicitacao, $this->request->getData());
            $dados = $this->request->getData();

            $solicitaco->diario = $diario;

            //$solicitacao->diario = $diario;
            $existe = false;

            if(isset($dados['primeiro'])){
                $solicitacao->horarios = $solicitacao->horarios . '1º  ';
                $existe = true;
            }
            if(isset($dados['segundo'])){
                $solicitacao->horarios = $solicitacao->horarios . '2º  ';
                $existe = true;
            }
            if(isset($dados['terceiro'])){
                $solicitacao->horarios = $solicitacao->horarios . '3º  ';
                $existe = true;
            }
            if(isset($dados['quarto'])){
                $solicitacao->horarios = $solicitacao->horarios . '4º  ';
                $existe = true;
            }
            if(isset($dados['quinto'])){
                $solicitacao->horarios = $solicitacao->horarios . '5º  ';
                $existe = true;
            }
            if(isset($dados['sexto'])){
                $solicitacao->horarios = $solicitacao->horarios . '6º  ';
                $existe = true;
            }

            //Pegando o dia da semana
            $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
            $diasemana_numero = date('w', strtotime($dados['data']));
            $solicitacao->dia =  $diasemana[$diasemana_numero];

            $solicitacao->status = 0;
//            if($solicitaco->tipo == 'Permuta'){
//                $solicitacao->retorno = 'Não';
//            }else{
//                $solicitacao->retorno = 'NA';
//            }
            $solicitacao->registro = 0;

            if(!$existe){
                $this->Flash->error(__('Selecione os dias!'));
            }elseif ($this->Solicitacoes->save($solicitacao)) {

                $this->mensagem($solicitacao);
                $this->lembrete_coordenador($solicitacao, $diario->turma->curso->professore->email);

                $this->Flash->success(__('Solicitação realizada com sucesso!.'));
                if($this->Auth->user()== null){
                    return $this->redirect(['controller'=>'solicitacoes','action' => 'view']);
                }
                return $this->redirect(['controller'=>'solicitacoes','action' => 'view']);
            }
            $this->Flash->error(__('Erro ao tentar solicitar a permuta.'));
        }

        $this->set(compact('solicitacao'));
        $this->set(compact('diario'));
        $this->set(compact( 'user'));
        //$this->set(compact('professores'));

    }

    public function mensagem($solicitacao){
        $msg = new Mailer('default');
        $msg->setEmailFormat('html');
        $msg->setFrom(['brunovicente@brunovicente.tech'=>'BatCaverna'])
            ->setTo($solicitacao->diario->professore->email)
            ->setSubject('Nova Solicitação de Abertura de Diário')
            ->deliver('Solicitação de Abertura de Diário Realizada.<br><br>'.
                'Dados da Solicitação <br>'.
                '<strong>TURMA: </strong>'.$solicitacao->diario->turma->descricao.'<br>'.
                '<strong>DIÁRIO: </strong>'.$solicitacao->diario->descricao.'<br>'.
                '<strong>DIA: </strong>'.$solicitacao->dia.'<br>'.
                '<strong>DATA: </strong>'.$solicitacao->data.'<br>'.
                '<strong>HORÁRIOS: </strong>'.$solicitacao->horarios.'<br>'.
                '<strong>TIPO: </strong>'.$solicitacao->tipo.'<br>'.
                '<strong>JUSTIFICATIVA: </strong> '.$solicitacao->justificativa.'<br>'
            );
    }//Fim da Mensagem

    public function lembrete($id){
        $solicitacao = $this->Solicitacoes->get($id, ['contain'=>['Diarios.Professores']]);
        $diario = $this->getTableLocator()->get('Diarios')->get($solicitacao->diario->id, ['contain'=>['Turmas.Cursos.Professores','Professores']]);

        $msg = new Mailer('default');
        $msg->setEmailFormat('html');

        $msg->setFrom(['brunovicente@brunovicente.tech'=>'BatCaverna'])
            ->setTo($diario->turma->curso->professore->email)
            ->setSubject('LEMBRETE DE SOLICITAÇÃO')
            ->deliver('Lembrando da Solicitação de Abertura de Diário Pendente.<br><br>'.
                'Dados da Solicitação <br>'.
                '<strong>TURMA: </strong>'.$diario->turma->descricao.'<br>'.
                '<strong>DIÁRIO: </strong>'.$diario->descricao.'<br>'.
                '<strong>DIA: </strong>'.$solicitacao->dia.'<br>'.
                '<strong>DATA: </strong>'.$solicitacao->data.'<br>'.
                '<strong>HORÁRIOS: </strong>'.$solicitacao->horarios.'<br>'.
                '<strong>TIPO: </strong>'.$solicitacao->tipo.'<br>'.
                '<strong>JUSTIFICATIVA: </strong> '.$solicitacao->justificativa.'<br><br>'.
                '<a href="http://batcaverna.tech/solicitacoes/pendentes">Veja a solicitação Aqui!</a>'
            );

        $this->Flash->success('Lembrete enviado ao Coordenador!.');
        return $this->redirect(['controller'=>'solicitacoes','action'=>'listar', $diario->professore->id]);
    }

    public function lembrete_coordenador($solicitacao, $email){
        $msg = new Mailer('default');
        $msg->setEmailFormat('html');

        $msg->setFrom(['brunovicente@brunovicente.tech'=>'BatCaverna'])
            ->setTo($email)
            ->setSubject('Nova Solicitação de Diário')
            ->deliver('Nova Solicitação de Abertura de Diário Realizada.<br><br>'.
                'Dados da Solicitação <br>'.
                '<strong>TURMA: </strong>'.$solicitacao->diario->turma->descricao.'<br>'.
                '<strong>DIÁRIO: </strong>'.$solicitacao->diario->descricao.'<br>'.
                '<strong>DIA: </strong>'.$solicitacao->dia.'<br>'.
                '<strong>DATA: </strong>'.$solicitacao->data.'<br>'.
                '<strong>HORÁRIOS: </strong>'.$solicitacao->horarios.'<br>'.
                '<strong>TIPO: </strong>'.$solicitacao->tipo.'<br>'.
                '<strong>JUSTIFICATIVA: </strong> '.$solicitacao->justificativa.'<br><br>'.
                '<a href="http://batcaverna.tech/solicitacoes/pendentes">Veja a solicitação Aqui!</a>'
            );
    }

    public function msg_abrir($solicitacao){
        $msg = new Mailer('default');
        $msg->setEmailFormat('html');
        $msg->setFrom(['brunovicente@brunovicente.tech'=>'BatCaverna'])
            ->setTo($solicitacao->diario->professore->email)
            ->setSubject('Abertura de Diário')
            ->deliver('Sua Solicitação de Abertura foi deferida. Você tem 3 (três) dias para registrar suas aulas, depois disso deverá solicitar novamente a abertura do diário.<br><br>'.
                'Dados da Solicitação <br>'.
                '<strong>TURMA: </strong>'.$solicitacao->diario->turma->descricao.'<br>'.
                '<strong>DIÁRIO: </strong>'.$solicitacao->diario->descricao.'<br>'.
                '<strong>DIA: </strong>'.$solicitacao->dia.'<br>'.
                '<strong>DATA: </strong>'.$solicitacao->data.'<br>'.
                '<strong>HORÁRIOS: </strong>'.$solicitacao->horarios.'<br>'.
                '<strong>TIPO: </strong>'.$solicitacao->tipo.'<br>'.
                '<strong>JUSTIFICATIVA: </strong> '.$solicitacao->justificativa.'<br>'
            );
    }//Fim de msg_abrir



    /**
     * Edit method
     *
     * @param string|null $id Solicitaco id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $solicitaco = $this->Solicitacoes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $solicitaco = $this->Solicitacoes->patchEntity($solicitaco, $this->request->getData());
            if ($this->Solicitacoes->save($solicitaco)) {
                $this->Flash->success(__('The solicitaco has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The solicitaco could not be saved. Please, try again.'));
        }
        $diarios = $this->Solicitacoes->Diarios->find('list', ['limit' => 200])->all();
        $this->set(compact('solicitaco', 'diarios'));
    }



    /**
     * Delete method
     *
     * @param string|null $id Solicitaco id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //$this->request->allowMethod(['post', 'delete']);
        $solicitaco = $this->Solicitacoes->get($id);
        if($solicitaco->status == 1){
            $this->Flash->warning('Não pode remover uma solicitação aberta, Feche as aulas no SUAP depois feche a solicitação no BatCaverna.');
            return $this->redirect(['controller'=>'solicitacoes','action'=>'abertas']);
        }

        if ($this->Solicitacoes->delete($solicitaco)) {
            $this->Flash->success(__('Solicitação removida com sucesso!.'));
        } else {
            $this->Flash->error(__('The solicitaco could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
