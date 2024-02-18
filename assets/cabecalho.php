<?php
session_start();

// MENSAGEM ERRO/SENHA INVÁLIDO

if (isset($_GET['mensagem'])) { ?>
  <div style="display: flex; align-items: center; margin-top: -8px">
    <img src="assets/img/warning.png" style="margin-right: -10px; margin-left: 20px">
    <div class="alert alert-light" role="alert">
      <?= $_GET['mensagem'] ?>
    </div>
  </div>
<?php } ?>

<?php
if (isset($_POST['pesquisar'])) {
  require_once("conexao.php");
  //Geração de SQL dinâmica para relatório
  $V_WHERE = "";
  if (isset($_POST['pesquisar'])) { //Se clicou no botão de pesquisar
    $V_WHERE = " and nomeProd like '%" . $_POST['nomeProd'] . "%'";
  }

  //2. preparar a sql
  $sql = "SELECT * FROM produto
  WHERE 1 = 1" . $V_WHERE;

  //3.executar a sql
  $resultado = mysqli_query($conexao, $sql);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <title>Box Enxovais | Cama, Mesa e Banho</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- script do bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- CSS do Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <!-- JavaScript do Bootstrap (opcional, mas necessário para alguns recursos) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Favicon -->
  <link href="assets/img/Box-Enxovais-icon.png" rel="icon">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- Topbar Start -->
  <div class="container-fluid bg-dark text-white-50 py-2 px-0 d-none d-lg-block">
    <div class="row gx-0 align-items-center">
      <div class="col-lg-7 px-5 text-start">
        <div class="h-100 d-inline-flex align-items-center me-4">
          <small>Olá, seja bem vindo!</small>
        </div>
        <div class="h-100 d-inline-flex align-items-center me-4">
          <img src="assets/img/phone-icon.png" alt="">
          <small>Atendimento: 0800 656 7846</small>
        </div>
      </div>
      <div class="col-lg-5 px-5 text-end">
        <ol class="breadcrumb justify-content-end mb-0" style="margin-top: -5px;">
          <li class="d-inline-block me-2"><a href="https://www.facebook.com/Bellaenx" target="blank"><img src="assets/img/facebook-icon.png" alt=""></a></li>
          <li class="d-inline-block me-2"><a href=""><img src="assets/img/instagram-icon.png" alt=""></a></li>
          <li class="d-inline-block me-2"><a href=""><img src="assets/img/pinterest-icon.png" alt=""></a></li>
          <li class="d-inline-block me-2"><a href=""><img src="assets/img/tik-tok-icon.png" alt=""></a></li>
        </ol>
      </div>
    </div>
  </div>
  <!-- Topbar End -->

  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg px-4 px-lg-5 bg-white">
    <div class="d-flex align-items-center">
      <a href="index.php"><img src="assets/img/Box-Enxovais.png" alt="Logo" class="navbar-logo mr-5"></a>
    </div>

    <!--search box-->
    <div class="search-container">
      <form action="" method="post">
        <div class="bloco-icone">
          <input type="text" class="search-box" name="nomeProd" id="nomeProd" placeholder="O que você procura?">
          <button class="search-button" name="pesquisar" type="submit">
            <img src="assets/img/search.png" alt="Pesquisar">
          </button>
        </div>
      </form>
    </div>

    <!-- Navigation items -->
    <div class="container mt-4">
      <div class="d-flex flex-column flex-sm-row justify-content-end align-items-center">
        <nav class="dp-menu">
          <ul>
            <li>
              <a href=""><img src="assets/img/user.png" alt="Usuário">
                <span class="account-color">Minha conta</span></a>
              <ul>
                <li>
                  <?php
                  if (!isset($_SESSION['email'])) {
                  ?>
                    <button type="button" class="btn btn-primary centered-button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" style="margin: 10px 0 0 0; text-align: center; ">
                      Fazer login</button>
                  <?php
                  } else {
                  ?>
                    <div class="text-welcome">
                      <div class="welcome">
                        <span>Seja bem-vindo, <?php echo $_SESSION['nome']; ?>!</span>
                      </div>
                    </div>
                  <?php
                  }
                  ?>
                  <div class="modal fade" id="exampleModal" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Bem vindo(a) de volta</h5>
                          <div class="custom-line"></div>
                          <span class="modal-subtitle">Faça login para continuar!</span>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div> <!--modal header close-->
                        <div class="modal-body">
                          <form method="POST" action="autenticacao.php">
                            <div class="mb-3 mt-4">
                              <div class="form-item-icon">
                                <img src="assets/img/email-login.png" alt="">
                                <input type="email" class="form-control" placeholder="Email" id="emailForm" autofocus required name="email">
                              </div>
                            </div>
                            <div class="mb-3">
                              <div class="form-item-icon">
                                <img src="assets/img/senha-login.png" alt="">
                                <input type="password" class="form-control" placeholder="Senha" id="passwordForm" required name="senha">
                              </div>
                            </div>
                            <div class="form-check form-item">
                              <input type="checkbox" class="form-check-input" id="rememberCheckbox">
                              <label class="form-check-label" for="rememberCheckbox">Lembrar senha</label>
                            </div>
                            <div class="form-item">
                              <a href="adm/index.php">
                                <span class="adm-login">Logar como admin?</span>
                              </a>
                            </div>
                            <div class="modal-footer">
                              <input type="submit" class="btn btn-primary centered-button" value="Login">
                            </div>
                          </form>
                        </div> <!--modal-body close-->
                        <!--modal-footer close-->
                      </div> <!--modal content close-->
                    </div> <!--modal dialog-close-->
                  </div> <!--modal fade close-->
                </li>
                <hr class="header-divider-dp-menu">
                <li>
                  <div class="flex-container">
                    <div class="flex-item">

                      <?php
                      if (!isset($_SESSION['email'])) {
                      ?>
                        <div class="cad-text-user">
                          <a href="adm/cadUsuario.php">
                            <span>Novo aqui? Cadastre-se</span>
                          </a>
                        </div>
                      <?php
                      } else {
                      ?>
                        <a href="sair.php">
                          <input type="submit" class="btn btn-primary centered-button" value="Logout">
                        </a>
                      <?php
                      }
                      ?>

                    </div>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </nav> <!--dp-menu close-->
        <div>
          <a href="carrinho1.php"><img src="assets/img/cart.png" alt="Sacola de Compras" class="ml-2" style="height: 35px;"></a>
        </div>
      </div>
    </div>
  </nav> <!--navbar close-->

  <div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav mx-auto bg-light pe-4 py-3 py-lg-0"></div>
  </div>

  <!-- NAVBAR COM MEGA MENU -->

  <nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="categoria.php?id=1">Cama</a>
            <div class="mega-menu">
              <h3>Cama</h3>
              <hr class="hr-mega-menu">
              <a href="edredom-malha.php">
                <span>
                  <img src="assets/img/arrow.png" style="width: 16px;">
                  <a style="color: #4c4d4f;" href="tipo-produto.php?tipo_produto_cod=1">Edredom Malha</span></a>
              </a>
              <a href="cobre-leito-malha.php">
                <span>
                  <img src="assets/img/arrow.png" style="width: 16px; margin-right: 4px;">
                  <a style="color: #4c4d4f;" href="tipo-produto.php?tipo_produto_cod=2">Cobre Leito Malha</span></a>
              </a>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="categoria.php?id=2">Travesseiros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="categoria.php?id=3">Toalhas</a>
            <div class="mega-menu">
              <h3>Toalhas</h3>
              <hr class="hr-mega-menu">
              <a href="#">
                <span>
                  <img src="assets/img/arrow.png" style="width: 16px; margin-right: 4px;">
                  <a style="color: #4c4d4f;" href="tipo-produto.php?tipo_produto_cod=4"> Toalhas de Rosto e Corpo</span></a>
              </a>
              <a href="#">
                <span>
                  <img src="assets/img/arrow.png" style="width: 16px; margin-right: 4px;">
                  <a style="color: #4c4d4f;" href="tipo-produto.php?tipo_produto_cod=8">Toalhas de Piso</span></a>
              </a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="categoria.php?id=4">Almofadas</a>
            <div class="mega-menu">
              <h3>Almofadas</h3>
              <hr class="hr-mega-menu">
              <a href="#">
                <span>
                  <img src="assets/img/arrow.png" style="width: 16px; margin-right: 4px;">
                  <a style="color: #4c4d4f;" href="tipo-produto.php?tipo_produto_cod=5">Almofadas</span></a>
              </a>
              <a href="#">
                <span>
                  <img src="assets/img/arrow.png" style="width: 16px; margin-right: 4px;">
                  <a style="color: #4c4d4f;" href="tipo-produto.php?tipo_produto_cod=6">Cortinas</span></a>
              </a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="categoria.php?id=5">Mesa</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>