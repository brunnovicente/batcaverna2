<?php

namespace App\Controller;


use DateTime;

class PrincipalController extends AppController
{

    public function index(){
        $user = $this->Auth->user();
        $user['professor'] = $this->getTableLocator()->get('Professores')->find()->where(['users_id'=>$user['id']])->first();

        $curso = $this->getTableLocator()->get('Cursos')
            ->find()
            ->where(['Cursos.professores_id'=>$user['professor']->id])->first();


        $solicitacoes_abertas = $this->getTableLocator()
            ->get('Solicitacoes')->find()
            ->contain(['Diarios.Turmas.Cursos'])
            ->where(['Solicitacoes.status' => 1])
            ->all();
        $abertas = 0;
        $fechar = 0;
        foreach ($solicitacoes_abertas as $sol){
            $dias = ((new DateTime())->diff(new DateTime(''.$sol->data->format('y-m-d'))))->d;
            if($sol->diario->turma->curso->id == $curso->id){
                $abertas++;
                if($dias > 2){
                    $fechar++;
                }
            }

        }

        $solicitacoes_pendentes = $this->getTableLocator()
            ->get('Solicitacoes')->find()
            ->contain(['Diarios.Turmas.Cursos'])
            ->where(['Solicitacoes.status' => 0])
            ->all();
        $pendentes = 0;
        $abrir = 0;

        foreach ($solicitacoes_pendentes as $sol){
            $dias = (new DateTime(''.$sol->data->format('y-m-d')))->diff(new DateTime())->d;
            if($sol->diario->turma->curso->id == $curso->id){
                $pendentes++;
                if($dias < 1){
                    $abrir ++;
                }
           }
        }



        $this->set(compact('user','abertas','pendentes','fechar','abrir'));
    }

    public function isAuthorized($user)
    {
//        if (in_array($user['categoria'], ['ADMINISTRADOR'])) {
//            return true;
//        } else {
//            return true;
//        }

        return true;
    }

}
