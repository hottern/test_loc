<?php

class Url_Validator extends Zend_Validate_Abstract
{
    const INVALID_URL = 'invalidUrl';

    protected $_messageTemplates = array(
        self::INVALID_URL => "'%value%' is not a valid URL.",
    );

    public function isValid($value)
    {
        $valueString = (string) $value;
        $this->_setValue($valueString);

        if (!Zend_Uri::check($value)) {
            $this->_error(self::INVALID_URL);
            return false;
        }
        return true;
    }
}

class Application_Model_Form extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        // add name
        $this->addElement('text', 'user', array(
            'label'      => 'User:',
            'required'   => true,
            //'filters'    => array('StringTrim'),
            'validators' => array(
                'alnum',
                array('regex', false, '/^[a-z]/i')
            )
        ));


        // Add an email element
        $this->addElement('text', 'email', array(
            'label'      => 'Email:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                'EmailAddress',
            )
        ));


        // Add an homepage element
        $this->addElement('text', 'homepage', array(
            'label'      => 'Homepage:',
            'required'   => false,
            'filters'    => array('StringTrim'),
            'validators' => array(
                new Url_Validator
            )
        ));


        // Add the comment element
        $this->addElement('textarea', 'comment', array(
            'label'      => 'Comment:',
            'required'   => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 2000))
            )
        ));
        // Add a captcha
        $this->addElement('captcha', 'captcha', array(
            'label'      => 'Wite 5 symbol from the picture :',
            'required'   => true,
            'captcha'    => array(
                'captcha' => 'Figlet',
                'wordLen' => 5,
                'timeout' => 300
            )
        ));
        // добавить
        $this->addElement('submit', 'Добавить', array(
            'ignore'   => true,
            'label'    => 'Sign Guestbook',
        ));
        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
}