<?php
require_once("assets/conexao.php");

$sessao_id = session_id();

// Consulta para obter detalhes do produto
$sql_produto = "SELECT * FROM produto
        LEFT JOIN marca_produto ON marca_produto.codMarcaProd = produto.marca_produto_cod
        LEFT JOIN tipo_produto ON tipo_produto.codTipoProd = produto.tipo_produto_cod
        WHERE produto.codProd = " . $_GET['codProd'];

$resultado_produto = mysqli_query($conexao, $sql_produto);

// Consulta para obter informações do carrinho
$sql_carrinho = "SELECT carrinho.quantidade, produto.valor, carrinho.codCarrinho,
                carrinho.quantidade * produto.valor as subtotal 
                FROM carrinho
                INNER JOIN produto ON produto.codProd = carrinho.codigoProduto
                WHERE sessao_id = '$sessao_id'";

$resultado_carrinho = mysqli_query($conexao, $sql_carrinho);
$linha = mysqli_fetch_array($resultado_carrinho);

?>

<?php require_once("assets/cabecalho.php") ?>

<style>
    .card-container {
        display: flex;
        width: 900px;
        height: 640px;
        margin: 20px auto;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .image-container {
        flex: 1;
        overflow: hidden;
    }

    .info-container {
        flex: 1;
        padding: 20px;
    }

    h2 {
        margin-top: 0;
    }

    p {
        margin-bottom: 10px;
    }

    .quantity-container {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .quantity-input {
        width: 50px;
        text-align: center;
        margin-right: 10px;
    }

    .price-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding: 10px;
        flex-grow: 1;
    }

    .price {
        margin-left: 5px;
    }

    .button-container {
        text-align: center;
        padding: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: -1px;
    }

    .subtotal-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-top: -40px;
    }
</style>

<?php while ($row = $resultado_produto->fetch_assoc()) { ?>

<form action="carrinho1.php" method="POST">

    <input type="hidden" name="codProd" value="<?= $row['codProd'] ?>">
    <input type="hidden" name="valor" value="<?= $row['valor'] ?>">

    <div class="card-container" data-valor="<?= $row['valor'] ?>">
        <div class="image-container">
            <img src="assets/img/<?= $row['arquivo'] ?>" alt="Imagem do Produto" >
        </div>

        <div class="info-container">
            <h2>
                <?= $row['nomeProd'] ?>
            </h2>
            <p>
                <?= $row['descricao'] ?>
            </p>

            <div class="quantity-container">
                <input type="number" class="form-control form-control-sm quantidade-input" min="1" name="quantidade"
                    value="1" data-codcarrinho="<?= $linha['codCarrinho'] ?>">
            </div>

            <div>
                <table class="subtotal-container">
                    <thead>
                        <tr>
                            <th scope="col">Subtotal:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td class="subtotal">
                            R$<?= number_format($row["valor"], 2, ',', '.') ?>
                        </td>
                    </tbody>
                </table>
            </div>

            <!-- CÓDIGO DE QUANTIDADE * VALOR -->
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    // Get all quantity input elements
                    var quantityInputs = document.querySelectorAll('.quantidade-input');

                    // Add event listener for each quantity input
                    quantityInputs.forEach(function (input) {
                        input.addEventListener('input', function () {
                            updateSubtotal(input);
                        });
                    });

                    // Function to update subtotal based on quantity input
                    function updateSubtotal(input) {
                        // Get the parent card container
                        var cardContainer = input.closest('.card-container');

                        // Pega o preço e a quantidade 
                        var price = parseFloat(cardContainer.getAttribute('data-valor'));
                        var quantity = parseInt(input.value);

                        // Calcular o subtotal
                        var subtotal = price * quantity;

                        // Atualizar o subtotal
                        var subtotalElement = cardContainer.querySelector('.subtotal');
                        subtotalElement.textContent = 'R$' + subtotal.toFixed(2).replace('.', ',');
                    }
                });
            </script>

            <div class="button-container">
                <button class="btn btn-primary btn-block mt-auto" role="button" aria-pressed="true">Adicionar ao
                    Carrinho</button>
            </div>
        </div>
    </div>
</form>
<?php } ?>