<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initRoute(){
        // Получаем маршрут, по-умолчанию
        $router = Zend_Controller_Front::getInstance()->getRouter();
        // создаем пользовательские маршруты
        // маршрут для статических страниц
        $route_static = new Zend_Controller_Router_Route(
            '/:page',
            array(
                'controller' => 'page',
                'action' => 'index',
                'field'  => '[\w\-]+',

            ),
            array(
                'field' => '[\w\-]+'
            )
        );
        $router->addRoute('static', $route_static);
        // маршрут для товаров
        $route_goods = new Zend_Controller_Router_Route(
            'field/:field_name/:sort',
            array(
                'controller' => 'page',
                'action' => 'show',
                'field_name'  => '[\w\-]+',
                'sort'  => '[\w\-]+',
            ),
            array(
                'field_name'  => '[\w\-]+',
                'sort'  => '[\w\-]+',
            )
        );
        $router->addRoute('goods', $route_goods);
    }

}

