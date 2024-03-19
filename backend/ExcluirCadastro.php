<?php

if (isset($_GET['delete']) && isset($_GET['id'])) {
    //obtendo o id do clietne da url
    $cliente_id = $_GET['id'];

    $pdo = new PDO("mysql:host=localhost;dbname=gerenciador-de-clientes", 'root', '');

    // Preparando e executando a consulta SQL para excluir o cliente
    $sql = $pdo->prepare("DELETE FROM `tb.clientes` WHERE id = ?");
    if ($sql->execute([$cliente_id])) {
        // Cliente excluído com sucesso
        echo "<script>alert('Cliente excluido com sucesso')</script>";
    } else {
        // Falha ao excluir o cliente
        echo "Falha ao excluir o cliente.";
    }
}
