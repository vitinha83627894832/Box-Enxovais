<?php
require_once("../assets/conexao.php");

if (isset($_GET['codCliente'])) {
    $codCliente = $_GET['codCliente'];

    // Gere a consulta SQL para obter as informações do cliente
    $sql = "SELECT * FROM cliente WHERE codCliente = $codCliente";

    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        // Converta o resultado em um array associativo
        $cliente = mysqli_fetch_assoc($resultado);

        // Converta o array em JSON e imprima
        echo json_encode($cliente);
    } else {
        echo json_encode(['error' => 'Erro ao obter informações do cliente']);
    }
} else {
    echo json_encode(['error' => 'ID do cliente não fornecido']);
}
