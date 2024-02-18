<?php
require_once("../assets/conexao.php");

//Bloco de exclusão
if (isset($_GET['codProd'])) {

    $sql = "delete from produto where codProd = " . $_GET['codProd'];
    mysqli_query($conexao, $sql);
    $mensagem = "Exclusão realizada com sucesso";
}
///////////////////////

//Geração de SQL dinâmica para relatório
$V_WHERE = "";
if (isset($_POST['pesquisar'])) { //Se clicou no botão de pesquisar
    $V_WHERE = " and nomeProd like '%" . $_POST['nome'] . "%'";
}
$sql = "SELECT produto.*, 
        marca_produto.nomeMarcaProd,
        tipo_produto.nomeTipoProd
          FROM produto
          LEFT JOIN marca_produto ON marca_produto.codMarcaProd = produto.marca_produto_cod
          LEFT JOIN tipo_produto ON tipo_produto.codTipoProd = produto.tipo_produto_cod
          WHERE 1 = 1" . $V_WHERE;



//3.executar a sql
$resultado = mysqli_query($conexao, $sql);

?>
<?php require_once("Sidebar.php"); ?>
<!-- Ajax -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



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

    .pesquisar {
        width: 30%;
        justify-content: space-between;
    }

    .search-box {
        width: 90%;
        background: #0000001c;
        box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.2);
        height: 40px;
        padding: 10px;
        border-radius: 40px;
        display: flex;
        justify-content: space-between;
        /*joga o 1ºnitem totalmente pra direita e o 2º totalmente pra direita*/
        align-items: center;
    }

    .botao-listar i {
        color: #fff;
    }

    .btn-modal {
        background-color: #008F8C;
    }
</style>

<section class="home-section">

    <div class="card-listar">

        <div class="card-body">
            <h2 class="title-marca">Listagem Produto</h2>
            <a href="cadProduto.php" class="btn-plus"><i class="fa-solid fa-plus"></i></a>
        </div>
        <div class="card-body pesquisar">
            <h1 class="card-title">Pesquisar </h1>
            <form method="POST">
                <div class="input-group">
                    <div class="input-box">
                        <label for="nome">Nome do Produto</label>
                        <div class="search-box">
                            <input type="text" class="search-text" placeholder="Pesquisar" id="nome" name="nome" />
                            <button class="search-btn" name="pesquisar"><i class="fa-solid fa-magnifying-glass cor-i"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="tbl_container">

            <table class="tbl">
                <thead> <!-- cabeçalho -->
                    <tr>
                        <th>ID</th>
                        <th>Nome Produto</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th colspan="3">Ação</th> <!-- O "colpsan faz com que o action ocupe duas colunas" -->
                    </tr>

                <tbody>
                    <?php while ($linha = mysqli_fetch_array($resultado)) { ?>
                        <tr>
                            <td data-lable="ID"><?= $linha['codProd'] ?></th>
                            <td data-lable="Nome"><?= $linha['nomeProd'] ?></th>
                            <td data-lable="Valor"><?= $linha['valor'] ?></th>
                            <td data-lable="status"><?= $linha['status'] == 1 ? 'Ativo' : 'Inativo'; ?></th>
                            <td data-lable="Editar">
                                <a href="alteraRProduto.php?codProd=<?= $linha['codProd'] ?>" class="botao-listar btn_edit"><i class="fa fa-pencil"></i></a>

                            </td>
                            <td data-lable="Excluir">
                                <a href="listarProduto.php?codProd=<?= $linha['codProd'] ?>" class="botao-listar btn_trash" onclick="return confirm('Confirmar exclusão?')"><i class="fa fa-trash"></i></a>

                            </td>

                            <td data-lable="Informações">
                                <button class="open-modal botao-listar btn-modal" data-product-id="<?= $linha['codProd'] ?>"><i class="fa-solid fa-eye"></i></button>
                                <div class="fade hide" data-product-id="<?= $linha['codProd'] ?>"></div>
                                <div class="modal hide" data-product-id="<?= $linha['codProd'] ?>">

                                    <div class="modal-header">
                                        <h2>Informações de Produto</h2>
                                        <button id="close-modal">Fechar</button>
                                    </div>
                                    <div class="modal-body">
                                        <span>
                                            <p><?= $linha['codProd'] ?></p>
                                        </span>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                </thead>
            </table>
        </div>
    </div>


</section>
<script>
    $(document).ready(function() {
        $(".open-modal").click(function() {
            const productId = $(this).data("product-id");
            const modal = $(`.modal[data-product-id="${productId}"]`);
            const fade = $(`.fade[data-product-id="${productId}"]`);

            $.ajax({
                url: `getProductInfo.php?codProd=${productId}`,
                type: "GET",
                dataType: "json",
                success: function(productInfo) {
                    const modalBody = modal.find(".modal-body");

                    if (productInfo.error) {
                        modalBody.html(`<p>${productInfo.error}</p>`);
                    } else {
                        const statusText = productInfo.status == 1 ? 'Ativo' : 'Inativo';
                        modalBody.html(`<p><strong>ID</strong>: ${productInfo.codProd}</p>
                            <p><strong>Nome</strong>: ${productInfo.nomeProd}</p>
                            <p><strong>Valor</strong>: ${productInfo.valor}</p>
                            <p><strong>Status</strong>: ${statusText}</p>
                            <p><strong>Medida Casal</strong>: ${productInfo.med_casal}</p>
                            <p><strong>Medida Queen</strong>: ${productInfo.med_queen}</p>
                            <p><strong>Medida Super King</strong>: ${productInfo.med_superKing}</p>
                            <p><strong>Medida Solteiro</strong>: ${productInfo.med_solteiro}</p>
                            <p><strong>Valor</strong>: ${productInfo.valor}</p>
                            <p><strong>Qntd</strong>: ${productInfo.qntd}</p>
                            <p><strong>Imagem 1</strong>: ${productInfo.arquivo}</p>
                            <p><strong>Imagem 2</strong>: ${productInfo.arquivo2}</p>
                            <p><strong>Marca</strong>: ${productInfo.nomeMarcaProd}</p>
                            <p><strong>Tipo</strong>: ${productInfo.nomeTipoProd}</p>`); // Alterado para exibir statusText
                    }

                    modal.removeClass("hide");
                    fade.removeClass("hide");
                },
                error: function(error) {
                    console.error('Erro ao buscar informações do produto:', error);
                }
            });
        });

        $(".close-modal, .fade").click(function() {
            $(".modal").addClass("hide");
            $(".fade").addClass("hide");
        });
    });
</script>

<?php require_once("rodapeSidebar.php") ?>