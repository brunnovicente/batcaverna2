<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Chronos\Date;

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
                if (in_array($this->request->getParam('action'), ['index','add','edit'])) {
                    return true;
                }
            } else {
                if (in_array($this->request->getParam('action'), ['index','add','edit'])){
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
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
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
    public function edit($id = null)
    {
        $frequencia = $this->Frequencias->get($id, [
            'contain' => ['Semanas.Monitorias'],
        ]);
        $frequencia->status = 1;

        //CALCULANDO AS HORAS
        $data = new \DateTime();
        $diferenca = $frequencia->created->diff($data);
        $frequencia->horas = $diferenca->format('%h') + $diferenca->format('%i')/60;

        $frequencia->semana->cumprido += $frequencia->horas;
        $this->Frequencias->save($frequencia);
        $this->getTableLocator()->get('Semanas')->save($frequencia->semana);
        $this->Flash->success('Frequencia registrada com sucesso!');

        $this->redirect(['controller'=>'frequencias','action'=>'index', $frequencia->semana->monitoria->id]);
    }

}//Fim do Controller
