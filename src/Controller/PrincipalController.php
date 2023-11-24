<?php

namespace App\Controller;



use Cake\Mailer\Mailer;

class PrincipalController extends AppController
{

    public function index(){
        $user = $this->Auth->user();
        $user['professor'] = $this->getTableLocator()->get('Professores')->find()->where(['users_id'=>$user['id']])->first();
        $this->set(compact('user'));
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
