<?php
include './backend/NewCadastro.php';
include './backend/ExcluirCadastro.php';

if (isset($_GET['success'])) {
  echo '<script>alert("CLIENTE INSERIDO COM SUCESSO!")</script>';
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Clientes Cadastrados</title>

  <link rel="stylesheet" href="styles/style.css" />
  <link rel="stylesheet" href="./styles/global.css" />
</head>

<body>
  <header>
    <h1>Clientes Cadastrados</h1>



    <a href="./pages/pageCadastro.php" class="button-cadastro">Cadastrar Novo Cliente
      <img src="./assets/icon-adicao.svg" alt="icon adição" /></a>
  </header>
  <main>
    <section id="containerCadastros">

      <table>
        <thead>
          <th>Nome</th>
          <th>Email</th>
          <th>Telefone</th>
          <th>Endereço</th>
          <th>Descrição</th>
        </thead>
        <tbody>
          <?php
          foreach ($clientes as $cliente) : ?>
            <tr>
              <td><?= $cliente['nome'] ?> </td>
              <td><?= $cliente['email'] ?></td>
              <td><?= $cliente['telefone'] ?> </td>
              <td><?= $cliente['endereco'] ?></td>
              <td><?= $cliente['descricao'] ?> <a href="./index.php?delete&id=<?= $cliente['id'] ?>"><button type="submit">Deletar</button></a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </section>

  </main>
</body>

</html>