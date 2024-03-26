<?php

function validUser()
{
    $cliente = $GLOBALS['cliente'];

    //condiação se não estiver preenchido os campos
    if (empty($nome) || empty($email) || empty($password) || empty($endereco) || empty($telefone)) {
        header(("Location: ../pages/pageCadastro.php?error= Os campo precisam estar preenchidos."));
        exit;
    }

    //verificar se o email é válido
    if (!filter_var($cliente->email, FILTER_VALIDATE_EMAIL)) {
        die("Email inválido");
    }

    //verificar se o email já está cadastrado
    if (emailExists($_POST['email'])) {
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
    $conectionDataBase = $GLOBALS['conectionDataBase'];

    $sql = $conectionDataBase->prepare("SELECT * FROM `tb.clientes` WHERE email = :email");
    $sql->bindParam(':email', $email);
    $sql->execute();

    return $sql->fetch();
}

//Recuperar todos os clientes do banco de dados
function getClientes()
{
    $conectionDataBase = $GLOBALS['conectionDataBase'];

    $sql = $conectionDataBase->prepare("SELECT * FROM `tb.clientes`");
    $sql->execute();

    return $sql->fetchAll();
}
