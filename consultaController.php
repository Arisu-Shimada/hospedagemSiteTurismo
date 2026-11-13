<?php
require_once 'AutController.php';

$controller = new PontosController();

$acao = $_GET['acao'] ?? 'index';
switch ($acao) {
    case 'pesquisar':
        $controller->pesquisar();
        break;
    case 'detalhe':
        $controller->detalhe();
        break;
     default:
        $controller->index();
}
class PontosController {
    private $pasta_imagens = "imagens_produto/"; // pasta para salvar imagens dos produtos
    private $ext_imagem = ".jpg"; // extensão padrão para todas as imagens

    public function index() {
        $pdo = getConnection();
        $stmt = $pdo->query("SELECT * FROM pontos ORDER BY id DESC");

        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include '_cabecalho.php';
        include 'listaConsulta.php';
        include '_rodape.php';
    }

    public function pesquisar() {
        $pdo = getConnection();
        $busca = $_POST['busca'] ?? '';

        $stmt = $pdo->prepare("SELECT * FROM pontos WHERE nome LIKE :busca ORDER BY id DESC");
        $stmt->execute([':busca' => '%' . $busca . '%']);
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include '_cabecalho.php';
        include 'listaConsulta.php';
        include '_rodape.php';
    }
    public function detalhe() {
        $id = $_GET['id'];
        $pdo = getConnection();
        $stmt = $pdo->prepare("SELECT * FROM pontos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $dado = $stmt->fetch(PDO::FETCH_ASSOC);

        include '_cabecalho.php';
        include 'detalheConsulta.php';
        include '_rodape.php';
    }


}
