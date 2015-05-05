<?php

class UsersController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('add','logout');
    }
    public function index()
    {
       // $this->Session->destroy();
    }
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function login()
    {
        if($this->request->is('post'))
        {
            //debug($this->request->data);exit;
            if($this->Auth->login())
            {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }
    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

}