<?php
require_once("../assets/conexao.php");

$codProd = $_GET['codProd'];

if (isset($_POST['salvar'])) {


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
    $status = $_POST['status'];


    //3º passo - Preparar a SQL
    $sql = "UPDATE produto
                SET nomeProd   = '{$nomeProd}',
                descricao      = '{$descricao}',
                cuidado        = '{$cuidado}',
                med_casal      = '{$casal}',
                med_queen      = '{$queen}',
                med_superKing  = '{$king}',
                med_solteiro   = '{$solteiro}',
                qntd           = '{$qntd}',
                valor          = '{$valor}',
                marca_produto_cod      = '{$marcaProd}',
                tipo_produto_cod       = '{$tipoProd}',
                status       = '{$status}'
                WHERE codProd  = {$codProd}";


    //4º passo - Executar a sql no banco de dados
    $resultado =   mysqli_query($conexao, $sql);

    //5º passo
    $mensagem = "Registo Salvo com Sucesso";
}

$sql = "SELECT * FROM produto WHERE codProd = {$codProd}";
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
        height: 100%;
        width: 100%;
        justify-content: center;
        align-items: center;
        padding: 10px;
        background: linear-gradient(135deg, #71b7e6, #9b59b6);
        margin-left: 9rem;
    }

    .cadastro form .textarea {
        display: flex;
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
        /* Define a altura desejada para o textarea */
        width: 100%;
        outline: none;
        border-radius: 5px;
        border: 1px solid #ccc;
        padding: 10px;
        font-size: 16px;
        transition: all 0.3s ease;
        resize: none;
        /* Impede o redimensionamento pelo usuário */
    }

    .textarea .input-box .input:focus,
    .textarea .input-box .input:valid {
        border-color: #9b59b6;
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

        <div class="title">Alteração de Produto</div>
        <form class="form" action="" method="POST" enctype="multipart/form-data">

            <div class="user-details">

                <div class="input-box">
                    <label class="details" for="nome">Nome do Produto</label>
                    <input class="input" type="text" id="nome" name="nomeProd" value="<?= $linha['nomeProd'] ?>" />
                </div>

                <div class="input-box">
                    <label class="details" for="status">Status</label>
                    <select class="input" name="status">
                        <option value="1" <?= ($linha['status'] == 1) ? 'selected' : '' ?>>Ativo</option>
                        <option value="0" <?= ($linha['status'] == 0) ? 'selected' : '' ?>>Inativo</option>
                    </select>
                </div>
            </div>

            <div>
                <h3>Medidas</h3>
                <div class="user-details">
                    <div class="input-box">
                        <label class="details" for="casal">Casal</label>
                        <input class="input" type="text" id="casal" name="casal" value="<?= $linha['med_casal'] ?>" />
                    </div>

                    <div class="input-box">
                        <label class="details" for="queen">Queen</label>
                        <input class="input" type="text" id="queen" name="queen" value="<?= $linha['med_queen'] ?>" />
                    </div>

                    <div class="input-box">
                        <label class="details" for="king">Super King</label>
                        <input class="input" type="text" id="king" name="king" value="<?= $linha['med_superKing'] ?>" />
                    </div>

                    <div class="input-box">
                        <label class="details" for="solteiro">Solteiro</label>
                        <input class="input" type="text" id="solteiro" name="solteiro" value="<?= $linha['med_solteiro'] ?>" />
                    </div>
                </div>
            </div>


            <div class="medida">
                <div class="input-box">
                    <label class="details" for="qntd">Quantidade</label>
                    <input class="input" type="text" id="qntd" name="qntd" value="<?= $linha['qntd'] ?>" />
                </div>


                <div class="input-box">
                    <label class="details" for="valor">Valor</label>
                    <input class="input" type="text" id="valor" name="valor" value="<?= $linha['valor'] ?>" />
                </div>


                <div class="input-box">
                    <label class="details" for="marcaProd">Marca do Produto</label>
                    <select name="marcaProd" id="marcaProd" class="input">
                        <option style="text-align: center" value="">--Selecione--</option>

                        <?php
                        $sql = "select * from marca_produto order by nomeMarcaProd";
                        $resultado = mysqli_query($conexao, $sql);

                        while ($linhaMarca = mysqli_fetch_array($resultado)) {
                        ?>

                            <option value="<?= $linhaMarca['codMarcaProd'] ?>" <?= ($linha['marca_produto_cod'] == $linhaMarca['codMarcaProd']) ? 'selected' : '' ?>>
                                <?= $linhaMarca['nomeMarcaProd'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>



                <div class="input-box">
                    <label class="details" for="tipoProd">Tipo do Produto</label>
                    <select name="tipoProd" id="tipoProd" class="input selecione">
                        <option style="text-align: center" value="">--Selecione--</option>

                        <?php
                        $sql = "select * from tipo_produto order by nomeTipoProd";
                        $resultado = mysqli_query($conexao, $sql);

                        while ($linhaTipo = mysqli_fetch_array($resultado)) {
                        ?>

                            <option value="<?= $linhaTipo['codTipoProd'] ?>" <?= ($linha['tipo_produto_cod'] == $linhaTipo['codTipoProd']) ? 'selected' : '' ?>>
                                <?= $linhaTipo['nomeTipoProd'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>


            <div class="textarea">
                <div class="input-box">
                    <label class="detalhes" for="cuidado">Cuidado</label>
                    <textarea class="input" id="cuidado" name="cuidado" cols="30" rows="10"><?= $linha['cuidado'] ?></textarea>
                </div>

                <div class="input-box">
                    <label class="detalhes" for="desc">Descrição</label>
                    <textarea class="input" id="desc" name="descricao" cols="30" rows="10"><?= $linha['descricao'] ?></textarea>
                </div>
            </div>


            <div class="alterar">
                <div class="button">
                    <button class="botao botao-alterar" type="submit" name="salvar"><i class="fa-solid fa-check"></i> Salvar</button>
                </div>
                <div class="button">
                    <a href="listarProduto.php" class="botao botao-voltar"><i class="fa-solid fa-rotate-left"></i> Voltar</a>
                </div>
            </div>

        </form>

    </div>

</section>


    <?php require_once("rodapeSidebar.php") ?>