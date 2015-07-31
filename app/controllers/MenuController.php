<?php

class MenuController extends ControllerBase {
    public function indexAction(){
        parent::setLinks();
        parent::setActive('menu');
        $this->view->navlinks = parent::getLinks();
        $this->flashsession->success('made it to the home page');
    }
    public function playAction(){
        parent::setLinks();
        $this->view->navlinks = parent::getLinks();
        $this->view->setTemplateAfter('play');
        $this->flash->success('get ready to play');
    }
}
