<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index(){
        if($this->Auth->User('id')){
            $user = $this->Users->get($this->Auth->User('id'));
            $this->set(compact('user', $user));
        }
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add(){
        if($this->Auth->User('id')) return $this->redirect('/');
        $user = $this->Users->newEntity();
        if($this->request->is('post')){
            $user = $this->Users->patchEntity($user, $this->request->data);
            if($this->Users->save($user)){
                $this->Flash->success('well done you are registered and can login');
                return $this->redirect(['action' => 'login']);
            }
            else{
                $errors = $user->errors();
                foreach($errors as $error){
                    foreach($error as $msg){
                        $this->Flash->error($msg);
                    }
                }
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('Votre compte a étais supprimer !'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->logout();
    }

    public function login(){
        if(!$this->request->session()->read('id')){
            if($this->request->is('post')){
                $user = $this->Auth->Identify();
                if($user){
                    $this->Auth->setUser($user);
                    $session = $this->request->session();
                    $session->write('id', $user['id']);
                    return $this->redirect('/');
                }
                $this->Flash->error('Mauvais identifiant ou mot de passe !');
            }
            return $this->redirect('/');
        }
        else{
            return $this->redirect('/');
        }
    }

   public function logout(){
       $this->Flash->success('Vous êtes déconnecter');
       $this->request->session()->delete('id');
       $this->Auth->logout();
       return $this->redirect('/');
   }


   public function beforeFilter(Event $event){
       if($this->Auth->User('id')){
           $this->layout = 'user';
       }
        $this->Auth->allow(['register']);
        $this->Auth->allowedActions = ['login', 'logout', 'add', 'index', 'delete'];

   }

}
