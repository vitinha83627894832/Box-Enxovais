

<?php
require_once("../assets/conexao.php");

if (isset($_GET['codProd'])) {
    $codProd = $_GET['codProd'];

    // Gere a consulta SQL para obter as informações do produto
    $sql = "SELECT produto.*, 
    marca_produto.nomeMarcaProd,
    tipo_produto.nomeTipoProd
      FROM produto
      LEFT JOIN marca_produto ON marca_produto.codMarcaProd = produto.marca_produto_cod
      LEFT JOIN tipo_produto ON tipo_produto.codTipoProd = produto.tipo_produto_cod";

    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        // Converta o resultado em um array associativo
        $produto = mysqli_fetch_assoc($resultado);

        // Converta o array em JSON e imprima
        echo json_encode($produto);
    } else {
        echo json_encode(['error' => 'Erro ao obter informações do produto']);
    }
} else {
    echo json_encode(['error' => 'ID do produto não fornecido']);
}
