<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Professores Controller
 *
 * @property \App\Model\Table\ProfessoresTable $Professores
 * @method \App\Model\Entity\Professore[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProfessoresController extends AppController
{
    public function isAuthorized($user)
    {
        if ($user['categoria'] == 'SUPREMO') {
            return true;
        } else {
            if(in_array($user['categoria'], ['COORDENADOR'])){
                if (in_array($this->request->getParam('action'), ['view','senha','login','logout','acesso'])) {
                    return true;
                }
            }else{
                return false;
            }
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $user = $this->Auth->user();
        $user['professor'] = $this->getTableLocator()->get('Professores')
            ->find()
            ->where(['Professores.users_id' => $user['id']])
            ->first();

        $this->set(compact('user'));

        if ($this->request->is('post')) {
            $dados = $this->request->getData();

            $professores = $this->Professores->find()
                ->where(['Professores.nome LIKE' => '%' . $dados['nome'] . '%'])
                ->order(['Professores.nome'])->all();
            $this->set(compact('professores'));
        } else {
            $professores = $this->Professores
                ->find()
                ->order(['Professores.nome'])
                ->all();
            $this->set(compact('professores'));
        }
    }

    /**
     * View method
     *
     * @param string|null $id Professore id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $professore = $this->Professores->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('professore'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $professore = $this->Professores->newEmptyEntity();
        if ($this->request->is('post')) {
            $professore = $this->Professores->patchEntity($professore, $this->request->getData());
            if ($this->Professores->save($professore)) {
                $this->Flash->success(__('The professore has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The professore could not be saved. Please, try again.'));
        }
        $users = $this->Professores->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('professore', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Professore id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $professore = $this->Professores->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $professore = $this->Professores->patchEntity($professore, $this->request->getData());
            if ($this->Professores->save($professore)) {
                $this->Flash->success(__('The professore has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The professore could not be saved. Please, try again.'));
        }
        $users = $this->Professores->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('professore', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Professore id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $professore = $this->Professores->get($id);
        if ($this->Professores->delete($professore)) {
            $this->Flash->success(__('The professore has been deleted.'));
        } else {
            $this->Flash->error(__('The professore could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
