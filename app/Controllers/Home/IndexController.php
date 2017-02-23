<?php
namespace Plu\Admin\Controllers\Home;

use Phalcon\Mvc\Controller as ControllerBase;

/**
 * @RoutePrefix('/')
 */
class IndexController extends ControllerBase {
    /**
     *
     *@Route('/')
     */
    public function indexAction() {
        
        $this->view->setVar('title', "管理后台首页");
        $this->view->pick('home/index/index');
    }
}
