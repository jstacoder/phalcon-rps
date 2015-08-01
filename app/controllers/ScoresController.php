<?php
class ScoresController extends ControllerBase {
    public function indexAction(){
        parent::initalize();
        parent::setLinks();
        parent::setActive('scores');
        $this->view->navlinks = parent::getLinks();
        $this->view->setTemplateAfter('common');
        $this->view->page_header = 'High Scores';
    }
}
