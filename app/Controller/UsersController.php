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
        $this->set('users', $this->User->find('all'));

    }

    public function edit()
    {

        $id = $this->request->params['pass'][0];
        $this->User->id = $id;
        if( $this->User->exists() ){

            if( $this->request->is( 'post' ) || $this->request->is( 'put' ) ){

                if( $this->User->save( $this->request->data ) ){

                    $this->Session->setFlash('User was edited.');


                    $this->redirect(array('action' => 'index'));

                }else{
                    $this->Session->setFlash('Unable to edit user. Please, try again.');
                }

            }else{

                $this->request->data = $this->User->read();
            }

        }else{
            $this->Session->setFlash('The user you are trying to edit does not exist.');
            $this->redirect(array('action' => 'index'));
        }
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

    public function delete() {
        $id = $this->request->params['pass'][0];
        if( $this->request->is('get') ){

            $this->Session->setFlash('Delete method is not allowed.');
            $this->redirect(array('action' => 'index'));

        }else{

            if( !$id ) {
                $this->Session->setFlash('Invalid id for user');
                $this->redirect(array('action'=>'index'));

            }else{
                if( $this->User->delete( $id ) ){
                    $this->Session->setFlash('User was deleted.');
                    $this->redirect(array('action'=>'index'));

                }else{
                    $this->Session->setFlash('Unable to delete user.');
                    $this->redirect(array('action' => 'index'));
                }
            }
        }
    }




}