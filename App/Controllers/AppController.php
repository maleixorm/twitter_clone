<?php

namespace App\Controllers;

use App\Models\Usuario;
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {
    
    public function validaAutenticacao() {
        session_start();
        if (!isset($_SESSION['id']) || empty($_SESSION['id']) || !isset($_SESSION['nome']) || empty($_SESSION['nome'])) {
            header('Location: /?login=erro');
        }
    }
    
    public function timeline() {
        $this->validaAutenticacao();
        $tweet = Container::getModel('Tweet');
        $tweet->__set('id_usuario', $_SESSION['id']);
        $tweets = $tweet->getAll();
        $this->view->tweets = $tweets;
        $this->render('timeline');
        
    }

    public function tweet() {
        $this->validaAutenticacao();
        $tweet = Container::getModel('Tweet');
        $tweet->__set('tweet', $_POST['tweet']);
        $tweet->__set('id_usuario', $_SESSION['id']);
        $tweet->salvar();
    }


    public function quemSeguir() {
        $this->validaAutenticacao();
        $this->render('quemSeguir');
    }
}