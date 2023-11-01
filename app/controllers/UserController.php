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
}
