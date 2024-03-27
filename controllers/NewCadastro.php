<?php

//Conexão com o banco de dados
include_once __DIR__ . '/../database/database.php';

$db = new Database();
$conectionDataBase = $db->getConnection();

//Classe cliente
include __DIR__ . '/../models/Cliente.php';
include_once __DIR__ . '/../middlewares/global.middlewares.php';


if (isset($_POST['acao'])) {

    //cria um novo objeto Cliente com os dados do formulário
    $data = [
        $nome = $_POST['nome'] ?? '',
        $email = $_POST['email'] ?? '',
        $password = $_POST['password'] ?? '',
        $endereco = $_POST['endereco'] ?? '',
        $telefone = $_POST['telefone'] ?? ''
    ];


    //valida os dados do formulário
    validUser($data);

    $cliente = new Cliente($data['nome'], $data['email'], $data['password'], $data['endereco'], $data['telefone']);

    //preparando a consulta SQL para inserir o cliente no banco de dados
    $sql = $conectionDataBase->prepare("INSERT INTO `tb.clientes`(`nome`,`email`, `senha`, `telefone`, `endereco`) VALUES (?, ?, ?, ?, ?) ");

    //executando a consulta SQL
    if ($sql->execute([$cliente->getInformacoes(['nome']), $cliente->getInformacoes(['email']), $cliente->getSenhaHash(), $cliente->getInformacoes(['telefone']), $cliente->getInformacoes(['endereco'])])) {

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
