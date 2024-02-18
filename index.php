<?php
require_once("assets/conexao.php");

$sql = "SELECT codProd, nomeProd, valor, arquivo, arquivo2 FROM produto
ORDER BY RAND() LIMIT 4";

$resultado = mysqli_query($conexao, $sql);
?>

<?php require_once("assets/cabecalho.php") ?>


<!-- Carousel Start -->

<div class="container-fluid p-0 mb-5">
  <div class="position-relative">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="w-100" src="assets/img/edredom-esther-carousel.png" alt="Edredom Esther" style="height: 630px;">
        </div>
        <div class="carousel-item">
          <img class="w-100" src="assets/img/edredom-theo-carousel.png" alt="Edredom Theo" style="height: 630px;">
        </div>
        <div class="carousel-item">
          <img class="w-100" src="assets/img/cobre-leito-juliette-carousel.png" alt="Edredom Theo"
            style="height: 630px;">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

  </div>
  <!-- Carousel End -->

  <!-- About Cards -->
  <div class="container mt-5">
    <section class="section-75 section-md-120 section-lg-120 section-xl-150" id="custom-way-point">
      <div class="container-card">

        <?php while ($row = mysqli_fetch_array($resultado)) { ?>

        <form method="post" action="carrinho1.php">
          <input type="hidden" name="codProd" value="<?= $row['codProd'] ?>">
          <input type="hidden" name="valor" value="<?= $row['valor'] ?>">

          <div class="card">
            <div class="image-wrapper">
              <img class="card-img-top" src="assets/img/<?= $row['arquivo'] ?>" alt="Capa do card">
              <img class="card-img-top-hover" src="assets/img/<?= $row['arquivo2'] ?>" alt="Segunda imagem do card">
            </div>

            <div class="card-body d-flex flex-column">
              <p class="card-text">
                <a href="telaProduto.php?codProd=<?= $row['codProd'] ?>"><?= $row['nomeProd'] ?>
              </a>
              </p>

              <div>
                <h4 class="card-price">R$ <?= number_format($row["valor"], 2, ',', '.') ?></h4>
              </div>

              <button class="btn btn-primary btn-lg btn-block mt-auto active" role="button" aria-pressed="true">
                  <span class="addCart">
                    <a class="viewProd" href="telaProduto.php?codProd=<?= $row['codProd'] ?>">Visualizar Produto
                  </a>
                </span>
                </button>
            </div>
          </div>
        </form>
        <?php } ?>

      </div>
    </section>
  </div>
  <!-- Cards End -->

  <?php require_once("assets/footer.php") ?>
  <?php require_once("assets/rodape.php") ?>