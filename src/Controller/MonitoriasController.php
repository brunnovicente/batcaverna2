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
                if (in_array($this->request->getParam('action'), ['index'])) {
                    return true;
                }
            } else {
                if (in_array($this->request->getParam('action'), [])){
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

        $monitorias = $this->Monitorias->find()->contain(['Professores','Alunos']);

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
                $this->Flash->success(__('Monitoria criada com sucesso!'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The monitoria could not be saved. Please, try again.'));
        }
        $alunos = $this->Monitorias->Alunos->find('list')->order(['nome'])->all();
        $professores = $this->Monitorias->Professores->find('list')->all();
        $this->set(compact('monitoria', 'alunos', 'professores', 'user'));
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
}
