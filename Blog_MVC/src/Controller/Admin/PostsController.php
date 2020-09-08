<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 *
 * @method \App\Model\Entity\Post[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostsController extends AppController{

    public function index(){
        $this->paginate = [
            'limit' => 5,
            'contain' => ['Users', 'Comments']
        ];
        $billets = $this->paginate($this->Posts);
        $this->set(compact('billets', $billets));
    }


    public function delete($id = null)
    {
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}