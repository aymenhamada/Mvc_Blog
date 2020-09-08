<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;



class ContactController extends AppController{

    public function index($message = null){
        if($message && $message !== 'false'){
            $this->Flash->success('Email successfully send !');
        }
        if($message == 'false'){
            $this->Flash->error('You can\'t send more than 2 email per hours, try later');
        }
    }

    public function sendemail(){
        $this->loadModel('Users');
        $user = $this->Users->get($this->Auth->user('id'));
        $admins = $this->Users->find()
                                ->select(['email'])
                                ->where(['role =' => 'admin'])
                                ->toArray();

        $email = new Email();
        $email->from($this->Auth->User('email'));

        foreach($admins as $admin){
            $email->addCc($admin->email);
        }

        $email->subject($this->request->data['about']);

        if (!strtotime($user->last_contact) || strtotime($user->last_contact) + 3600 < date(time())){
            $user->last_contact = time();
            $user->contact_counter = 1;
        }
        else if (strtotime($user->last_contact) + 3600 > date(time()) && $user->contact_counter < 2){
            $user->contact_counter += 1;
        }
        else{
            return $this->redirect(['controller' => 'Contact', 'action' => 'index', 'false']);
        }
        $this->Users->save($user);
        $email->send('Hi admin a users of the Blog_MVC tried to contact you here is message :  '.$this->request->data['content'].' you can respond him via this email '.$this->Auth->User('email'));
        return $this->redirect(['controller' => 'Contact', 'action' => 'index', true]);
    }

    public function beforeFilter(Event $event){
        $this->layout = 'basic';
    }
    public function isAuthorized($user){
        return true;
    }
}