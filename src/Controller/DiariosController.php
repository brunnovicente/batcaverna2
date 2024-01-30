<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Diarios Controller
 *
 * @property \App\Model\Table\DiariosTable $Diarios
 * @method \App\Model\Entity\Diario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DiariosController extends AppController
{
    public function isAuthorized($user)
    {
        if ($user['categoria'] == 'SUPREMO') {
            return true;
        } else {
            if (in_array($user['categoria'], ['COORDENADOR'])) {
                if (in_array($this->request->getParam('action'), ['view','senha','login','logout','acesso'])) {
                    return true;
                }
            } else {
                if (in_array($this->request->getParam('action'), ['login','logout'])){
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

        $diarios = $this->Diarios->find()->contain(['Turmas.Cursos','Professores'])->all();

        $this->set(compact('diarios','user'));
    }

    /**
     * View method
     *
     * @param string|null $id Diario id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $diario = $this->Diarios->get($id, [
            'contain' => ['Turmas', 'Professores'],
        ]);

        $this->set(compact('diario'));
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

        $diario = $this->Diarios->newEmptyEntity();
        if ($this->request->is('post')) {
            $diario = $this->Diarios->patchEntity($diario, $this->request->getData());
            if ($this->Diarios->save($diario)) {
                $this->Flash->success(__('The diario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The diario could not be saved. Please, try again.'));
        }
        $turmas = $this->Diarios->Turmas->find('list', ['limit' => 200])->all();
        $professores = $this->Diarios->Professores->find('list', ['limit' => 200])->all();
        $this->set(compact('diario', 'turmas', 'professores','user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Diario id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $diario = $this->Diarios->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $diario = $this->Diarios->patchEntity($diario, $this->request->getData());
            if ($this->Diarios->save($diario)) {
                $this->Flash->success(__('The diario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The diario could not be saved. Please, try again.'));
        }
        $turmas = $this->Diarios->Turmas->find('list', ['limit' => 200])->all();
        $professores = $this->Diarios->Professores->find('list', ['limit' => 200])->all();
        $this->set(compact('diario', 'turmas', 'professores'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Diario id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $diario = $this->Diarios->get($id);
        if ($this->Diarios->delete($diario)) {
            $this->Flash->success(__('The diario has been deleted.'));
        } else {
            $this->Flash->error(__('The diario could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
