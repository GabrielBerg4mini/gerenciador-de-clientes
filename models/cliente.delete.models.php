<?php

include_once __DIR__ . '/../database/database.php';

class DeleteCliente
{

    public static function deleteCliente($id)
    {
        $db = (new Database())->getConnection();
        $sql = $db->prepare("DELETE FROM `tb.clientes` WHERE id = ?");
        return $sql->execute([$id]);
    }
}
