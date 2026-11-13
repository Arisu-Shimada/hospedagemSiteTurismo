<?php
require_once 'AutController.php';

if (AutController::getUsuarioLogado()!=null) : 
    endif;

$controller = new PontosController();

$acao = $_GET['acao'] ?? 'index';
switch ($acao) {
    case 'novo':
        $controller->novo();
        break;
    case 'editar':
        $controller->editar();
        break;
    case 'salvar':
        $controller->salvar();
        break;
    case 'excluir':
        $controller->excluir();
        break;
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

    public function __construct() {
        AutController::verificarAutenticacao();
    }

    public function index() {
        $pdo = getConnection();
        $stmt = $pdo->query("SELECT * FROM pontos ORDER BY id DESC");

        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include '_cabecalho.php';
        include 'listaPontos.php';
        include '_rodape.php';
    }

    public function novo(){
        $pdo = getConnection();
        $stmt = $pdo->query("SELECT * FROM pontos");
        include '_cabecalho.php';
        include 'formPontos.php';
        include '_rodape.php';
    }


    public function editar() {
        $id = $_GET['id'];
        $pdo = getConnection();
        $stmt = $pdo->prepare("SELECT * FROM pontos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $dado = $stmt->fetch(PDO::FETCH_ASSOC);


        include '_cabecalho.php';
        include 'formPontos.php';
        include '_rodape.php';
    }

    public function salvar() {
        $pdo = getConnection();
        if ($_POST['id']=="") {
            $stmt = $pdo->prepare("INSERT INTO
                                pontos (nome, descricao, endereco)
                                VALUES (:nome, :descricao, :endereco)");
            $stmt->execute([
                ':nome' => $_POST['nome'],
                ':descricao' => $_POST['descricao'],
                ':endereco' => $_POST['endereco']
            ]);
        } else {
            $stmt = $pdo->prepare("UPDATE pontos SET
                                    nome = :nome, descricao = :descricao, endereco = :endereco
                                    WHERE id = :id");
            $stmt->execute([
                ':nome' => $_POST['nome'],
                ':descricao' => $_POST['descricao'],
                ':endereco' => $_POST['endereco'],
                ':id' => $_POST['id']
            ]);
        }

        $id = $_POST['id'] == '' ? $pdo->lastInsertId() : $_POST['id'];
        $this->uploadImagem($id);

        header("Location: ?acao=index");
        exit;
    }  

    public function excluir() {
        $id = $_GET['id'];
        $pdo = getConnection();
        $stmt = $pdo->prepare("DELETE FROM 
                                pontos 
                                WHERE id = :id");
        $stmt->execute([':id' => $id]);

        $this->excluirImagem($id);

        header("Location: ?acao=index");
        exit;
    }


    public function pesquisar() {
        $pdo = getConnection();
        $busca = $_POST['busca'] ?? '';

        $stmt = $pdo->prepare("SELECT * FROM pontos WHERE nome LIKE :busca ORDER BY id DESC");
        $stmt->execute([':busca' => '%' . $busca . '%']);
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include '_cabecalho.php';
        include 'listaPontos.php';
        include '_rodape.php';
    }
    
    public function detalhe() {
        $id = $_GET['id'];
        $pdo = getConnection();
        $stmt = $pdo->prepare("SELECT * FROM pontos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $dado = $stmt->fetch(PDO::FETCH_ASSOC);

        include '_cabecalho.php';
        include 'detalhePontos.php';
        include '_rodape.php';
    }

    private function uploadImagem($id) {
        if (!is_dir($this->pasta_imagens)) { // se nao existir a pasta, cria
            mkdir($this->pasta_imagens, 0777, true); // cria pasta
        }

        if (empty($_FILES['input_imagem']['name'])) { // sem envio de arquivo, apenas sair do método uploadImagem
            return;
        }

        $arquivo = $_FILES['input_imagem']; // vetor global $_FILES possui os dados arquivo selecionado para upload
        $novo_nome = $id . $this->ext_imagem;
        $caminho_final = $this->pasta_imagens . $novo_nome;

        try { // Move o arquivo enviado da pasta temporária para o caminho e nome definidos
            $sucesso = move_uploaded_file($arquivo['tmp_name'], $caminho_final);
            if ($sucesso === false) {
                throw new Exception("Não foi possível mover o arquivo '{$arquivo['tmp_name']}' para '{$caminho_final}'.");
            }
        } catch (Exception $e) {
            die("Erro no upload da imagem: " . $e->getMessage());
        }

        $pdo = getConnection();
        $stmt = $pdo->prepare("UPDATE pontos SET url_imagem_ponto = :url_imagem_ponto WHERE id = :id");
        $stmt->execute([
            ':url_imagem_ponto' => $caminho_final,
            ':id' => $id
        ]);
    }

    private function excluirImagem($id) {
        // Remove imagem
        $caminho_imagem = $this->pasta_imagens . $id . $this->ext_imagem;
        if (file_exists($caminho_imagem)) {
            unlink($caminho_imagem);
        }

    }

}
