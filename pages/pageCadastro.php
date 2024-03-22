<?php

include '../backend/NewCadastro.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastrar Novo Cliente</title>

  <link rel="stylesheet" href="../styles/style-cadastro.css">
  <link rel="stylesheet" href="../styles/global.css" />
</head>

<body>

  <header>
    <h1>Cadastrar Novo Cliente</h1>

    <a href="../index.php" class="button-voltar">Voltar <img src="../assets/icons-voltar.svg" alt="Icone voltar"></a>
  </header>

  <main>

    <section id="containerAdiocionarCadastro">
      <form action="../backend/NewCadastro.php" method="post">
        <fieldset>
          <legend>Dados do cliente</legend>

          <?php
          if (isset($_REQUEST["error"])) { ?>
            <span class="message-error"><?= $_REQUEST["error"] ?></span>
          <?php } ?>

          <label for="nome">Nome:</label>
          <input type="text" name="nome" id="nome" />

          <label for="email">E-mail:</label>
          <input type="email" name="email" id="email" placeholder="ex: carlos@gmail.com..." />

          <label for="telefone">Telefone:</label>
          <input type="tel" name="telefone" id="telefone">


          <label for="endereco">Endereço:</label>

          <input type="text" max="12" name="endereco" id="endereco">


          <label for="password">Senha:</label>
          <input type="password" name="password" id="password" minlength="8" autocomplete="off" />

          <label for="password">Confirmar Senha:</label>

          <input type="password" name="passwordConfirm" id="passwordConfirm" autocomplete="off" />


          <button type="submit" class="button-cadastrar" name="acao"> Cadastrar Cliente <img src="../assets/icon-adicao.svg" alt="icon adição"></button>

        </fieldset>

      </form>
    </section>
  </main>
</body>

</html>