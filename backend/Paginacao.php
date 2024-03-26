<?php
include   __DIR__ . '/../database/database.php';
include_once __DIR__ .  '/../middlewares/global.middlewares.php';

$clientes = getClientes();



$sql = $conectionDataBase->prepare('SELECT * FROM `tb.clientes`');
$sql->execute();
$clients = $sql->fetchAll();

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
