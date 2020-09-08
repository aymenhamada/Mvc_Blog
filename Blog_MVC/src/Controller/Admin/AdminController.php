<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Comments Controller
 *
 *
 * @method \App\Model\Entity\Comment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

class AdminController extends AppController{


    public function index(){
        $this->loadModel('Posts');
        $this->loadModel('Comments');
        $this->loadModel('Users');

        $posts = $this->Posts->find('all')->order(['id' => 'DESC'])->limit(10);
        $this->set(compact('posts', $posts));

        $comments = $this->Comments->find('all')->order(['id' => 'DESC'])->limit(10);
        $this->set(compact('comments', $comments));

        $users = $this->Users->find('all')->order(['id' => 'DESC'])->limit(10);
        $this->set(compact('users', $users));
    }
}
