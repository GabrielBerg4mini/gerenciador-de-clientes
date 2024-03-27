<?php
include_once __DIR__ . '/../models/cliente.delete.models.php';

class ClienteControllerDelete
{
    private $cliente;

    public function __construct()
    {
        $this->cliente = new DeleteCliente();
    }

    public function deleteCliente($id)
    {
        if (DeleteCliente::deleteCliente($id)) {
            session_start();
            $_SESSION['delete_message'] = true;
            header("Location: ./index.php");
            exit();
        } else {
            echo "Falha ao excluir o cliente.";
        }
    }
}
