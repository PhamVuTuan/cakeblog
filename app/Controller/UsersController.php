<?php

class UsersController extends AppController
{

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('add','logout');

    }

    public function isAuthorized($user) {

        if(in_array($this->action,array('edit','delete')))
        {
            if($user['role'] !== 'admin')/// Only Admin can access
            {
                return false;
            }
        }
        return true;
    }

    public function index()
    {
       // $this->Session->destroy();

       // debug($this->Auth->user('role'));

    }

    public function edit()
    {
        // $this->Session->destroy();

       // debug($this->Auth->user('role'));
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
            if($this->Auth->login())
            {
                return $this->redirect($this->Auth->redirectUrl());
               ///$this->Auth->redirectUrl() sẽ tự động gọi tới loginRedirect dc quy định trong $components in AppController
            }
            $this->Session->setFlash(__('Your username or password was incorrect.'));
        }
    }
    public function logout()
    {
       return $this->redirect($this->Auth->logout());
    }

}