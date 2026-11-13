<h5 class="mt-5">Lista de Produtos</h5>

<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="?acao=novo" class="btn btn-success btn-sm">Adicionar</a>

    <form action="?acao=pesquisar" method="POST" class="d-flex gap-2">
        <input type="text" name="busca" class="form-control form-control-sm" 
                placeholder="Pesquisar..." 
                value="<?= $busca ?? "" ?>">
        <button type="submit" class="btn btn-secondary btn-sm">Pesquisar</button>
    </form>
</div>

<div class="row">
    <?php foreach ($dados as $dado): ?>
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <?php if (!empty($dado['url_imagem_ponto']) && file_exists($dado['url_imagem_ponto'])): ?>
                    <img src="<?= $dado['url_imagem_ponto'] ?>" class="card-img-top">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?= $dado['nome'] ?></h5>
                    <a href="?acao=detalhe&id=<?= $dado['id'] ?>" class="btn btn-primary">Ver detalhes</a>
                    <a href="?acao=editar&id=<?= $dado['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="?acao=excluir&id=<?= $dado['id'] ?>" class="btn btn-danger btn-sm">Excluir</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
