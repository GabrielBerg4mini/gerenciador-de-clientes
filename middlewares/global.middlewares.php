<?php

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../models/Cliente.php';

function dbFunction()
{
    $db = new Database();
    return $db->getConnection();
}

function clientFunction($data)
{
    $cliente = new Cliente($data['nome'], $data['email'], $data['senha'], $data['endereco'], $data['telefone']);
    return $cliente;
}

function validUser($data)
{
    $cliente = clientFunction($data);

    //condiação se não estiver preenchido os campos
    if (empty($data['nome']) || empty($data['email']) || empty($data['password']) || empty($data['endereco']) || empty($data['telefone'])) {
        header(("Location: ../pages/pageCadastro.php?error= Os campo precisam estar preenchidos."));
        exit;
    }

    //verificar se o email já está cadastrado
    if (emailExists($data['email'])) {
        header("Location: ../pages/pageCadastro.php?error= Email já cadastrado.");
        exit;
    }

    // condição caso as senhas sejam diferentes
    if ($_POST['password'] !== $_POST['passwordConfirm']) {
        header("Location: ../pages/pageCadastro.php?error= As senhas precisam ser iguais.");
        exit;
    }
}

//verificar se o email já está cadastrado
function emailExists($email)
{
    $conectionDataBase = dbFunction();

    $sql = $conectionDataBase->prepare("SELECT * FROM `tb.clientes` WHERE email = :email");
    $sql->bindParam(':email', $email);
    $sql->execute();

    return $sql->fetch();
}

//Recuperar todos os clientes do banco de dados
function getClientes()
{
    $conectionDataBase = dbFunction();

    $sql = $conectionDataBase->prepare("SELECT * FROM `tb.clientes`");
    $sql->execute();

    return $sql->fetchAll();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = [
        'nome' => $_POST['nome'] ?? '',
        'email' => $_POST['email'] ?? '',
        'password' => $_POST['password'] ?? '',
        'endereco' => $_POST['endereco'] ?? '',
        'telefone' => $_POST['telefone'] ?? ''
    ];

    validUser($data);
}
