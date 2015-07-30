<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        //$this->view->setContent(print_r(get_class_methods($this->view)));
        //$this->view->disableLevel(\Phalcon\Mvc\View::LEVEL_MAIN_LAYOUT);
        $this->view->setTemplateAfter('common');
    }

}

