<?php
session_start();
require_once 'db.php';

$acao = $_GET['acao'] ?? '';
switch ($acao) {
    case 'loginForm':
        AutController::loginForm();
        break;
    case 'login':
        AutController::login();
        break;
    case 'logout':
        AutController::logout();
        break;
}

class AutController {

    public static function loginForm() {
        include '_cabecalho.php';
        include 'formLogin.php';
        include '_rodape.php';
    }

    public static function login() {
        $pdo = getConnection();
        $stmt = $pdo->prepare("SELECT * FROM usuarios
                                WHERE usuario = :usuario
                                and senha = :senha");
        $stmt->execute([':usuario' => $_POST['usuario'],
                        ':senha' => $_POST['senha']]);
        $usuarioDb = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuarioDb) {
            $_SESSION['usuario'] = $usuarioDb['usuario'];
            header("Location: pontosController.php");
            exit;
        } else {
            self::loginForm();
        }
    }

    public static function logout() {
        session_destroy();
        header("Location: AutController.php?acao=loginForm");
        exit;
    }

    public static function verificarAutenticacao() {
        if (self::getUsuarioLogado()==null) {
            header("Location: AutController.php?acao=loginForm");
            exit;
        }
    }

    public static function getUsuarioLogado() {
        return $_SESSION['usuario'] ?? null;
    }
}
