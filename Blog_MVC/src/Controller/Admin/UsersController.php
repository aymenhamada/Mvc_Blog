<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 *
 * @method \App\Model\Entity\Comment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController{

    public function index(){
        $this->paginate = [
            'limit' => 5
        ];
        $users = $this->paginate($this->Users);
        $this->set(compact('users', $users));
    }


    public function delete($id = null){
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function block($id = null){
        $user = $this->Users->get($id);
        $user->active = false;
        if ($this->Users->save($user)){
            $this->Flash->success(__('The users has been blocked.'));
        } else {
            $this->Flash->error(__('The users could not be blocked, Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function unlock($id = null){
        $user = $this->Users->get($id);
        $user->active = true;
        if ($this->Users->save($user)){
            $this->Flash->success(__('The users has been unlocked'));
        } else {
            $this->Flash->error(__('The users could not be unlocked, Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}