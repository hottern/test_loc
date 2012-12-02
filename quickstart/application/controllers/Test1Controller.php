<?php

class TextController extends Zend_Controller_Action
{

    public function init()
    {
        die('3');
        $Guestbook = new Application_Model_DbTable_Guestbook();
        $result = $Guestbook->fetchRow($Guestbook->select()->where('id = 2'));
        var_dump($result->text);die();
        $result = $Guestbook->fetchAll();
        foreach ($result as $item) {
            echo var_dump($item->text);
        }
        die();
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }


}

