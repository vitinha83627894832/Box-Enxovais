<?php
require_once("../assets/conexao.php");


$V_WHERE = "";
if (isset($_POST['pesquisar'])) { //Se clicou no botão de pesquisar
    $V_WHERE = " AND nomeTipoProd LIKE '%" . $_POST['nomeTipo'] . "%'";
}

//Faz o select da marca do produto e tipo do produto
// $sql =  "SELECT p.codProd, p.nomeProd, p.status AS status_produto, 
// mp.nomeMarcaProd, mp.status AS status_marca,
// tp.nomeTipoProd, tp.status AS status_tipo;
// FROM produto p
// JOIN marca_produto mp ON p.marca_produto_cod = mp.codMarcaProd
// JOIN tipo_produto tp ON p.tipo_produto_cod = tp.codTipoProd;
// WHERE 1 = 1" . $V_WHERE;



//Faz o select apenas de marca produto
$sql = "SELECT p.codProd, p.nomeProd, p.status, tp.nomeTipoProd
FROM produto p
JOIN tipo_produto tp ON p.tipo_produto_cod = tp.codTipoProd
WHERE 1 = 1" . $V_WHERE;


//3.executar a sql
$resultado = mysqli_query($conexao, $sql);
?>

<?php require_once("sidebar.php"); ?>

<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: "poppins", sans-serif;
    }

    body {
        background: #ccc;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .card-listar {
        display: flex;
        justify-content: space-between;
        background: #424949;
        margin-top: 2rem;
        margin-bottom: 2rem;
    }
    .pesquisar{
    width: 30%;
    justify-content: space-between;
}

.search-box{
    width: 90%;
    background:#0000001c;
    box-shadow: 2px 4px 10px rgba(0,0,0,0.2);
    height: 40px;
    padding: 10px;
    border-radius: 40px;
    display: flex;
    justify-content: space-between;/*joga o 1ºnitem totalmente pra direita e o 2º totalmente pra direita*/
    align-items: center;
}
</style>

<section class="home-section">

    <!-- Início do container -->
    <div class="card-listar">
        <div class="card-body pesquisar">
            <form method="POST">
                <div class="input-group">
                    <div class="input-box">
                        <label for="nomeTipo">Categoria do produto</label>
                        <div class="search-box">
                            <input type="text" class="search-text" placeholder="Pesquisar" id="nomeTipo" name="nomeTipo" />
                            <button class="search-btn" name="pesquisar"><i class="fa-solid fa-magnifying-glass cor-i"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <h2 class="title-marca">Relatório Produto/Tipo</h2>
            <a href="cadMarcaProduto.php" class="btn-plus"><i class="fa-solid fa-plus"></i></a>
        </div>
    </div>

    <div class="container mt-3">

        <div class="tbl_container">


            <table class="tbl">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome Produto</th>
                        <th>Nome Tipo Produto</th>
                        <th>Status Produto</th>
                    </tr>

                <tbody>
                    <?php while ($linha = mysqli_fetch_array($resultado)) { ?>
                        <tr>
                            <td data-lable="ID"><?= $linha['codProd'] ?></td>
                            <td data-lable="Nome Produto"><?= $linha['nomeProd'] ?></td>
                            <td data-lable="Nome Tipo Produto"><?= $linha['nomeTipoProd'] ?></td>
                            <td data-lable="Status">
                                <?php echo ($linha['status'] == 1) ? 'Ativo' : 'Inativo'; ?><!-- Ao invés de mostrar 0 ou 1, mostra ativo e inativo -->
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                </thead>
            </table>
        </div>
    </div>
    <!-- Fim do container -->

</section>

<?php require_once("rodapeSidebar.php") ?>