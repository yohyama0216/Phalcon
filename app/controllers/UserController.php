<?php

use Phalcon\Mvc\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        $user1 = new User();
        $user1->id = 1;
        $user1->name = 'test';
        $user1->email = 'test@example.com';

        $users = [
            $user1,
       ];

        // $users = User::find();
        $this->view->testing = 'usrCon';
        $this->view->users = $users;
    }

    public function createAction()
    {
        if ($this->request->isPost()) {
            $user = new User();
            $user->name = $this->request->getPost('name');
            $user->email = $this->request->getPost('email');
            
            if ($user->save()) {
                $this->flash->success('Registration successful!');
                return $this->response->redirect('/');
            } else {
                // エラーメッセージの取得
                $messages = $user->getMessages();
                foreach ($messages as $message) {
                    $this->flash->error($message->getMessage());
                }
            }
        }

        // ビューの表示
        $this->view->pick('user/create');
    }
}
