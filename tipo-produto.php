<?php
require_once("assets/conexao.php");



$sql = "SELECT codProd, nomeProd, valor, arquivo, arquivo2 FROM produto
where tipo_produto_cod = " . $_GET['tipo_produto_cod'];

$resultado = mysqli_query($conexao, $sql);
?>


<?php require_once("assets/cabecalho.php") ?>


  <!-- About Cards -->
  <section class="section-75 section-md-120 section-lg-120 section-xl-150" id="custom-way-point">
    <div class="header-divider"></div>
    <div class="container-card">
      <?php while ($row = mysqli_fetch_array($resultado)) { ?>

        <div class="card">
          <div class="image-wrapper">
            <img class="card-img-top" src="assets/img/<?= $row['arquivo'] ?>" alt="Capa do card">
            <img class="card-img-top-hover" src="assets/img/<?= $row['arquivo2'] ?>" alt="Segunda imagem do card">
          </div>
          <div class="card-body d-flex flex-column">
            <p class="card-text"><a href="telaProduto.php?codProd=<?= $row['codProd'] ?>"><?= $row['nomeProd'] ?></a></p>
            <div>
              <h4 class="card-price">R$ <?= number_format($row["valor"], 2, ',', '.') ?></h4>
            </div>
            <a href="telaProduto.php?codProd=<?= $row['codProd'] ?>" class="btn btn-primary btn-lg btn-block mt-auto active" role="button" aria-pressed="true">Adicionar ao Carrinho</a>
          </div>

        </div>

      <?php } ?>

    </div>
  </section>
  <!-- Cards End -->

  <?php require_once("assets/footer.php") ?>
  <?php require_once("assets/rodape.php") ?>