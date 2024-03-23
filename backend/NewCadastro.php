<?php

//Conexão com o banco de dados
$pdo = new PDO("mysql:host=localhost;dbname=gerenciador-de-clientes", 'root', '');

//Classe cliente
include 'Cliente.php';
include_once 'DbClientes.php';


if (isset($_POST['acao'])) {

    //cria um novo objeto Cliente com os dados do formulário
    $cliente = new Cliente(
        $nome = $_POST['nome'] ?? '',
        $email = $_POST['email'] ?? '',
        $password = $_POST['password'] ?? '',
        $endereco = $_POST['endereco'] ?? '',
        $telefone = $_POST['telefone'] ?? ''
    );


    if (empty($nome) || empty($email) || empty($password) || empty($endereco) || empty($telefone)) {
        header(("Location: ../pages/pageCadastro.php?error= Os campo precisam estar preenchidos."));
        exit;
    }
    if ($_POST['password'] !== $_POST['passwordConfirm']) {
        header("Location: ../pages/pageCadastro.php?error= As senhas precisam ser iguais.");
        exit;
    }

    if (emailExists($_POST['email'])) {
        header("Location: ../pages/pageCadastro.php?error= Email já cadastrado.");
        exit;
    }

    //preparando a consulta SQL para inserir o cliente no banco de dados
    $sql = $pdo->prepare("INSERT INTO `tb.clientes`(`nome`,`email`, `senha`, `telefone`, `endereco`) VALUES (?, ?, ?, ?, ?) ");

    //executando a consulta SQL
    if ($sql->execute([$cliente->nome, $cliente->email, $cliente->getSenhaHash(), $cliente->telefone, $cliente->endereco])) {

        session_start(); // inicia a sessão
        $_SESSION['sucess_message'] = true; // define a variável para indicar sucesso
        header("Location: ../index.php"); //redireciona para index.php com parâmetro de sucesso
        exit(); //encerra o script para evitar execução adicional

    } else {
        die("Falha ao inserir o cliente" . print_r($sql->errorInfo(), true));
    }
}

//Recuperar todos os clientes do banco de dados usando a função getClientes
$clientes = getClientes();
