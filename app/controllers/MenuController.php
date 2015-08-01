<?php

class MenuController extends ControllerBase {
    public function indexAction(){
        parent::initalize();
        parent::setLinks();
        parent::setActive('menu');
        $this->view->navlinks = parent::getLinks();
        $this->flashsession->success('made it to the home page');
    }
    public function playAction(){

        parent::initalize();
        if($this->request->isPost()){
            $this->view->name = $this->request->getPost('name');
            $this->session->current_player = $this->view->name;
            $this->view->current_player = $this->view->name;
        }
        $this->view->form = new PlayerForm();
        if($name = $this->session->heldname){
            $this->view->form->get('name')->setDefault($name);
        }
        //die(print_r(get_class_methods($this->view->form)));
        parent::setLinks();
        $this->view->navlinks = parent::getLinks();
        $this->view->setTemplateAfter('play');
        $this->flash->success('get ready to play');
    }
}
