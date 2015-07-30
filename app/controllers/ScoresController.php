<?php
class ScoresController extends ControllerBase {
    public function indexAction(){
        parent::setLinks();
        parent::setActive('scores');
        $this->view->navlinks = parent::getLinks();
        $this->view->setTemplateAfter('common');
    }
}
