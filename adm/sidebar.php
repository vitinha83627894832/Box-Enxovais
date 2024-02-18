<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Administrador - Box Enxovais</title>
  <link rel="stylesheet" href="../assets/css/adm.css" />

  <!-- BoxIcons CDN Link -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

  <!-- FontAwesome Link -->
  <script src="https://kit.fontawesome.com/42c6fc9b70.js" crossorigin="anonymous"></script>
  <link href="/BoxEnxovais2/assets/img/Box-Enxovais-icon.png" rel="icon">

</head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <img src="/BoxEnxovais2/assets/img/Box-Enxovais.png" alt="Logo">
    </div>

    <ul class="nav-links">
      <li>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Cadastros</a></li>
        </ul>
      </li>
      <li>
        <div class="icon-links">
          <a href="#">
            <i class="fa-regular fa-address-card" style="color: #4c4d4f;"></i>
            <span class="link_name">Cadastros</span>
          </a>
          <i class="bx bx-chevron-down arrow"></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Cadastros</a></li>
          <li><a href="cadAdm.php">Administrador</a></li>
          <li><a href="cadMarcaProduto.php">Marca do Produto</a></li>
          <li><a href="cadProduto.php">Produto</a></li>
          <li><a href="cadTipoProduto.php">Tipo do Produto</a></li>
        </ul>
      </li>
      <li>
        <div class="icon-links">
          <a href="#">
            <i class="bx bx-book-alt"></i>
            <span class="link_name">Listagem</span>
          </a>
          <i class="bx bx-chevron-down arrow"></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Listagem</a></li>
          <li><a href="listarAdm.php">Administrador</a></li>
          <li><a href="listarMarcaProduto.php">Marca do Produto</a></li>
          <li><a href="listarProduto.php">Produto</a></li>
          <li><a href="listarTipoProduto.php">Tipo do Produto</a></li>
          <li><a href="listarUsuario.php">Usuário</a></li>
        </ul>
      </li>
      <li>
        <div class="icon-links">
          <a href="#">
            <i class='bx bx-filter-alt'></i>
            <span class="link_name">Filtrar</span>
          </a>
          <i class="bx bx-chevron-down arrow"></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Filtrar</a></li>
          <li><a href="relatorioEstoque.php">Estoque</a></li>
          <li><a href="relatorioProdMarca.php">Produtos por marca</a></li>
          <li><a href="relatorioProdTipo.php">Produtos por tipo</a></li>
          <li><a href="relatorioVendas.php">Vendas por Cliente</a></li>
        </ul>
      </li>
      <div class="profile-details">
        <i class="fa-solid fa-arrow-right-from-bracket" style="color: #fafafa;">
          <span>
            <a href="index.php" style="color: white; display: inline-block; font-family: 'Montserrat';">Sair</a>
          </span></i>
      </div>
      </li>
    </ul>
  </div>