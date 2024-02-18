<?php
session_start();
$sessao_id = session_id();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once("assets/conexao.php");

    $codProd = $_POST['codProd'];
    $valor = $_POST['valor'];
    $quantidade = $_POST['quantidade'];

    // Adicionar produto ao carrinho (você precisa implementar essa lógica)
    $sql = "INSERT INTO carrinho (sessao_id, codigoProduto, quantidade) 
            VALUES ('$sessao_id', '$codProd', '$quantidade')";
    
    mysqli_query($conexao, $sql);

    // Redirecionar de volta à página de exibição de produtos
    exit();
}
?>
