<?php

class Application_Model_Myform extends Zend_Form
{
    public function __construct($options = null)
    {
        parent::__construct($options);
        $this->setName('upload');
        $this->setAttrib('enctype', 'multipart/form-data');
        $description = new Zend_Form_Element_Text('description');
        $description->setLabel('Description')
            ->setRequired(true)
            ->addValidator('NotEmpty');
        $file = new Zend_Form_Element_File('file');
        $file->setLabel('File')
            ->addValidator('Size', false, 102400)
            ->addValidator('Extension', false, 'jpg,png,gif')
            ->setDestination(APPLICATION_PATH . '/views')
            ->setRequired(true);
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Upload');
        $this->addElements(array($description, $file, $submit));
    }
}