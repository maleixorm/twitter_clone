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
        $pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';
        $usuarios = [];
        if (!empty($pesquisarPor)) {
            $usuario = Container::getModel('Usuario');
            $usuario->__set('nome', $pesquisarPor);
            $usuario->__set('id', $_SESSION['id']);
            $usuarios = $usuario->getAll();
        }
        $this->view->usuarios = $usuarios;
        $this->render('quemSeguir');
    }

    public function acao() {
        $this->validaAutenticacao();
        $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
        $id_usuario_seguindo = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';
        $usuario = Container::getModel('Usuario');
        $usuario->__set('id', $_SESSION['id']);
        if ($acao == 'seguir') {
            $usuario->seguirUsuario($id_usuario_seguindo);
        } elseif ($acao == 'deixar_de_seguir') {
            $usuario->deixarSeguirUsuario($id_usuario_seguindo);
        }
        header('Location: /quem_seguir');
    }

    public function removerTweet() {
        $this->validaAutenticacao();
        $id_tweet = isset($_GET['id']) ? $_GET['id'] : '';
        $tweet = Container::getModel('Tweet');
        $tweet->__set('id', $id_tweet);
        $tweet->remover();
        header('Location: /timeline');
    }
}