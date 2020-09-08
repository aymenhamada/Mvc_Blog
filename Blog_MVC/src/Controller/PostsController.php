<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;


/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 *
 * @method \App\Model\Entity\Post[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index(){
        $this->paginate = [
            'limit' => 5,
            'contain' => ['Users', 'Comments']
        ];
        $posts = $this->paginate($this->Posts);

        $this->set(compact('posts'));

        $billets = $this->paginate($this->Posts);
        $this->set(compact('billets'));

        $sessionId = $this->Auth->user('id');
        $this->set(compact('sessionId'));

        $test = $this->Posts->find('all')->contain(['Comments']);
        $this->set(compact('test'));
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $keyword = null){
        if(!$this->Posts->get($id)) return 'a';
        $posts = $this->Posts->get($id, ['contain' => 'Users']);

        if($this->Auth->User('id') !== $posts->user->id){
            $posts->views += 1;
            $this->Posts->save($posts);
        }


        $newComment = $this->Posts->Comments->newEntity();
        if ($this->request->is('post')) {
            $comment = $this->Posts->Comments->patchEntity($newComment, $this->request->getData());
            $comment->user_id = $this->Auth->user('id');
            $comment->post_id = $id;
            if ($this->Posts->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved'));
                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }

        $this->set(compact('keyword'), $keyword);
        $this->set('newComment', $newComment);
        $this->set('post', $posts);
        $commentary = $this->Posts->Comments->find('all')->where(['post_id' => $id])->order(['Comments.id' => 'asc'])->contain(['Users']);
        $this->set(compact('commentary'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function new()
    {
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            $post->user_id = $this->Auth->user('id');
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $this->set(compact('post', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null){
        $post = $this->Posts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            $post->updated = time();
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been edited.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $this->set(compact('post', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['get', 'delete']);
        $post = $this->Posts->get($id, ['Contain' => 'Comments']);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function search($keyword = null){
        if(!empty($keyword)){
           $posts = $this->Posts->find('all')
                                    ->contain(['Users', 'Comments']);
            $this->set(compact('posts'), $posts);
            $this->set(compact('keyword'), $keyword);
        }
        if($this->request->getData()){
            return $this->redirect(['/'.$this->request->getData()['text']]);
        }
    }


    public function popular(){
        $popularBlog = $this->Posts->find()
                                    ->order(['views' => 'DESC'])->limit(1)->contain(['Users', 'Comments']);
        $this->set(compact('popularBlog'), $popularBlog);

        $findActive = $this->Posts->find();
                                    $findActive->select(['count' => $findActive->func()->count('*'), 'user_id'])->group('user_id')->order(['count' => 'desc']);
        $max = 0;
        $userId;
        foreach($findActive as $active){
            if($active->count > $max){
                $max = $active->count;
                $userId = $active->user_id;
            }
        }
        $mostActive = $this->Posts->find()->where(['user_id =' => $userId])->contain(['Users']);
        $this->set(compact('mostActive'), $mostActive);
        $this->set(compact('max'), $max);
    }

    public function isAuthorized($user){
        if(in_array($this->request->action, ['new','add']) && $user['role'] === 'bloggeur') return true;
        if(in_array($this->request->action, ['index', 'view', 'search', 'popular'])) return true;
        if (in_array($this->request->action, ['edit', 'delete']) && $user['role'] === 'bloggeur') {
            if(parent::isAuthorized($user)) return true;
            $id = (int) $this->request->params['pass'][0];
            if ($this->Posts->isOwnedBy($id, $user['id'])) {
                return true;
            }
            return false;
        }
        return parent::isAuthorized($user);
    }

    public function beforeFilter(Event $event){
        $this->layout = 'basic';
        if(in_array($this->request->action, ['new', 'edit'])){
            $this->layout = 'post';
        }
    }
}
