<?php

class PostsController extends AppController
{
    public function isAuthorized($user)
    {
        if(in_array($this->action,array('edit','delete')))
        {
            $postId = (int) $this->request->params['pass'][0];

            if($this->Post->isOwnedBy($postId,$user['id']))
            {
                return true;
            }
           return false;
        }

    }
    public function index()
    {
        //  $this->User->id = 6;
       // echo $this->Post->field('title',array('id'=>10,'user_id'=>7));
        $this->set('posts', $this->Post->find('all'));
    }

    public function view($id = null)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
    }

    public function add()
    {
        if($this->request->is('post'))
        {
            //$this->Post->create();
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');

            if($this->Post->save($this->request->data)){
                $this->Session->setFlash(__('Your post has been saved.'));

                return $this->redirect(array('action' => 'index'));
            }

        }
    }

    public function edit($id = null) {
       // debug($this->request->params);
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }


        if ($this->request->is('post'))
        {
           // debug($post);exit;

            $this->Post->id = $id;

            if ($this->Post->save($this->request->data)) {

                $this->Session->setFlash(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }

    public function delete($id = null)
    {
       /* if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }*/

        if ($this->Post->delete($id)) {
            $this->Session->setFlash(
                __('The post with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Session->setFlash(
                __('The post with id: %s could not be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'index'));
    }
}