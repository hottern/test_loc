<?php

class GuestbookController extends Zend_Controller_Action
{

    public function init()
    {


    }

    public function indexAction()
    {

       // $Guestbook = new Application_Model_DbTable_Guestbook();
        // $result = $Guestbook->fetchRow($Guestbook->select()->where('id = 2'));

       // $result = $Guestbook->fetchAll();
       // foreach ($result as $item) {
            //    echo var_dump($item->text);

       // $this->view->Guestbook = $result;
        /* Initialize action controller here */

        $guestbook = new Application_Model_DbTable_Guestbook();
        $this->view->entries = $guestbook->fetchAll();
    }

    public function addAction()
    {
        $name = $this->getRequest()->getParam('name');
        $this->view->name = $name;
    }
    public function showAction()
    {
        $id = $this->getRequest()->getParam('id');

        $Guestbook = new Application_Model_DbTable_Guestbook();
        // $result = $Guestbook->fetchRow($Guestbook->select()->where('id = 2'));

        $result = $Guestbook->fetchrow("id = $id" );
        var_dump($result);die();
        foreach ($result as $item) {
            //    echo var_dump($item->text);
        }
        $this->view->Guestbook = $result;
        /* Initialize action controller here */
    }

    public function  sortdatedescAction()
    {
        $Guestbook = new Application_Model_DbTable_Guestbook();
        $this->view->entries = $Guestbook->fetchAll($Guestbook->select()->order('created DESC'));
        $this->renderScript('guestbook/index.phtml');
    }
    public function  sortdateascAction()
    {
        $Guestbook = new Application_Model_DbTable_Guestbook();
        $this->view->entries = $Guestbook->fetchAll($Guestbook->select()->order('created ASC'));
        $this->renderScript('guestbook/index.phtml');
    }
    public function signAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Model_Form();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $comment = new Application_Model_Guestbook($form->getValues());
                $mapper  = new Application_Model_GuestbookMapper();
                $mapper->save($comment);
                return $this->_helper->redirector('index');
            }
        }
        $this->view->form = $form;
    }

}


