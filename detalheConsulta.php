<h3><?= $dado['nome'] ?></h3>

<?php if (!empty($dado['url_imagem_ponto']) && file_exists($dado['url_imagem_ponto'])): ?>
    <img src="<?= $dado['url_imagem_ponto'] ?>" class="img-fluid rounded my-3">
<?php endif; ?>

<p><?= $dado['descricao'] ?></p>
<p><strong>Endereço:</strong> <?= $dado['endereco'] ?></p>

<a href="ConsultaController.php" class="btn btn-secondary">Voltar</a>