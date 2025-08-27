<?php

namespace App\Controllers;

use App\Models\Usuario;
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {
    
    public function timeline() {
        session_start();

        if (!empty($_SESSION['id']) && !empty($_SESSION['nome'])) {
            $this->render('timeline');
        } else {
            header('Location: /?login=erro');
        }
    }

    public function tweet() {
        session_start();

        if (!empty($_SESSION['id']) && !empty($_SESSION['nome'])) {
            echo '<pre>';
            print_r($_POST);
            echo '</pre>';
        } else {
            header('Location: /?login=erro');
        }
    }
}