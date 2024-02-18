<?php
require_once("../assets/conexao.php");

if (isset($_GET['codAdm'])) {
    $codAdm = $_GET['codAdm'];

    // Gere a consulta SQL para obter as informações do adm
    $sql = "SELECT * FROM adm WHERE codAdm = $codAdm";

    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        // Converta o resultado em um array associativo
        $adm = mysqli_fetch_assoc($resultado);

        // Converta o array em JSON e imprima
        echo json_encode($adm);
    } else {
        echo json_encode(['error' => 'Erro ao obter informações do adm']);
    }
} else {
    echo json_encode(['error' => 'ID do adm não fornecido']);
}
