<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Semanas Controller
 *
 * @property \App\Model\Table\SemanasTable $Semanas
 * @method \App\Model\Entity\Semana[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SemanasController extends AppController
{

    public function isAuthorized($user)
    {
        if ($user['categoria'] == 'SUPREMO') {
            return true;
        } else {
            if (in_array($user['categoria'], ['COORDENADOR'])) {
                if (in_array($this->request->getParam('action'), ['index','add'])) {
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
    public function index($id)
    {
        $user = $this->Auth->user();
        $user['professor'] = $this->getTableLocator()->get('Professores')->find()->where(['users_id'=>$user['id']])->first();

        $monitoria = $this->getTableLocator()->get('Monitorias')->get($id, ['contain'=>['Professores', 'Alunos']]);

        $semanas = $this->Semanas->find()
            ->where(['Semanas.monitorias_id'=>$monitoria->id])
            ->contain(['Monitorias'])->all();

        $this->set(compact('semanas','user','monitoria'));
    }

    /**
     * View method
     *
     * @param string|null $id Semana id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $semana = $this->Semanas->get($id, [
            'contain' => ['Monitorias'],
        ]);

        $this->set(compact('semana'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
        $user = $this->Auth->user();
        $user['professor'] = $this->getTableLocator()->get('Professores')->find()->where(['users_id'=>$user['id']])->first();
        if($id == null){
            $this->Flash->error(__('Veio com ID null!'));
        }
        $semana = $this->Semanas->newEmptyEntity();
        $monitoria = $this->getTableLocator()->get('Monitorias')->get($id, ['contain'=>['Professores','Alunos']]);
        $semana->monitorias_id = $id;

        if ($this->request->is('post')) {
            $semana = $this->Semanas->patchEntity($semana, $this->request->getData());
            $semana->cumprido = 0;
            if ($this->Semanas->save($semana)) {
                $this->Flash->success(__('Semana adicionada com sucesso!'));

                return $this->redirect(['action' => 'index', $semana->monitorias_id]);
            }
            $this->Flash->error(__('Erro ao adicionar a semana!'));
        }
        $monitorias = $this->Semanas->Monitorias->find('list', ['limit' => 200])->all();
        $this->set(compact('semana', 'monitorias', 'user', 'monitoria'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Semana id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Auth->user();
        $user['professor'] = $this->getTableLocator()->get('Professores')->find()->where(['users_id'=>$user['id']])->first();

        $semana = $this->Semanas->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $semana = $this->Semanas->patchEntity($semana, $this->request->getData());
            if ($this->Semanas->save($semana)) {
                $this->Flash->success(__('The semana has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The semana could not be saved. Please, try again.'));
        }
        $monitorias = $this->Semanas->Monitorias->find('list', ['limit' => 200])->all();
        $this->set(compact('semana', 'monitorias','user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Semana id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $semana = $this->Semanas->get($id);
        if ($this->Semanas->delete($semana)) {
            $this->Flash->success(__('The semana has been deleted.'));
        } else {
            $this->Flash->error(__('The semana could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
