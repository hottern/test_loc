<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
//        die('3');
//        $posts = new Application_Model_DbTable_Posts();
//        $result = $posts->fetchRow($posts->select()->where('id = 2'));
//        var_dump($result->text);die();
//        $result = $posts->fetchAll();
//        foreach ($result as $item) {
//            echo var_dump($item->text);
//        }
//        die();
//        /* Initialize action controller here */

    }

    public function indexAction()
    {
        $front = $this->getFrontController();
        var_dump($front);die();
    }


    public function blaAction()
    {
        $front = $this->getFrontController();
        var_dump($front);die();
    }
}

