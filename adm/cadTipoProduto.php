<?php
//1º passo - Conectar no Banco de Dados (IP, usuário, senha, nome do banco)
require_once("../assets/conexao.php");

if (isset($_POST['salvar'])) {

  //2º passo - Receber os dados para inserir no BD
  $nomeTipoProd = $_POST['nomeTipoProd'];



  // Validação do Cadastro
  $sql = "select * from tipo_produto where nomeTipoProd = '{$nomeTipoProd}'";
  $resultado = mysqli_query($conexao, $sql);
  $linhas = mysqli_num_rows($resultado); //número de linhas que retornou da consulta

  if ($linhas <= 0) { //se não tem a marca ainda, cadastra a nova marca  
    //3º passo - Preparar a SQL
    $sql = "INSERT INTO tipo_produto (nomeTipoaProd) VALUES ('$nomeTipoProd')";

    //4º passo - Executar a sql no banco de dados
    $resultado = mysqli_query($conexao, $sql);

    //5º passo
    $mensagem = "Cadastro realizado com sucesso!";
  } else {
    $mensagemeErro = "Tipo produto já cadastrado!";
  }
}
?>

<?php require_once("sidebar.php"); ?>

<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  }

  body {
    display: flex;
    height: 100vh;
    width: 90vw;
    justify-content: center;
    align-items: center;
    padding: 10px;
    background: linear-gradient(135deg, #71b7e6, #9b59b6);
    margin-left: 9rem;
  }

  .btn-voltar {
    text-decoration: none;
    border: none;
    text-align: center;
    text-transform: uppercase;
    margin: 10px auto;
    padding: 0.6rem;
    margin-top: 1rem;
  }
</style>

<section class="home-section">

  <div class="cadastro">

    <?php require_once("mensagem.php") ?>
    <?php require_once("mensagemErro.php") ?>

    <div class="title">Cadastro de Tipo Produto</div>
    <form class="form" action="" method="POST">

      <div class="user-details">
        <div class="input-box">
          <label class="details" for="nomeTipoProd">Nome do Produto</label>
          <input class="input" type="text" id="nomeTipoProd" name="nomeTipoProd" placeholder="Ex: Cortina" required />
        </div>
      </div>

      <div class="button">
        <button class="input" type="submit" name="salvar">Cadastrar</button>
      </div>

      <?php
      // Adicionando a opção de voltar
      if (isset($mensagem)) { ?>
        <div class="button">
          <a class="input btn-voltar" href="listarProduto.php">Voltar</a>
        </div>
      <?php }
      ?>

    </form>

  </div>

  <?php
  mysqli_close($conexao);
  ?>

</section>

<?php require_once("rodapeSidebar.php"); ?>