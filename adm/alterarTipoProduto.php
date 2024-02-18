<?php
require_once("../assets/conexao.php");

//Esse "isset" serve para verificar se foi clicado no botão, caso não tenha sido clicado, não aparecerá o "warning" que aparece
$codTipo = $_GET['codTipoProd'];

if (isset($_POST['salvar'])) {

    //2º passo - Receber os dados para inserir no BD
    $nomeTipo = $_POST['nomeTipoProd'];
    $status = $_POST['status'];


    //3º passo - Preparar a SQL
    $sql = "UPDATE tipo_produto
                set nomeTipoProd   = '{$nomeTipo}'
                status             = '{$status}'
            where codTipoProd = {$codTipo} ";


    //4º passo - Executar a sql no banco de dados
    mysqli_query($conexao, $sql);

    //5º passo
    $mensagem = "Registo atualizado com sucesso";
}

$sql = "SELECT * from tipo_produto where codTipoProd = {$codTipo}";
$resultado = mysqli_query($conexao, $sql);
$linha = mysqli_fetch_array($resultado);
?>

<?php require_once("sidebar.php") ?>


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

    .alterar {
        display: flex;
        justify-content: flex-start;
    }

    .botao {
        color: white;
        font-family: 'Montserrat';
        font-size: 16px;
        font-weight: bolder;
        width: 200px;
        padding: 1rem;
        border-radius: 10px;
        letter-spacing: 2px;
        transition: 0.5s ease;
        border: none;
        text-align: center;
        text-transform: uppercase;
        margin: 10px auto;
    }

    .botao i {
        color: #fff;
    }

    .botao-alterar {
        background: #cb9897;
    }

    .botao-voltar {
        background: #4c4d4f;
        margin-left: 6px;
        text-decoration: none;
    }

    .botao:hover {
        cursor: pointer;
        background-color: #BFBFBF;
    }
</style>



<section class="home-section">

    <div class="cadastro">

        <?php require_once("mensagem.php") ?>


        <h2>Alterar Tipo do Produto</h2>
        <form class="form" action="" method="POST">
            <input type="hidden" name="codTipoProd" value="<?= $_GET['codTipoProd'] ?>">
            <div class="user-details">
                <div class="input-box">
                    <label class="details" for="nomeTipoProd">Nome do tipo do produto</label>
                    <input type="text" class="input" id="nomeTipoProd" name="nomeTipoProd" value="<?= $linha['nomeTipoProd'] ?>" />
                </div>
                <div class="input-box">
                    <label class="details" for="status">Status</label>
                    <select class="input" name="status">
                        <option value="1" <?= ($linha['status'] == 1) ? 'selected' : '' ?>>Ativo</option>
                        <option value="0" <?= ($linha['status'] == 0) ? 'selected' : '' ?>>Inativo</option>
                    </select>
                </div>
            </div>


            <div class="alterar">
                <div class="button">
                    <button class="botao botao-alterar" type="submit" name="salvar"><i class="fa-solid fa-check"></i> Salvar</button>
                </div>
                <div class="button">
                    <a href="listarTipoProduto.php" class="botao botao-voltar"><i class="fa-solid fa-rotate-left"></i> Voltar</a>
                </div>
            </div>


        </form>
    </div>

    <?php require_once("rodapeSidebar.php") ?>