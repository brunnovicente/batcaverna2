<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Monitorias Controller
 *
 * @property \App\Model\Table\MonitoriasTable $Monitorias
 * @method \App\Model\Entity\Monitoria[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MonitoriasController extends AppController
{

    public function isAuthorized($user)
    {
        if ($user['categoria'] == 'SUPREMO') {
            return true;
        } else {
            if (in_array($user['categoria'], ['COORDENADOR'])) {
                if (in_array($this->request->getParam('action'), ['index','add','edit'])) {
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
        if($user['categoria'] == 'MONITOR'){
            $user['aluno'] = $this->getTableLocator()->get('Alunos')->find()->where(['users_id'=>$user['id']])->first();
        }else{
            $user['professor'] = $this->getTableLocator()->get('Professores')->find()->where(['users_id'=>$user['id']])->first();
        }


        if($user['categoria'] == 'SUPREMO'){
            $monitorias = $this->Monitorias->find()->contain(['Professores','Alunos']);
        }else if($user['categoria'] == 'COORDENADOR'){
            $monitorias = $this->Monitorias->find()
                ->contain(['Professores','Alunos'])->where(['Monitorias.professores_id'=>$user['professor']->id]);
        }else{
            $monitorias = $this->Monitorias->find()
                ->contain(['Professores','Alunos'])->where(['Monitorias.alunos_id'=>$user['aluno']->id]);
        }
        $this->set(compact('monitorias','user'));
    }

    /**
     * View method
     *
     * @param string|null $id Monitoria id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $monitoria = $this->Monitorias->get($id, [
            'contain' => ['Alunos', 'Professores'],
        ]);

        $this->set(compact('monitoria'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Auth->user();
        $user['professor'] = $this->getTableLocator()->get('Professores')->find()->where(['users_id'=>$user['id']])->first();

        $monitoria = $this->Monitorias->newEmptyEntity();
        if ($this->request->is('post')) {
            $monitoria = $this->Monitorias->patchEntity($monitoria, $this->request->getData());
            $monitoria->status = 1;
            $monitoria->professore = $user['professor'];

            if ($this->Monitorias->save($monitoria)) {
                $inicio = new \DateTime($this->request->getData()['inicio']);
                $fim = new \DateTime($this->request->getData()['fim']);
                $this->criarSemanas($inicio, $fim, $monitoria);
                 $this->Flash->success(__('Monitoria criada com sucesso!'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The monitoria could not be saved. Please, try again.'));
        }
        $alunos = $this->Monitorias->Alunos
            ->find('list')
            ->contain(['Users','Cursos'])
            ->where(['Users.categoria'=>'MONITOR'])
            ->order(['nome'])->all();
        $professores = $this->Monitorias->Professores->find('list')->all();
        $this->set(compact('monitoria', 'alunos', 'professores', 'user'));
    }

    private function criarSemanas($inicio, $fim, $monitoria){
        $id = 1;
        $comeco = new \DateTime($inicio->format('Y-m-d'));
        $final = new \DateTime($inicio->format('Y-m-d'));
        while(true){
            $dia = $final->format('w');
            while($dia < 5){
                $final->modify('+1 day');
                if($final->format('d/m/Y') == $fim->format('d/m/Y')){
                    break;
                    $final = new \DateTime($fim->format('Y-d-m'));
                }
                $dia++;
            }

            $semana = $this->getTableLocator()->get('Semanas')->newEmptyEntity();
            $semana->descricao = 'Semana '.$id;
            $semana->carga = 10;
            $semana->cumprido = 0;
            $semana->inicio = $comeco;
            $semana->fim = $final;
            $semana->monitoria = $monitoria;

            $this->getTableLocator()->get('Semanas')->save($semana);
            if($final->format('d/m/Y') == $fim->format('d/m/Y')) {
                break;
            }
            $final->modify('+3 day');
            $comeco = new \DateTime($final->format('Y-m-d'));
            $id++;
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Monitoria id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Auth->user();
        $user['professor'] = $this->getTableLocator()->get('Professores')->find()->where(['users_id'=>$user['id']])->first();

        $monitoria = $this->Monitorias->get($id, [
            'contain' => ['Alunos','Professores'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $monitoria = $this->Monitorias->patchEntity($monitoria, $this->request->getData());
            if ($this->Monitorias->save($monitoria)) {
                $this->Flash->success(__('The monitoria has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The monitoria could not be saved. Please, try again.'));
        }
        $alunos = $this->Monitorias->Alunos->find('list')->order(['nome'])->all();
        $professores = $this->Monitorias->Professores->find('list')->order(['nome'])->all();
        $this->set(compact('monitoria', 'alunos', 'professores','user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Monitoria id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $monitoria = $this->Monitorias->get($id);
        if ($this->Monitorias->delete($monitoria)) {
            $this->Flash->success(__('The monitoria has been deleted.'));
        } else {
            $this->Flash->error(__('The monitoria could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function finalizar($id=null)
    {
        $monitoria = $this->Monitorias->get($id);
        $monitoria->status = 0;
        $this->Monitorias->save($monitoria);
        $this->Flash->success('Monitoria finalizada com sucesso!');
        $this->redirect(['action'=>'index']);
    }

}//Fim da Classe
