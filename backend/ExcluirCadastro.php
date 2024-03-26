<?php
include __DIR__ . '/../database/database.php';

if (isset($_GET['id'])) {
    //obtendo o id do clietne da url
    $cliente_id = $_GET['id'];

    // Preparando e executando a consulta SQL para excluir o cliente
    $sql = $conectionDataBase->prepare("DELETE FROM `tb.clientes` WHERE id = ?");
    if ($sql->execute([$cliente_id])) {
        // Cliente excluído com sucesso
        session_start();
        $_SESSION['delete_message'] = true;
        header("Location: index.php");
        exit();
    } else {
        // Falha ao excluir o cliente
        echo "Falha ao excluir o cliente.";
    }
}
