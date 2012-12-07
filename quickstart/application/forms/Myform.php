<?php

class Application_Form_Myform extends Zend_Form
{
    public function __construct($options = null)
    {
        parent::__construct($options);

        $this->setAttrib('enctype', 'multipart/form-data');

        $image = new Zend_Form_Element_File('image');
        $image->setLabel('Image:')
            ->addValidator('Size', false, 1024000)
            ->addValidator('Extension', false, 'jpg,png,gif');

        $submit = new Zend_Form_Element_Submit('go');
        $submit->setLabel('Submit');

        $elements = array($image, $submit);
        $this->addElements($elements);
    }
}