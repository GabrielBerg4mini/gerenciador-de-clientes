<?php
//verificar se o email já está cadastrado
function emailExists($email)
{
    $pdo = new PDO('mysql:host=localhost;dbname=gerenciador-de-clientes', 'root', '');

    $sql = $pdo->prepare("SELECT * FROM `tb.clientes` WHERE email = :email");
    $sql->bindParam(':email', $email);
    $sql->execute();

    return $sql->fetch();
}

//Recuperar todos os clientes do banco de dados
function getClientes()
{
    $pdo = new PDO('mysql:host=localhost;dbname=gerenciador-de-clientes', 'root', '');
    $sql = $pdo->prepare("SELECT * FROM `tb.clientes`");
    $sql->execute();

    return $sql->fetchAll();
}
