<?php
//1º passo - Conectar no Banco de Dados (IP, usuário, senha, nome do banco)
require_once("../assets/conexao.php");

if (isset($_POST['salvar'])) {


  $diretorio = "../assets/img/"; /*Upload das imagens dos produtos*/
  $arquivoDestino = $diretorio . $_FILES['arquivo']['name'];

  //Envia o arquivo para o arquivoDestino
  $nomeArquivo = "";
  if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $arquivoDestino)) {
    $arquivo = $_FILES['arquivo']['name'];
  }

  $diretorio2 = "../assets/img/"; /*Upload das imagens dos produtos*/
  $arquivoDestino2 = $diretorio2 . $_FILES['arquivo2']['name'];

  //Envia o arquivo para o arquivoDestino
  $nomeArquivo2 = "";
  if (move_uploaded_file($_FILES['arquivo2']['tmp_name'], $arquivoDestino2)) {
    $arquivo2 = $_FILES['arquivo2']['name'];
  }

  //2º passo - Receber os dados para inserir no BD
  $nomeProd = $_POST['nomeProd'];
  $casal = $_POST['casal'];
  $queen = $_POST['queen'];
  $king = $_POST['king'];
  $solteiro = $_POST['solteiro'];
  $qntd = $_POST['qntd'];
  $valor = $_POST['valor'];
  $marcaProd = $_POST['marcaProd'];
  $tipoProd = $_POST['tipoProd'];
  $descricao = $_POST['descricao'];
  $cuidado = $_POST['cuidado'];



  // Validação
  $sql = "SELECT * FROM produto WHERE nomeProd = '{$nomeProd}'";
  $resultado = mysqli_query($conexao, $sql);
  $linhas = mysqli_num_rows($resultado); //número de linhas que retornou da consulta

  if ($linhas <= 0) { //se não tem a marca ainda, cadastra a nova marca  

    //3º passo - Preparar a SQL
    $sql = "INSERT INTO produto (nomeProd, descricao, cuidado, med_casal, med_queen, med_superking, med_solteiro, valor, qntd, arquivo, arquivo2, marca_produto_cod, tipo_produto_cod) 
  VALUES 
  ('$nomeProd', '$descricao', '$cuidado', '$casal', '$queen', '$king', '$solteiro', '$valor', '$qntd', '$arquivo','$arquivo2','$marcaProd', '$tipoProd')";

    //4º passo - Executar a sql no banco de dados
    $resultado = mysqli_query($conexao, $sql);

    //5º passo
    $mensagem = "Cadastro realizado com sucesso!";
  } else {
    $mensagemErro = "Produto já cadastrado!";
  }
}
?>

<?php require_once("sidebar.php"); ?>

<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat';
  }

  body {
    height: 100%;
    width: 100%;
    padding: 10px;
    background: linear-gradient(to right, #cb9897, #c9e9fc);
    margin: 0;
  }


  .cadastro form .textarea {
    flex-wrap: wrap;
    justify-content: space-between;
    margin: 20px 0 12px 0;
  }

  .textarea div {
    width: calc(100% - 20px);
    margin-bottom: 15px;
  }

  .textarea .input-box .detalhes {
    display: block;
    font-weight: 500;
    margin-bottom: 5px;
  }

  .textarea .input-box .input {
    height: 100px;
    border: none;
    box-shadow: 1px 1px 6px #0000001c;
    outline: none;
    background: white;
    padding: 10px 10px;
    border-radius: 15px;
    width: 100%;
    transition: 0.2s ease;
    resize: none;
    /* Impede o redimensionamento pelo usuário */
  }



  .textarea .input-box .input:focus,
  .textarea .input-box .input:valid {
    border-color: #9b59b6;
  }

  .home-section {
    display: flex;
    justify-content: center;
  }

  .medida-container {
    display: flex;
    align-items: center;
  }

  .medida {
    padding: 5px;
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

    <div class="title">Cadastro de Produto</div>
    <form class="form" action="" method="POST" enctype="multipart/form-data">

      <div class="user-details">

        <div class="input-box">
          <label class="details" for="nome">Nome do Produto:</label>
          <input class="input" type="text" class="tamanho-input" id="nome" name="nomeProd" placeholder="Ex: Cobre leito Sophia" />
        </div>
        <div class="input-box">
          <label class="details" for="qntd">Quantidade: </label>
          <input class="input" type="text" class="tamanho-input" id="qntd" name="qntd" placeholder="Ex: 8" />
        </div>
      </div>

      <div>
        <h3 class="medida-container" style="color: #4c4d4f; font-size: 23px; font-weight: 100;">
          <img src="/BoxEnxovais2/assets/img/fita-metrica.png" class="medida" alt="Medida">
          Medidas:
        </h3>
        <div class="user-details">
          <div class="input-box">
            <label class="details" for="casal">Solteiro</label>
            <input class="input" type="text" class="tamanho-input" id="casal" name="casal" placeholder="Ex: Lençol: 140 x 200 cm" />
          </div>

          <div class="input-box">
            <label class="details" for="queen">Casal</label>
            <input class="input" type="text" class="tamanho-input" id="queen" name="queen" placeholder="Ex: Lençol com elástico: 140 x 190 cm" />
          </div>

          <div class="input-box">
            <label class="details" for="king">Queen</label>
            <input class="input" type="text" class="tamanho-input" id="king" name="king" placeholder="Ex: Fronha: 50 x 70 cm" />
          </div>

          <div class="input-box">
            <label class="details" for="solteiro">Super King</label>
            <input class="input" type="text" class="tamanho-input" id="solteiro" name="solteiro" placeholder="Ex: Lençol com elástico: 360 x 400 cm" />
          </div>
        </div>
      </div>

      <div class="medida">
        <div class="input-box">
          <label class="details" for="valor">Valor: </label>
          <input class="input" type="text" class="tamanho-input" id="valor" name="valor" placeholder="Ex: 900,00" />
        </div>

        <div class="input-box">
          <label class="details" for="marcaProd">Marca do Produto:</label>
          <select name="marcaProd" id="marcaProd" class="input">
            <option style="text-align: center;" value="">--Selecione--</option>

            <?php
            $sql = "select * from marca_produto order by nomeMarcaProd";
            $resultado = mysqli_query($conexao, $sql);

            while ($linha = mysqli_fetch_array($resultado)) {
            ?>

              <option value="<?= $linha['codMarcaProd'] ?>"> <?= $linha['nomeMarcaProd'] ?> </option>
            <?php } ?>
          </select>
        </div>


        <div class="input-box">
          <label class="details" for="tipoProd">Tipo do Produto:</label>
          <select name="tipoProd" id="tipoProd" class="input selecione">
            <option style="text-align: center;" value="">--Selecione--</option>

            <?php
            $sql = "select * from tipo_produto order by nomeTipoProd";
            $resultado = mysqli_query($conexao, $sql);

            while ($linha = mysqli_fetch_array($resultado)) {
            ?>

              <option value="<?= $linha['codTipoProd'] ?>"> <?= $linha['nomeTipoProd'] ?> </option>
            <?php } ?>
          </select>
        </div>
      </div>


      <div class="textarea">
        <div class="input-box">
          <label class="detalhes" for="cuidado">
            <img src="/BoxEnxovais2/assets/img/cuidado.png" alt="Cuidado" style="padding-right: 5px;">Cuidado:</label>
          <textarea class="input" id="cuidado" name="cuidado" placeholder="Ex: Não usar água sanitátia ao realizar a lavagem..." cols="30" rows="10" style="font-size: 15px;"></textarea>
        </div>

        <div class="input-box">
          <label class="detalhes" for="desc">
            <img src="/BoxEnxovais2/assets/img/descricao.png" alt="Descrição">Descrição: </label>
          <textarea class="input" id="desc" name="descricao" placeholder="Ex: O Edredom 100% algodão..." cols="30" rows="10" style="font-size: 15px;"></textarea>
        </div>
      </div>

      <div class="user-details">
        <div class="input-box">
          <label class="picture" for="picture__input" tabIndex="0">
            <span class="picture__image"></span>
          </label>
          <input type="file" name="arquivo" id="picture__input">
        </div>


        <div class="input-box">
          <label class="picture" for="picture__input2" tabIndex="0">
            <span class="picture__image2"></span>
          </label>
          <input type="file" name="arquivo2" id="picture__input2">
        </div>
      </div>

      <div class="button">
        <button class="input" type="submit" name="salvar" style="cursor:pointer;">Cadastrar</button>
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

<script>
  function configureFileInput(inputId, imageClass, imageText) {
    const inputFile = document.querySelector(`#${inputId}`);
    const pictureImage = document.querySelector(`.${imageClass}`);

    pictureImage.innerHTML = imageText;

    inputFile.addEventListener("change", function(e) {
      const inputTarget = e.target;
      const file = inputTarget.files[0];

      if (file) {
        const reader = new FileReader();

        reader.addEventListener("load", function(e) {
          const readerTarget = e.target;

          const img = document.createElement("img");
          img.src = readerTarget.result;
          img.classList.add("picture__img");

          pictureImage.innerHTML = "";
          pictureImage.appendChild(img);
        });

        reader.readAsDataURL(file);
      } else {
        pictureImage.innerHTML = imageText;
      }
    });
  }

  configureFileInput("picture__input", "picture__image", "Choose an image");
  configureFileInput("picture__input2", "picture__image2", "Choose another image");
</script>
<?php require_once("rodapeSidebar.php"); ?>