<?php
include_once 'DbClientes.php';

$clientes = getClientes();

//acessando o banco de dados
$pdo = new PDO('mysql:host=localhost;dbname=gerenciador-de-clientes', 'root', '');

//preparando a consulta SQL para recuperar todos os clientes
$sql = $pdo->prepare('SELECT * FROM `tb.clientes`');
//executando a consulta SQL
$sql->execute();
//buscando todos os clientes
$clients = $sql->fetchAll();

// numero de clientes por pg
$clientsPerPage = 10;

// Obtendo o número da página atual da string de consulta
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculando o total de páginas
$totalPages = ceil(count($clients) / $clientsPerPage);

//Calculando os índices inicial e final dos clientes a serem exibidos
$startIndex = ($page - 1) * $clientsPerPage;
$endIndex = $startIndex + $clientsPerPage - 1;

// mostrando os clientes da página atual
$clientsToDisplay = array_slice($clients, $startIndex, $clientsPerPage);
