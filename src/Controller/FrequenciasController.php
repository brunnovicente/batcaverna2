<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Frequencias Controller
 *
 * @property \App\Model\Table\FrequenciasTable $Frequencias
 * @method \App\Model\Entity\Frequencia[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FrequenciasController extends AppController
{
    public function isAuthorized($user)
    {
        if ($user['categoria'] == 'SUPREMO') {
            return true;
        } else {
            if (in_array($user['categoria'], ['COORDENADOR'])) {
                if (in_array($this->request->getParam('action'), ['delete','index','add','edit','entrada','saida'])) {
                    return true;
                }
            } else {
                if (in_array($this->request->getParam('action'), ['index','saida','entrada'])){
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
        if($user['categoria'] == 'MONITOR'){
            $user['aluno'] = $this->getTableLocator()->get('Alunos')->find()->where(['users_id'=>$user['id']])->first();
        }else{
            $user['professor'] = $this->getTableLocator()->get('Professores')->find()->where(['users_id'=>$user['id']])->first();
        }        $monitoria = $this->getTableLocator()->get('Monitorias')->get($id, ['contain'=>['Professores','Alunos']]);
        $frequencias = $this->Frequencias->find()->contain(['Semanas.Monitorias'])->where(['Monitorias.id'=>$id]);

        $this->set(compact('user','frequencias','monitoria'));
    }

    /**
     * View method
     *
     * @param string|null $id Frequencia id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $frequencia = $this->Frequencias->get($id, [
            'contain' => ['Semanas'],
        ]);

        $this->set(compact('frequencia'));
    }

    public function entrada($id=null)
    {
        $user = $this->Auth->user();
        $user['aluno'] = $this->getTableLocator()->get('Alunos')->find()->where(['users_id' => $user['id']])->first();

        $frequencia = $this->Frequencias->newEmptyEntity();
        $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
        $dia = date("w");
        $hoje = date('Y-m-d');

        $semana = $this->getTableLocator()->get('Semanas')->find()
            ->contain(['Monitorias'])
            ->where([
                'Semanas.inicio <=' => $hoje,
                'Semanas.fim >=' => $hoje,
                'Monitorias.id' => $id
            ])->first();
        if ($semana) {
            if (count($this->Frequencias->find()->where(['Frequencias.semanas_id'=>$semana->id,'Frequencias.status'=>0])->all()) <= 0) {
                $frequencia->dia = $diasemana[$dia];
                $frequencia->semanas_id = $semana->id;
                $frequencia->status = 0;

                $this->Frequencias->save($frequencia);
                $this->Flash->success('Frequência de entrada registrada com sucesso!');
            } else {
                $this->Flash->error('Existem frequências em aberto!');
            }

            $this->redirect(['controller' => 'frequencias', 'action' => 'index', $id]);
        }else{
            $this->Flash->warning('Você não está em período de monitoria!');
            $this->redirect(['controller' => 'frequencias', 'action' => 'index', $id]);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Frequencia id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function saida($id = null)
    {
        $frequencia = $this->Frequencias->get($id, [
            'contain' => ['Semanas.Monitorias'],
        ]);
        $frequencia->status = 1;

        //CALCULANDO AS HORAS
        $data = new \DateTime();
        $diferenca = $frequencia->created->diff($data);
        $frequencia->horas = $diferenca->format('%h') + $diferenca->format('%i')/60;
        $frequencia->saida = $data;

        $frequencia->semana->cumprido += $frequencia->horas;
        $this->Frequencias->save($frequencia);
        $this->getTableLocator()->get('Semanas')->save($frequencia->semana);
        $this->Flash->success('Frequencia registrada com sucesso!');

        $this->redirect(['controller'=>'frequencias','action'=>'index', $frequencia->semana->monitoria->id]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
        $user = $this->Auth->user();
        $user['professor'] = $this->getTableLocator()->get('Professores')->find()->where(['users_id' => $user['id']])->first();

        $monitoria = $this->getTableLocator()->get('Monitorias')->get($id, ['contain'=>['Alunos','Professores']]);
        $frequencia = $this->Frequencias->newEmptyEntity();
        $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');

        //$hoje = date('Y-m-d');


        if ($this->request->is('post')) {
            $frequencia = $this->Frequencias->patchEntity($frequencia, $this->request->getData());

            $semana = $this->getTableLocator()->get('Semanas')->find()
                ->contain(['Monitorias'])
                ->where([
                    'Semanas.inicio <=' => $frequencia->created,
                    'Semanas.fim >=' => $frequencia->created,
                    'Monitorias.id' => $id,
                ])->first();

            $frequencia->dia = $diasemana[$frequencia->created->format('w')];
            $frequencia->semana = $semana;
            $frequencia->status = 1;
            $diferenca = $frequencia->created->diff($frequencia->saida);
            $frequencia->horas = $diferenca->format('%h') + $diferenca->format('%i')/60;

            $semana->cumprido += $frequencia->horas;
            //var_dump($frequencia->getErrors());
            //exit();
            if ($this->Frequencias->save($frequencia)) {
                //$this->getTableLocator()->get('Semanas')->save($semana);
                $this->Flash->success(__('Frequencia registrada com sucesso.'));

                $this->redirect(['controller'=>'frequencias','action'=>'index', $monitoria->id]);
            }else{
                $this->Flash->error(__('The frequencia could not be saved. Please, try again.'));
            }

        }
        $semanas = $this->Frequencias->Semanas->find('list', ['limit' => 200])->all();
        $this->set(compact('frequencia', 'semanas', 'user','monitoria'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Frequencia id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Auth->user();
        $user['professor'] = $this->getTableLocator()->get('Professores')->find()->where(['users_id' => $user['id']])->first();

        $frequencia = $this->Frequencias->get($id, [
            'contain' => ['Semanas.Monitorias.Alunos','Semanas.Monitorias.Professores'],
        ]);
        if($frequencia->status == 0){
            $this->Flash->error(__('A frequência está em aberto!'));
            return $this->redirect(['action' => 'index', $frequencia->semana->monitoria->id]);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $frequencia = $this->Frequencias->patchEntity($frequencia, $this->request->getData());
            $diferenca = $frequencia->created->diff($frequencia->saida);
            $frequencia->horas = $diferenca->format('%h') + $diferenca->format('%i')/60;

            if ($this->Frequencias->save($frequencia)) {
                $this->calcular_cumpridas($frequencia->semana->id);
                $this->Flash->success(__('Frequência alterada com sucesso!'));
                return $this->redirect(['action' => 'index', $frequencia->semana->monitoria->id]);
            }
            $this->Flash->error(__('The frequencia could not be saved. Please, try again.'));
        }
        $semanas = $this->Frequencias->Semanas->find('list', ['limit' => 200])->all();
        $this->set(compact('frequencia', 'semanas','user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Frequencia id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //$this->request->allowMethod(['post', 'delete']);
        $frequencia = $this->Frequencias->get($id, ['contain'=>'Semanas']);
        if ($this->Frequencias->delete($frequencia)) {
            $this->calcular_cumpridas($frequencia->semana->id);
            $this->Flash->success(__('Frequencia excluída com sucesso!'));
        } else {
            $this->Flash->error(__('The frequencia could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', $frequencia->semana->id]);
    }

    private function calcular_cumpridas($id)
    {
        $semana = $this->getTableLocator()->get('Semanas')->get($id);
        $frequencias = $this->Frequencias->find()->where(['semanas_id'=>$semana->id])->all();
        $horas = 0;
        foreach ($frequencias as $frequencia){
            $horas += $frequencia->horas;
        }
        $semana->cumprido = $horas;
        $this->getTableLocator()->get('Semanas')->save($semana);
    }

}
