<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Turmas Controller
 *
 * @property \App\Model\Table\TurmasTable $Turmas
 * @method \App\Model\Entity\Turma[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TurmasController extends AppController
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

        $turmas =$this->Turmas->find()->contain(['Cursos'])->where(['Cursos.professores_id'=>$user['professor']->id])->all();

        $this->set(compact('turmas','user'));
    }

    /**
     * View method
     *
     * @param string|null $id Turma id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $turma = $this->Turmas->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('turma'));
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
        $turma = $this->Turmas->newEmptyEntity();
        if ($this->request->is('post')) {
            $turma = $this->Turmas->patchEntity($turma, $this->request->getData());
            $turma->status = 1;
            if ($this->Turmas->save($turma)) {
                $this->Flash->success(__('The turma has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The turma could not be saved. Please, try again.'));
        }
        $cursos = $this->Turmas->Cursos->find('list', ['limit' => 200])->all();

        $this->set(compact('turma','cursos','user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Turma id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Auth->user();
        $user['professor'] = $this->getTableLocator()->get('Professores')->find()->where(['users_id'=>$user['id']])->first();

        $turma = $this->Turmas->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $turma = $this->Turmas->patchEntity($turma, $this->request->getData());
            if ($this->Turmas->save($turma)) {
                $this->Flash->success(__('The turma has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The turma could not be saved. Please, try again.'));
        }
        $cursos = $this->Turmas->Cursos->find('list')->all();
        $this->set(compact('turma', 'user', 'cursos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Turma id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $turma = $this->Turmas->get($id);
        if ($this->Turmas->delete($turma)) {
            $this->Flash->success(__('The turma has been deleted.'));
        } else {
            $this->Flash->error(__('The turma could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
