<div class="card mt-5">
    <div class="card-header">
        <h5 ><?= isset($dado) ? "Editar Produto" : "Novo Produto" ?></h5>
    </div>
    <div class="card-body">
        <form method="post" action="?acao=salvar" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $dado["id"] ?? '' ?>">

            <label class="form-label">Nome:</label>
            <input class="form-control" type="text" name="nome"
                   value="<?= $dado["nome"] ?? '' ?>" required autofocus>

            <label class="mt-3">Descrição:</label>
            <input class="form-control" type="text" name="descricao"
                   value="<?= $dado["descricao"] ?? '' ?>" required>
            
            <label class="mt-3">Endereço:</label>
            <input class="form-control" type="text" name="endereco"
                   value="<?= $dado["endereco"] ?? '' ?>" required>

            <label class="mt-3">Imagem do Produto:</label>
            <input class="form-control" type="file" name="input_imagem" accept="image/*">

            <?php if (!empty($dado['url_imagem_produto']) && file_exists($dado['url_imagem_produto'])): ?>
                <div class="mt-3 text-center">
                    <img src="<?= $dado['url_imagem_produto'] ?>?v=<?= filemtime($dado['url_imagem_produto']) ?>" class="img-fluid img-thumbnail"
                         style="max-width: 200px;" alt="Imagem do produto">
                    <p class="text-muted small mt-2">Imagem atual</p>
                </div>
            <?php endif; ?>

            <button class="btn btn-primary mt-4" type="submit">Salvar</button>
        </form>
    </div>
</div>
