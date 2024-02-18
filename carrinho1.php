<?php
require_once("assets/conexao.php");

session_start();

// BLOCO DE EXCLUSÃO
if (isset($_GET['codCarrinho'])) {
    $sql = "DELETE from carrinho WHERE codCarrinho = " . $_GET['codCarrinho'];
    mysqli_query($conexao, $sql);
    $mensagem = "Exclusão realizada com sucesso";
  }
  
  $sessao_id = session_id();
  
// INSERIR PRODUTOS NO CARRINHO
if (isset($_POST['codProd'])) {

  // Verifica se 'codCliente' está definido na sessão
  if (isset($_SESSION['codCliente'])) {
      $codigoProduto = $_POST['codProd'];
      $codigoCliente = $_SESSION['codCliente'];
      $valor = $_POST['valor'];
      $sessao_id = session_id();
      $quantidade = $_POST['quantidade'];

      $sql = "INSERT INTO carrinho (codigoProduto, codigoCliente, valor, sessao_id, quantidade) 
              VALUES ($codigoProduto, $codigoCliente, $valor, '$sessao_id', $quantidade)";
      $resultado = mysqli_query($conexao, $sql);

      if (!$resultado) {
          echo "Erro ao inserir produto no carrinho: " . mysqli_error($conexao);
      }
  } else {
      echo "Você precisa fazer login ou cadastre-se!";
  }
}

// CONSULTA OS PRODUTOS NO CARRINHO PARA EXIBIR 
$sql = "SELECT produto.codProd, produto.nomeProd, carrinho.codCarrinho, 
              carrinho.quantidade, produto.valor,
              carrinho.quantidade * produto.valor AS valor_total
        from carrinho
        INNER JOIN produto ON produto.codProd = carrinho.codigoProduto
        WHERE sessao_id = '$sessao_id'";

// LISTAR TODOS OS DADOS DA CONSULTA SQL (NOME, QUANTIDADE, VALOR E VALOR TOTAL)
$resultado = mysqli_query($conexao, $sql);
$linha = mysqli_fetch_array($resultado);

// PARA FINALIZAR A COMPRA ////////////////////////////////////////////////////////////////////
if (isset($_POST['finalizar'])) {

    // INSERE NA TABELA VENDA
  $codCli = $_SESSION['codCliente'];
  $status = 0; // em andamento
  $formaPag = $_POST['formaPagamento'];
  $totalGeral = $_POST['totalGeral'];

  $sql_venda = "INSERT INTO venda (codCli, status, formaPag, valorTotal) 
  VALUES ($codCli, $status, $formaPag, $totalGeral)";

$resultado_venda = mysqli_query($conexao, $sql_venda);
$codVenda = mysqli_insert_id($conexao);


//Calcula o total Geral
$totalGeral = 0.0;
$sql = "SELECT SUM(valor_total) AS total FROM carrinho WHERE sessao_id = '$sessao_id'";
$resultado = mysqli_query($conexao, $sql);
$linhaTotal = mysqli_fetch_array($resultado);
$totalGeral = $linhaTotal['total'];


// INSERE NA TABELA ITENSVENDA
//PEGA TODOS OS PRODUTOS CADASTRADOS NO CARRINHO
$sqlprocura = "SELECT * FROM carrinho WHERE sessao_id = '$sessao_id'";
$resultadoitens = mysqli_query($conexao, $sqlprocura);

// RODA TODAS AS LINHAS QUE O RESULTADO DER E SE TIVER PELO MENOS 1 RODA A INSERÇÃO NA TABELA
while ($linha = mysqli_fetch_array($resultadoitens)) {
    $produtoCod = $linha['codigoProduto'];
    $quantidade = $linha['quantidade'];
    $valorUnit = $linha['valor'];
  
    $sql_itensvenda = "INSERT INTO itensvenda (vendaCod, produtoCod, quantidade, valorUnit)
    VALUES ($codVenda, $produtoCod, $quantidade, $valorUnit)";
        $resultado = mysqli_query($conexao, $sql_itensvenda);
        mysqli_query($conexao, $sql_itensvenda);
     }  
     
     $limpaCarrinho = "delete from carrinho where sessao_id = '$sessao_id'";
     mysqli_query($conexao, $limpaCarrinho);
     header("location: carrinhoFinalizado.php");  
  }

$totalGeral = 0.0;
while($linha = mysqli_fetch_array($resultado)) {
  $totalGeral += $linha['valor_total'];
}
$resultado = mysqli_query($conexao, $sql);

?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="assets/img/Box-Enxovais-icon.png" rel="icon">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
<link href="assets/css/bootstrap.min.css" rel="stylesheet">

<style>
  .center-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .container-carrinho {
    max-width: 1200px;
    /* Ajuste a largura máxima conforme necessário */
    width: 100%;
    margin-top: -10rem;
    /* Ajuste a margem superior conforme necessário */
    background-color: #fff;
    border-radius: 9px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
  }

  .resumo-container {
    max-width: 400px;
    /* Define a largura máxima do resumo-container */
    width: 100%;
    /* Adicionado para ocupar a largura total disponível */
  }

  .carrinho-container,
  .resumo-container {
    flex: 1;
    padding: 20px;
  }

  .carrinho {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
  }

  .carrinho th,
  .carrinho td {
    border-bottom: 1px solid #ddd;
    /* Adiciona a borda na parte inferior de cada célula */
    padding: 12px;
    text-align: left;
  }

  .carrinho th {
    background-color: transparent;
  }

  .carrinho tr:hover {
    background-color: #f5f5f5;
  }

  .opcoes-pagamento {
    display: flex;
    flex-direction: column;
  }

  .opcao-pagamento {
    margin: 10px;
    display: flex;
    align-items: center;
  }

  .opcao-pagamento img {
    width: 30px;
    padding: 5px;
    margin-left: 6px;
  }

  .radio-custom.button-resumo {
    display: flex;
    align-items: center;
    color: #FFFFFF !important;
  }

  .label-custom {
    margin-left: 10px;
    margin-right: 6px;
  }

  .resumo {
    background-color: #cb9897;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
  }

  .resumo h1 {
    margin: 5px;
    font-size: 24px;
    color: #FFFFFF;
    padding: 2.5px;
    text-align: center;
    font-weight: 300;
  }

  .resumo p {
    margin: 5px;
    padding-top: 10px;
    padding-bottom: 10px;
    padding-right: 10px;
    padding-left: 10px;
    font-size: 20px;
    color: #FFFFFF !important;
  }

  .resumo button {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #4c4d4f;
    color: #FFFFFF;
    border: none;
    border-radius: 7px;
    cursor: pointer;
    font-size: 16px;
  }

  .resumo button:hover {
    background-color: #4c4d4f;
    color: #FFFFFF;
  }

  @media screen and (max-width: 600px) {
    .container {
      flex-direction: column;
    }

    .opcoes-pagamento {
      flex-direction: row;
    }

    .opcao-pagamento {
      margin-right: 20px;
      margin-bottom: 0;
    }
  }

  .btn-voltar-compra {
    color: #FFFFFF !important;
  }

  .btn-voltar-compra:hover {
    color: #FFFFFF !important;
    background-color: #cb9897 !important;
  }

  .btn-voltar-compra a {
    font-size: 18px;
  }

  .btn-voltar-compra img {
    width: 16px;
  }

  .btn-finalizar-compra {
    text-transform: uppercase;
  }

  .btn-primary:checked {
    background-color: #cb9897 !important;
    color:#FFFFFF !important;
    border: none !important;
  }

</style>


<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
        <li class="d-inline-block me-2"><a href="https://www.facebook.com/Bellaenx" target="blank"><img
              src="assets/img/facebook-icon.png" alt=""></a></li>
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
    <form action="">
      <div class="bloco-icone">
        <input type="text" class="search-box" placeholder="O que você procura?">
        <button class="search-button">
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
                <button type="button" class="btn btn-primary centered-button" data-bs-toggle="modal"
                  data-bs-target="#exampleModal" data-bs-whatever="@mdo"
                  style="margin: 10px 0 0 0; text-align: center; ">
                  Fazer login</button>
                <?php
                  } else {
                  ?>
                <div class="text-welcome">
                  <div class="welcome">
                    <span>Seja bem-vindo,
                      <?php echo $_SESSION['nome']; ?>!
                    </span>
                  </div>
                </div>
                <?php
                  }
                  ?>
                <div class="modal fade" id="exampleModal" tabindex="1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
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
                              <input type="email" class="form-control" placeholder="Email" id="emailForm" autofocus
                                required name="email">
                            </div>
                          </div>
                          <div class="mb-3">
                            <div class="form-item-icon">
                              <img src="assets/img/senha-login.png" alt="">
                              <input type="password" class="form-control" placeholder="Senha" id="passwordForm" required
                                name="senha">
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
        <a href="carrinho1.php"><img src="assets/img/cart.png" alt="Sacola de Compras" class="ml-2"
            style="height: 35px;"></a>
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
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="cama.php">Cama</a>
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
          <a class="nav-link" href="tipo-produto.php?tipo_produto_cod=3">Travesseiros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="toalha.php">Toalhas</a>
          <div class="mega-menu">
            <h3>Toalhas</h3>
            <hr class="hr-mega-menu">
            <a href="#">
              <span>
                <img src="assets/img/arrow.png" style="width: 16px; margin-right: 4px;">
                <a style="color: #4c4d4f;" href="tipo-produto.php?tipo_produto_cod=4"> Toalhas de Rosto e
                  Corpo</span></a>
            </a>
            <a href="#">
              <span>
                <img src="assets/img/arrow.png" style="width: 16px; margin-right: 4px;">
                <a style="color: #4c4d4f;" href="tipo-produto.php?tipo_produto_cod=8">Toalhas de Piso</span></a>
            </a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tipo-produto.php?tipo_produto_cod=5">Almofadas</a>
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
          <a class="nav-link" href="tipo-produto.php?tipo_produto_cod=7">Mesa</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<!---------------- carrinho ---------------------------->

<body>
  <form action="carrinho1.php" method="POST">
    <input type="hidden" name="codigoProd" value="<?= $codigoProduto ?>">
    <input type="hidden" name="valor" value="<?= $valor ?>">
    <input type="hidden" name="totalGeral" value="<?= $totalGeral?>" />

    <div class="center-container">
      <div class="container-carrinho">
        <div class="carrinho-container">
        <button type="submit" href="index.php" class="btn btn-voltar-compra">
            <img src="assets/img/flecha.png" alt="">
                <a href="index.php"> Voltar a comprar</a>
        </button>
          <hr>
          <h2>
            Carrinho de Compras</h2>
          <table class="carrinho">

            <thead>
              <tr>
                <th>Nome</th>
                <th>Qtd</th>
                <th>Valor</th>
                <th>Total</th>
                <th>Excluir</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($linha = mysqli_fetch_array($resultado)) { ?>
              <tr id="produto<?= $linha['codCarrinho'] ?>">
                <td>
                  <?= $linha['nomeProd'] ?>
                </td>
                <td>
                  <input type="number" class="form-control form-control-sm quantidade-input" min="1"
                    value="<?= $linha['quantidade'] ?>" data-codcarrinho="<?= $linha['codCarrinho'] ?>" readonly>
                </td>
                <td>
                  <?= 'R$ ' . number_format($linha['valor'], 2, ',', '.'); ?>
                </td>
                <td class="valor_total">
                  R$
                  <?= number_format($linha['valor_total'], 2, ',', '.'); 
                                        $valor_total = $linha['valor_total']; 
                                        $totalGeral += $valor_total; ?>
                </td>
                <td>
                  <a href="carrinho1.php?codCarrinho=<?= $linha['codCarrinho'] ?>"
                    onclick="return confirm('Confirmar retirada do carrinho?')">
                    <img src="assets/img/lixo.png" alt="Excluir">
                  </a>
                </td>
              </tr>
              <?php } ?>
              <!-- Adicione mais linhas conforme necessário -->
            </tbody>
          </table>
        </div>

        <div class="resumo-container">
          <div class="resumo">
            <h1>Resumo da compra</h1>
            <hr style="color: #FFFFFF">

            <div class="opcoes-pagamento">
              <div class="radio-custom button-resumo">
                <input type="radio" id="formaPagamento1" name="formaPagamento" value="1" class="radio-custom-input"
                  required>
                <label for="formaPagamento1" class="label-custom">Cartão de Crédito</label>
                <i class="fas fa-credit-card" style="color: #4c4d4f;"></i>
              </div>
              <div class="radio-custom button-resumo">
                <input type="radio" id="formaPagamento2" name="formaPagamento" value="2" class="radio-custom-input"
                  required>
                <label for="formaPagamento2" class="label-custom">Cartão de Débito</label>
                <i class="fas fa-credit-card" style="color: #4c4d4f;"></i>
              </div>
              <div class="radio-custom button-resumo">
                <input type="radio" id="formaPagamento3" name="formaPagamento" value="3" class="radio-custom-input"
                  required>
                <label for="formaPagamento3" class="label-custom">Pix</label>
                <i class="fab fa-pix" style="color: #4c4d4f;"></i>
              </div>
            </div>
            <p>Total:
              R$
              <?= number_format($totalGeral, 2, ',', '.'); ?>
            </p>
            <button type="submit" name="finalizar" value="finalizar" class=" btn btn-finalizar-compra"
              onclick="return confirm('Confirmar compra?')">
              Finalizar Compra
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</body>
</html>
</div>

<?php
require_once("assets/footer.php");
?>