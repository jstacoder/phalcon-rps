<?php

class PlayersController extends ControllerBase {
    public function indexAction(){

    }
    public function getAction(){
        if(!$this->request->isPost()){
            return $this->resopnse->redirect('/players');
        }
        if($name = $this->request->getPost('name')){
            $user = User::findFirstByName($name); //get_or_create('name',$this->request->getPost('name'));
            if($user && $user->check_pw($this->request->getPost('password'))){
                $this->flashSession->success("Welcome $name");
                $this->dispatcher->forward(
                    array(
                        "controller"=>"index",
                        "action"=>"index"
                    )
                );
            }else{
                $this->flashSession->error('login failed');
                $this->session->heldname = $name;
                return $this->response->redirect(
                    'menu/play'
                );
            }
        }
    }
    public function listAction(){
        $users = User::find();
        foreach($users as $user){
            $user->setPassword($user->getPassword());
        }
        $this->view->users = $users;
    }
    public function addAction(){
        if(!$this->request->isPost()){
            return $this->response->redirect('/');
        }
        $name = $this->request->getPost('name');
        if($user = User::findFirstByName($name)){
            $this->flashSession->warning("$name is already registered");
            return $this->response->redirect('/users/login');
        }
        $user = new User();
        if($success = $user->save($this->request->getPost(),array('name','password'))){
            $this->flash->success("Thank you for registering $name");
            $this->dispatcher->forward(
                array(
                    "controller"=>"index",
                    "action"=>"index"
                )
            );
        }
    }
    public function detailAction($user_id){

    }
    public function editAction($user_id){

    }
}
