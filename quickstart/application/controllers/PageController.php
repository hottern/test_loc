<?php

class PageController extends Zend_Controller_Action
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

        $field = $this->getRequest()->getParam('field_name');
        $sort = $this->getRequest()->getParam('sort');
       // $order = $this->getRequest()->getParam('order');

        $Guestbook = new Application_Model_DbTable_Guestbook();
        $this->view->entries = $Guestbook->fetchAll($Guestbook->select()->order("$field $sort" ));
        $this->renderScript('page/index.phtml');
       // $Guestbook = new Application_Model_DbTable_Guestbook();
        // $result = $Guestbook->fetchRow($Guestbook->select()->where('id = 2'));

       // $result = $Guestbook->fetchrow("id = $id" );
       // var_dump($result);die();
      //  foreach ($result as $item) {
            //    echo var_dump($item->text);
     //   }
     //   $this->view->Guestbook = $result;
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
        $form    = new Application_Form_Form();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {

                $comment = new Application_Model_Page($form->getValues());
                $mapper  = new Application_Model_GuestbookMapper();
                $mapper->save($comment);
                return $this->_helper->redirector('index');
            }
        }
        $this->view->form = $form;
    }

    public function myformAction()
    {
        $this->view->headTitle('Home');
        $this->view->title = 'Zend_Form_Element_File Example';
        $this->view->bodyCopy = "<p>Please fill out this form.</p>";

        $form = new Application_Form_Myform();

        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {

                // success - do something with the uploaded file
                $uploadedData = $form->getValues();
                $fullFilePath = $form->file->getFileName();

                Zend_Debug::dump($uploadedData, '$uploadedData');
                Zend_Debug::dump($fullFilePath, '$fullFilePath');

                echo "done";
                exit;

            } else {
                $form->populate($formData);
            }
        }

        $this->view->form = $form;

    }

}


