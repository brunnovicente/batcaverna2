<?php

namespace App\Controller;

use Cake\Event\EventInterface;

class HomeController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event); // TODO: Change the autogenerated stub
        $this->Auth->allow(['nota']);
    }

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

    public function nota(){
        $this->viewBuilder()->setLayout('login');
    }

}
