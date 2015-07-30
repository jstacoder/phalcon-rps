<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        parent::setLinks();
        parent::setActive('home');
        $this->view->navlinks = parent::getLinks();
        //$this->view->disableLevel(\Phalcon\Mvc\View::LEVEL_MAIN_LAYOUT);
        $this->view->setTemplateAfter('common');
        $this->view->ctrl = $this->dispatcher->getControllerName();
    }
}

