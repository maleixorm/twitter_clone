<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;


class IndexController extends Action {
    
    public function index() {
        $this->render('index');
    }
    public function inscreverse() {
        $this->render('inscreverse');
    }
    public function registrar() {
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        // $this->render('registrar');
    }
}