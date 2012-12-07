<?php

require_once APPLICATION_PATH . '/../public/js/ckeditor/ckeditor.php';

// папка где лежит редактор


class Izwt_View_Helper_FormWysiwyg extends Zend_View_Helper_FormElement
{

    public function formWysiwyg($name = null, $value = null, $attribs = null)
    {
        if (is_null($name) && is_null($value) && is_null($attribs)) {
            return $this;
        }
        $info = $this->_getInfo($name, $value, $attribs);
        extract($info); // name, value, attribs, options, listsep, disable

        $editor = new CKEditor();
        // пусть возвращает значение, а не выводит в браузер
        $editor->returnOutput = true;

        // задаем базовый путь к визуальному редактору
        $editor->basePath = '/js/ckeditor/';

        // ширина редактора
        $editor->config['width'] = 600;

        // $value содержит значение по умолчанию
        return $editor->editor('wysiwyg', $value);
    }

}