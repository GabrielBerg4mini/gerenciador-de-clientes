<?php
include __DIR__ . '/./controllers/NewCadastro.php';
include __DIR__ . '/./backend/ExcluirCadastro.php';
include __DIR__ . '/./backend/Paginacao.php';

//inicia a sessão para acessar a variável de sessão
session_start();

// verifica se a variável de sessão está definida e exibe a mensagem de sucesso
if (isset($_SESSION['success_message'])) {
  echo '<script>alert("CLIENTE INSERIDO COM SUCESSO!")</script>';
  unset($_SESSION['success_message']); // limpa a variável de sessão
}

if (isset($_SESSION['delete_message'])) {
  echo "<script>alert('Cliente excluido com sucesso')</script>";
  unset($_SESSION['delete_message']);
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

        </thead>
        <tbody>
          <?php
          foreach ($clientsToDisplay as $cliente) : ?>
            <tr>
              <td><?= $cliente['nome'] ?> </td>
              <td><?= $cliente['email'] ?></td>
              <td><?= $cliente['telefone'] ?> </td>
              <td class="delete"><?= $cliente['endereco'] ?> <a href="./index.php?delete&id=<?= $cliente['id'] ?>"><button type="submit">Deletar</button></a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>

      </table>
      <article class="pagination">


        <a class="buttons <?= $page == 1 ? 'disabled' : '' ?>" href="?page=<?= max(1, $page - 1) ?>">Voltar</a>


        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
          <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>


        <a class="buttons <?= $page == $totalPages ? 'disabled' : '' ?>" href="?page= <?= min($totalPages, $page + 1) ?>">Avançar</a>

      </article>
    </section>

  </main>
</body>

</html>